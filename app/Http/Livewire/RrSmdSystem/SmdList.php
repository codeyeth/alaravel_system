<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;

class SmdList extends Component
{
    public $siTable = true;
    public $poTable = false;
    public $clTable = false;
    public $drTable = false;
    
    public function showPoTable(){
        $this->poTable = true;
        $this->siTable = false;
        $this->clTable = false;
        $this->drTable = false;
    }
    
    public function showSiTable(){
        $this->poTable = false;
        $this->siTable = true;
        $this->clTable = false;
        $this->drTable = false;
    }
    
    public function showClTable(){
        $this->poTable = false;
        $this->siTable = false;
        $this->clTable = true;
        $this->drTable = false;
    }
    
    public function showDrTable(){
        $this->poTable = false;
        $this->siTable = false;
        $this->clTable = false;
        $this->drTable = true;
    }
    
    public function render()
    {
        return view('livewire.rr-smd-system.smd-list');
    }
}