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

class ActionBar extends Component
{
    public $visiblePublications;
    public $downloadablePublications;
    public $allPublications;
    public $isOn;
    
    public function updateSearchEngine($toBeStatus){
        $now = Carbon::now();
        
        $updateSearchEngine = SEComposing::find(1);
        $updateSearchEngine->update([
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
        $this->visiblePublications = OgSoftcopy::where('is_searchable', true)->count();
        $this->downloadablePublications = OgSoftcopy::where('is_downloadable', true)->count();
        $this->allPublications = OgSoftCopy::all()->count();
        $this->isOn = SEComposing::find(1)->value('is_on');
    }
    
    public function render()
    {
        return view('livewire.rr-composing-system.action-bar');
    }
}