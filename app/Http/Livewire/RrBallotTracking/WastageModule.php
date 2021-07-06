<?php

namespace App\Http\Livewire\RrBallotTracking;

use Livewire\Component;

class WastageModule extends Component
{
    public $wastageEntryList = [];
    public $updateWastageEntry = false;
    
    public function resetContent(){
        $this->updateWastageEntry = false;
        $this->wastageEntryList =  [ ['control_number' => '', 'description' => '', 'descriptionText' => '',] ];
    }

    public function addWastage()
    {
        $this->wastageEntryList[] =  ['control_number' => '', 'description' => '', 'descriptionText' => '',];
    }

    public function removeWastage($index)
    {
        unset($this->wastageEntryList[$index]);
        $this->wastageEntryList = array_values($this->wastageEntryList);
    }
    
    public function mount(){
        $this->wastageEntryList =  [ ['control_number' => '', 'description' => '', 'descriptionText' => '',] ];
    }
    
    public function render()
    {
        return view('livewire.rr-ballot-tracking.wastage-module');
    }
}
