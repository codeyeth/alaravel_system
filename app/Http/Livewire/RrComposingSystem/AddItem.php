<?php

namespace App\Http\Livewire\RrComposingSystem;

use Livewire\Component;
use App\Models\OgSoftcopy;
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
    public $publicationType = '';
    public $publicationSubType = '';
    public $datePublished;
    public $isDownloadable = false;
    public $isSearchable = false;
    public $fileUpload;
    
    public $noError = true;
    public $showAddForm = false;
    
    public $pubList = [];
    public $pubSubList = [];

    //Get Publication Type List
    public $pubSelectSubList = [];
    
    public function spitMatchedSubPublicType($pubId){
        $this->pubSelectSubList = PublicationTypeChildren::where('publication_parent_id', $pubId)->get();
        $this->publicationSubType = "";
    }
    
    public function refreshTrick(){
        $this->articleTitle = '';
        $this->datePublished = '';
        $this->isDownloadable = false;
        $this->isSearchable = false;
        $this->fileUpload = null;
        $this->dispatchBrowserEvent('clear-file');

        $this->publicationType = '';
        $this->publicationSubType = '';
        $this->pubSelectSubList = [];
        $this->pubList = PublicationType::all();
        $this->emit('newSoftcopyAdded');
    }

    public function saveSoftcopy(){
        $now = Carbon::now();
        
        $validated = $this->validate([
            'fileUpload' => 'mimes:pdf|max:51200', // 50MB Max 1024 * 50 = 51200
            ]
        );
        
        $addOgSoftcopy = OgSoftCopy::create([
            'article_title' => Str::upper($this->articleTitle),
            
            'encoded_by_id' => Auth::user()->id,
            'encoded_by_name' => Auth::user()->name,
            
            'publication_type' => $this->publicationType,
            'publication_sub_type' => $this->publicationSubType,
            
            'date_published' => $this->datePublished,
            'is_downloadable' => $this->isDownloadable,
            'is_searchable' => $this->isSearchable,
            'file_id' => Str::uuid(),
            'date' => $now->toDateString(),
            ]
        );
        
        $addOgFiles = OgFile::create([
            'belongs_to' => $addOgSoftcopy->file_id,
            'original_filename' => $this->fileUpload->getClientOriginalName(),
            'converted_filename' => Str::upper($addOgSoftcopy->article_title) . '_' . $addOgSoftcopy->file_id  . '.pdf',
            'filetype' => $this->fileUpload->getClientOriginalExtension(),
            'filesize' => $this->fileUpload->getSize(),
            ]
        );
        
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
            ]
        );
    }
    
    public function mount(){
        $this->pubList = PublicationType::all();
        $this->pubSubList = PublicationTypeChildren::all();                                        
    }
    
    public function render()
    {
        return view('livewire.rr-composing-system.add-item');
    }
}