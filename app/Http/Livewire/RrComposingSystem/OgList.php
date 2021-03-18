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

class OgList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    
    public $search = '';
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
    public $edit_datePublished;
    public $edit_isDownloadable;
    public $edit_isSearchable;
    public $edit_fileUpload;
    public $edit_currentFileUpload = [];
    
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
        session()->flash('success', 'Deleted Successfully!');
        return redirect()->to('/composing_system');
    }
    
    public function updateOgSoftcopy($ogId){
        $now = Carbon::now();
        
        $updateOgSoftcopy = OgSoftcopy::find($ogId);
        $updateOgSoftcopy->update(
            [
                'article_title' =>  $this->edit_articleTitle,
                'publication_type' => $this->edit_publicationType,
                'date_published' => $this->edit_datePublished,
                'is_downloadable' => $this->edit_isDownloadable,
                'is_searchable' => $this->edit_isSearchable,
                'file_id' => $updateOgSoftcopy->file_id,
                ]
            );
            
            if ($this->edit_fileUpload != null) {
                $validated = $this->validate([
                    'edit_fileUpload' => 'mimes:pdf|max:51200', // 50MB Max 1024 * 50 = 51200
                    ]);
                    
                    $deleteCurrentFile = OgFile::where('belongs_to', $updateOgSoftcopy->file_id)->value('id');
                    // dd($deleteCurrentFile);
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
                    
                    session()->flash('success', 'Publication Updated Successfully!');
                    return redirect()->to('/composing_system');
                }
                
                public function updateOgPetitioner($ogId){
                    $now = Carbon::now();
                    
                    $updateOgSoftcopy = OgSoftcopy::find($ogId);
                    $updateOgSoftcopy->update(
                        [
                            'petitioner_id' => $updateOgSoftcopy->petitioner_id,
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
                        
                        session()->flash('success', 'Petitioner Saved Successfully!');
                        return redirect()->to('/composing_system');
                    }
                    
                    public function updatedEditFileUpload(){
                        $validated = $this->validate([
                            'edit_fileUpload' => 'mimes:pdf|max:51200', // 50MB Max 1024 * 50 = 51200
                            ]);
                        }
                        
                        public function render()
                        {
                            // return view('livewire.rr-composing-system.og-list');
                            
                            return view('livewire.rr-composing-system.og-list', [
                                'ogList' => OgSoftcopy::where('id', 'like', '%'.$this->search.'%')
                                ->orWhere('article_title', 'like', '%'.$this->search.'%')
                                ->orWhere('publication_type', 'like', '%'.$this->search.'%')
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10),
                                ]);
                            }
                            
                        }