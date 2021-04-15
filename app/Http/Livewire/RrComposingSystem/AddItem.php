<?php

namespace App\Http\Livewire\RrComposingSystem;

use Livewire\Component;
use App\Models\OgSoftCopy;
use App\Models\SEComposing;
use App\Models\OgFile;
use App\Models\PublicationType;
use App\Models\PublicationTypeChildren;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Auth;
use DB;

class AddItem extends Component
{
    use WithFileUploads;
    
    public $articleTitle;
    
    public $petitionerName;
    public $petitionerAddress;
    public $amountPaid;
    public $datePaid;
    public $isPaymentComplete;
    
    public $publicationType = "";
    public $publicationSubType = "";
    public $datePublished;
    public $isDownloadable;
    public $isSearchable;
    public $fileUpload;
    
    public $noError = true;
    public $showAddForm = false;
    public $visiblePublications;
    public $downloadablePublications;
    public $allPublications;
    public $isOn;
    
    //PUBLICATION SIDE
    public $pubAddMode = true;
    public $publicationSub = [];
    public $publicationAddSub = [];
    public $publication_type;
    public $pubList = [];
    public $pubSubList = [];
    public $editPubId;
    public $arrayCountUpdate;
    
    //Get Publication Type List
    public $pubSelectSubList = [];
    
    public function addSubType(){
        $this->publicationSub[] = [
            ['publication_type_sub_id' => '', 'publication_type_sub' => '']
        ];
    }
    
    // ADD INPUT WHEN UPDATE MODE IS ENABLED
    public function addUpdateSubType(){
        $this->publicationSub[$this->arrayCountUpdate]['publication_type_sub_id'] = '0000';
        $this->publicationSub[$this->arrayCountUpdate]['publication_type_sub'] = '';
        $this->arrayCountUpdate++;
    }
    
    public function removeSubType($index){
        unset($this->publicationSub[$index]);
        $this->publicationSub = array_values($this->publicationSub);
    }
    
    public function refreshTrick(){
        $this->publication_type = '';
        $this->publicationSub = [];
        $this->pubAddMode = true;
        $this->pubList = PublicationType::all();
        $this->pubSubList = PublicationTypeChildren::all();
        $this->emit('newSoftcopyAdded');
    }
    
    public function deleteParentPubType($pubId){
        $postDelete = PublicationType::find($pubId);
        DB::table('publication_type_childrens')->where('publication_parent_id', $postDelete->id)->delete();
        $postDelete->delete();
        
        session()->flash('messagePublication', 'Deleted Successfully!');
        $this->refreshTrick();
    }
    
    public function deleteChildrenPubType($pubId){
        $postDelete = PublicationTypeChildren::find($pubId);
        $postDelete->delete();
        session()->flash('messagePublication', 'Deleted Successfully!');
        $this->refreshTrick();
    }
    
    public function editPubType($pubId, $indexKey){
        $this->editPubId = $pubId;
        $this->refreshTrick();
        $this->pubAddMode = false;
        $postEdit = PublicationType::find($pubId);
        $this->publication_type = $postEdit->publication_type;
        
        $childrenList = DB::table('publication_type_childrens')->where('publication_parent_id', $postEdit->id)->get();
        foreach($childrenList as $childrenlist){
            $indexKey++;
            $this->arrayCountUpdate = $indexKey + 1;
            $this->publicationSub[$indexKey]['publication_type_sub_id'] = $childrenlist->id;
            $this->publicationSub[$indexKey]['publication_type_sub'] = $childrenlist->publication_type_child;
        }
        $this->emit('newSoftcopyAdded');
    }
    
    public function spitMatchedSubPublicType($pubId){
        $this->pubSelectSubList = PublicationTypeChildren::where('publication_parent_id', $pubId)->get();
        $this->publicationSubType = "";
    }
    
    public function savePublication(){
        $now = Carbon::now();
        
        // $validated = $this->validate(['publication_type' => ['required', 'string', 'max:255', 'unique:publication_types']]);
        
        $addpublicationType = PublicationType::create([
            'publication_type' => $this->publication_type,
            'created_by_id' => Auth::user()->id,
            'created_by_name' => Auth::user()->name,
            ]);
            
            foreach ($this->publicationSub as $publicationSub){
                PublicationTypeChildren::create([
                    'publication_parent_id' => $addpublicationType->id,
                    'publication_type_child' => $publicationSub['publication_type_sub'],
                    'created_by_id' => Auth::user()->id,
                    'created_by_name' => Auth::user()->name,
                    ]);
                }
                
                session()->flash('messagePublication', 'Publication Type/s Added Successfully!');
                // return redirect()->to('/composing_system');
                
                $this->refreshTrick();
            }
            
