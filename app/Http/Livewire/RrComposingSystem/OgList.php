<?php

namespace App\Http\Livewire\RrComposingSystem;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OgSoftcopy;
use App\Models\OgFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;
use App\Models\PublicationType;
use App\Models\PublicationTypeChildren;

class OgList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    
    public $search = '';
    public $keywordMode = true;
    public $ogForEdit = [];
    
    public $edit_Id;
    public $edit_articleTitle;
    
    public $edit_petId;
    public $edit_ogId;
    public $edit_petitionerName;
    public $edit_petitionerAddress;
    public $edit_amountPaid;
    public $edit_datePaid;
    public $edit_isPaymentComplete;
    
    public $edit_publicationType = "";
    public $edit_publicationSubType = "";
    
    public $edit_datePublished;
    public $edit_isDownloadable;
    public $edit_isSearchable;
    public $edit_fileUpload;
    public $edit_currentFileUpload = [];
    public $viewOgParent = [];
    public $viewOgSoftcopyFile = [];
    public $hasFile = false;
    
    //PUBLICATION SIDE
    public $pubSelectTypeList = [];
    public $pubSelectSubTypeList = [];
    
    public $pubTypeLoop = [];
    public $pubSubTypeLoop = [];
    
    protected $listeners = ['refreshTable'];
    
    public function refreshTable(){
        $this->resetPage();
        
        $this->pubSelectTypeList = PublicationType::all();
        $this->pubSelectSubTypeList = PublicationTypeChildren::all();
    }
    
    public function clearSearch(){
        $this->search = '';
    }
    
    public function editOgSoftcopy($ogId){
        $this->edit_Id = $ogId;
        $postEdit = OgSoftcopy::find($ogId);
        $postEditFile = OgFile::where('belongs_to', $postEdit->file_id)->get();
        // dd($postEditFile);
        $this->ogForEdit = $postEdit;
        $this->edit_currentFileUpload = $postEditFile;
        
        //BINDING OG DETAILS TO MODELS
        $this->edit_ogId = $postEdit->encoded_by_id;
        $this->edit_articleTitle = $postEdit->article_title;
        $this->edit_publicationType = $postEdit->publication_type;
        $this->edit_publicationSubType = $postEdit->publication_sub_type;
        $this->edit_datePublished = $postEdit->date_published;
        $this->edit_isDownloadable = $postEdit->is_downloadable;
        $this->edit_isSearchable = $postEdit->is_searchable;
    }
    
    public function encodePetitioner($ogId){
        $this->edit_Id = $ogId;
        $postEdit = OgSoftcopy::find($ogId);
        $postEditFile = OgFile::where('belongs_to', $postEdit->file_id)->get();
        
        //BINDING OG DETAILS TO MODELS
        $this->edit_petId = $postEdit->petitioner_encoded_by_id;
        $this->edit_petitionerName = $postEdit->petitioner_name;
        $this->edit_petitionerAddress = $postEdit->petitioner_address;
        $this->edit_amountPaid = $postEdit->amount_paid;
        $this->edit_datePaid = $postEdit->date_paid;
        $this->edit_isPaymentComplete = $postEdit->is_payment_complete;
    }
    
    public function deleteOgSoftcopy($ogId){
        $postDelete = OgSoftcopy::find($ogId);
        $postDelete->delete();
        session()->flash('messageDeleteOgSoftcopy', 'Deleted Successfully!');
        // return redirect()->to('/composing_system');
    }
    
    public function viewOgSoftcopy($ogId){
        $viewOgSoftcopy = OgSoftcopy::find($ogId);
        $this->viewOgSoftcopyFile = OgFile::where('belongs_to', $viewOgSoftcopy->file_id)->get();
        
        $publicationType = PublicationType::where('id', $viewOgSoftcopy->publication_type)->value('publication_type');
        $publicationSubType = PublicationTypeChildren::where('id', $viewOgSoftcopy->publication_sub_type)->value('publication_type_child');
        
        $this->viewOgParent = [
            'article_title' => $viewOgSoftcopy->article_title,
            'publication_type' => $publicationType . ' - ' . $publicationSubType,
            'date_published' => $viewOgSoftcopy->date_published,
            'is_downloadable' => $viewOgSoftcopy->is_downloadable,
            'is_searchable' => $viewOgSoftcopy->is_searchable,
            'petitioner_name' => $viewOgSoftcopy->petitioner_name,
            'petitioner_address' => $viewOgSoftcopy->petitioner_address,
            'amount_paid' => $viewOgSoftcopy->amount_paid,
            'date_paid' => $viewOgSoftcopy->date_paid,
            'is_payment_complete' => $viewOgSoftcopy->is_payment_complete,
        ];
    }
    
    public function spitMatchedSubPublicType($pubId){
        $this->pubSelectSubTypeList = PublicationTypeChildren::where('publication_parent_id', $pubId)->get();
        $this->edit_publicationSubType = "";
    }
    
    public function updateOgSoftcopy($ogId){
        $now = Carbon::now();
        
        if( $this->hasFile == true ){
            $validated = $this->validate([
                'edit_fileUpload' => 'mimes:pdf|max:51200', // 50MB Max 1024 * 50 = 51200
                ]);
            }
            
            $updateOgSoftcopy = OgSoftcopy::find($ogId);
            $updateOgSoftcopy->update(
                [
                    'article_title' =>  $this->edit_articleTitle,
                    'publication_type' => $this->edit_publicationType,
                    'publication_sub_type' => $this->edit_publicationSubType,
                    'date_published' => $this->edit_datePublished,
                    'is_downloadable' => $this->edit_isDownloadable,
                    'is_searchable' => $this->edit_isSearchable,
                    'file_id' => $updateOgSoftcopy->file_id,
                    ]
                );
                
                if ($this->edit_fileUpload != null) {
                    $deleteCurrentFile = OgFile::where('belongs_to', $updateOgSoftcopy->file_id)->value('id');
                    if($deleteCurrentFile != null){
                        $deleteCurrentFile = OgFile::find($deleteCurrentFile);
                        $deleteCurrentFile->delete();
                    }
                    
                    $addOgFiles = OgFile::create([
                        'belongs_to' => $updateOgSoftcopy->file_id,
                        'original_filename' => $this->edit_fileUpload->getClientOriginalName(),
                        'converted_filename' => Str::snake($updateOgSoftcopy->article_title) . '_' . $updateOgSoftcopy->file_id  . '.pdf',
                        'filetype' => $this->edit_fileUpload->getClientOriginalExtension(),
                        'filesize' => $this->edit_fileUpload->getSize(),
                        ]);
                        
                        $this->edit_fileUpload->storeAs('public/og_files', $addOgFiles->converted_filename);
                    }
                    
                    session()->flash('messageUpdateOgSoftcopy', 'Publication Updated Successfully!');
                }
                
                public function updateOgPetitioner($ogId){
                    $now = Carbon::now();
                    
                    $updateOgSoftcopy = OgSoftcopy::find($ogId);
                    $updateOgSoftcopy->update(
                        [
                            'petitioner_id' => Str::uuid(),
                            'petitioner_name' => $this->edit_petitionerName,
                            'petitioner_address' => $this->edit_petitionerAddress,
                            'amount_paid' => $this->edit_amountPaid,
                            'date_paid' => $this->edit_datePaid,
                            'is_payment_complete' => $this->edit_isPaymentComplete,
                            'petitioner_encoded_by_id' => Auth::user()->id,
                            'petitioner_encoded_by_name' => Auth::user()->name,
                            'petitioner_encoded_at' => $now,
                            ]
                        );
                        
                        session()->flash('messageUpdateOgPetitioner', 'Petitioner Saved Successfully!');
                    }
                    
                    public function updatedEditFileUpload(){
                        $validated = $this->validate([
                            'edit_fileUpload' => 'mimes:pdf|max:51200', // 50MB Max 1024 * 50 = 51200
                            ]);
                        }
                        
                        public function mount(){
                            $this->pubSelectTypeList = PublicationType::all();
                            $this->pubSelectSubTypeList = PublicationTypeChildren::all();
                            
                            $this->pubTypeLoop = PublicationType::all();
                            $this->pubSubTypeLoop = PublicationTypeChildren::all();
                        }
                        
                        public function render()
                        {
                            if($this->keywordMode == true){
                                return view('livewire.rr-composing-system.og-list', [
                                    'ogList' => OgSoftcopy::where('id', 'like', '%'.$this->search.'%')
                                    ->orWhere('article_title', 'like', '%'.$this->search.'%')
                                    ->orWhere('publication_type', 'like', '%'.$this->search.'%')
                                    ->orWhere('petitioner_name', 'like', '%'.$this->search.'%')
                                    ->orderBy('created_at', 'DESC')
                                    ->paginate(10),
                                    ]);
                                }else{
                                    return view('livewire.rr-composing-system.og-list', [
                                        'ogList' => OgSoftcopy::where('date_published', 'like', '%'.$this->search.'%')
                                        ->orWhere('created_at', 'like', '%'.$this->search.'%')
                                        ->orderBy('created_at', 'DESC')
                                        ->paginate(10),
                                        ]);
                                    }
                                }
                            }