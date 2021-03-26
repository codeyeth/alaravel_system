<?php

namespace App\Http\Livewire\RrComposingSystem;

use Livewire\Component;
use App\Models\OgSoftCopy;
use App\Models\SEComposing;
use App\Models\OgFile;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Auth;
use App\Models\PublicationType;
use App\Models\PublicationTypeChildren;
use Livewire\WithPagination;

class SearchItem extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $isOn;
    public $searchingMode;
    public $getOgFile = [];
    
    public $search = '';
    public $searchSubType = '';
    
    //PUBLICATION SIDE
    public $pubList = [];
    public $pubSelectSubList = [];
    
    public $searchPubList = [];
    public $searchSubPubList = [];
    
    public $publicationType = "";
    public $publicationSubType = "";
    
    public function clearSearch(){
        $this->search = '';
        $this->searchSubType = '';
        $this->searchSubPubList = [];
    }
    
    public function updatedsearchingMode(){
        $this->search = '';
        $this->searchSubType = '';
    }
    
    public function getOgFile($ogId){
        $getOgFileId = OgSoftcopy::find($ogId);
        if($getOgFileId->is_downloadable == true){
            $this->getOgFile = OgFile::where('belongs_to', $getOgFileId->file_id)->get();
        }else{
            $this->getOgFile = [];
        }
    }
    
    public function spitMatchedSubPublicType($pubId){
        $this->searchSubPubList = PublicationTypeChildren::where('publication_parent_id', $pubId)->get();
        $this->searchSubType = "";
    }
    
    public function mount(){
        $searchEngineStatus = SEComposing::find(1)->value('is_on');
        $this->isOn = $searchEngineStatus;
        $this->searchingMode = "keywordMode";
        
        $this->pubList = PublicationType::all();
        $this->pubSelectSubList = PublicationTypeChildren::all();
        
        $this->searchPubList = PublicationType::all();
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        if($this->searchingMode == "keywordMode"){
            return view('livewire.rr-composing-system.search-item', [
                'ogList' => OgSoftcopy::where('article_title', 'like', '%'.$this->search.'%')
                ->where('is_searchable', true)
                ->orWhere('petitioner_name', 'like', '%'.$this->search.'%')
                ->where('is_searchable', true)
                ->orderBy('created_at', 'DESC')
                ->paginate(20),
                ]);
            }else if($this->searchingMode == "dateMode"){
                return view('livewire.rr-composing-system.search-item', [
                    'ogList' => OgSoftcopy::where('date_published', 'like', '%'.$this->search.'%')
                    ->where('is_searchable', true)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(20),
                    ]);
                }else{
                    if($this->search != null && $this->searchSubType == null){
                        return view('livewire.rr-composing-system.search-item', [
                            'ogList' => OgSoftcopy::where('publication_type', $this->search)
                            ->where('is_searchable', true)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(20),
                            ]);
                        }else if($this->search != null && $this->searchSubType != null){
                            return view('livewire.rr-composing-system.search-item', [
                                'ogList' => OgSoftcopy::where('publication_type', $this->search)
                                ->where('publication_sub_type', $this->searchSubType)
                                ->where('is_searchable', true)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(20),
                                ]);
                            }else{
                                return view('livewire.rr-composing-system.search-item', [
                                    'ogList' => OgSoftcopy::where('publication_type', '!=', '')
                                    ->where('is_searchable', true)
                                    ->orderBy('created_at', 'DESC')
                                    ->paginate(20),
                                    ]);
                                }
                            }
                        }
                    }