            public function updatePublication($pubId){
                $updatePubType = PublicationType::find($pubId);
                $updatePubType->update(
                    ['publication_type' => $this->publication_type]
                );
                
                foreach ($this->publicationSub as $publicationSub){
                    if( $publicationSub['publication_type_sub_id'] != "0000" ){
                        $updatePubTypeSub = PublicationTypeChildren::find($publicationSub['publication_type_sub_id']);
                        $updatePubTypeSub->update(
                            ['publication_type_child' => $publicationSub['publication_type_sub']]
                        );
                    }else{
                        PublicationTypeChildren::create([
                            'publication_parent_id' => $updatePubType->id,
                            'publication_type_child' => $publicationSub['publication_type_sub'],
                            'created_by_id' => Auth::user()->id,
                            'created_by_name' => Auth::user()->name,
                            ]);
                        }
                    }
                    
                    session()->flash('messagePublication', 'Publication Type/s Updated Successfully!');
                    $this->refreshTrick();
                }
                
                public function saveSoftcopy(){
                    $now = Carbon::now();
                    
                    $validated = $this->validate([
                        'fileUpload' => 'mimes:pdf|max:51200', // 50MB Max 1024 * 50 = 51200
                        ]);
                        
                        $addOgSoftcopy = OgSoftCopy::create([
                            'article_title' => $this->articleTitle,
                            
                            // 'petitioner_id' => Str::uuid(),
                            // 'petitioner_name' => $this->petitionerName,
                            // 'petitioner_address' => $this->petitionerAddress,
                            // 'amount_paid' => $this->amountPaid,
                            // 'date_paid' => $this->datePaid,
                            // 'is_payment_complete' => $this->isPaymentComplete,
                            
                            'encoded_by_id' => Auth::user()->id,
                            'encoded_by_name' => Auth::user()->name,
                            
                            'publication_type' => $this->publicationType,
                            'publication_sub_type' => $this->publicationSubType,
                            
                            'date_published' => $this->datePublished,
                            'is_downloadable' => $this->isDownloadable,
                            'is_searchable' => $this->isSearchable,
                            'file_id' => Str::uuid(),
                            ]);
                            
                            $addOgFiles = OgFile::create([
                                'belongs_to' => $addOgSoftcopy->file_id,
                                'original_filename' => $this->fileUpload->getClientOriginalName(),
                                'converted_filename' => Str::snake($addOgSoftcopy->article_title) . '_' . $addOgSoftcopy->file_id  . '.pdf',
                                'filetype' => $this->fileUpload->getClientOriginalExtension(),
                                'filesize' => $this->fileUpload->getSize(),
                                ]);
                                
                                $this->fileUpload->storeAs('public/og_files', $addOgFiles->converted_filename);
                                
                                session()->flash('messageSaveSoftcopy', 'Publication Softcopy saved Successfully');
                                // return redirect()->to('/composing_system');
                                
                                $this->dispatchBrowserEvent('clear-file');
                                
                                $this->articleTitle = '';
                                $this->publicationType = '';
                                $this->publicationSubType = '';
                                $this->datePublished = '';
                                $this->isDownloadable = '';
                                $this->isSearchable = '';
                                $this->fileUpload = '';
                                
                                $this->emit('newSoftcopyAdded');
                            }
                            
                            public function updatedFileUpload(){
                                $validated = $this->validate([
                                    'fileUpload' => 'mimes:pdf|max:51200', // 50MB Max 1024 * 50 = 51200
                                    ]);
                                }
                                
                                public function updateSearchEngine($toBeStatus){
                                    $now = Carbon::now();
                                    
                                    $updateSearchEngine = SEComposing::find(1);
                                    $updateSearchEngine->update(
                                        [
                                            'is_on' => $toBeStatus,
                                            'status_by_id' => Auth::user()->id,
                                            'status_by_name' => Auth::user()->name,
                                            'status_at' => $now,
                                            ]
                                        );
                                        
                                        $this->isOn = $toBeStatus;
                                        
                                        if($updateSearchEngine->is_on == true){
                                            session()->flash('messageUpdateSearchEngine', 'Search Engine Started Successfully!');
                                        }else{
                                            session()->flash('messageUpdateSearchEngine', 'Search Engine Shutdown Successful!');
                                        }
                                        
                                        $this->emit('newSoftcopyAdded');
                                    }
                                    
                                    public function mount(){
                                        $visibleCount = OgSoftCopy::where('is_searchable', true)->count();
                                        $downloadableCount = OgSoftCopy::where('is_downloadable', true)->count();
                                        $allCount = OgSoftCopy::all()->count();
                                        $this->visiblePublications = $visibleCount;
                                        $this->downloadablePublications = $downloadableCount;
                                        $this->allPublications = $allCount;
                                        $searchEngineStatus = SEComposing::find(1)->value('is_on');
                                        $this->isOn = $searchEngineStatus;
                                        
                                        $this->pubList = PublicationType::all();
                                        $this->pubSubList = PublicationTypeChildren::all();                                        
                                    }
                                    
                                    public function render()
                                    {
                                        return view('livewire.rr-composing-system.add-item');
                                    }
                                }