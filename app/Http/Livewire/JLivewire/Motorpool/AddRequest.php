<?php

namespace App\Http\Livewire\JLivewire\Motorpool;

use Livewire\Component;

class AddRequest extends Component
{
    public $empName = "";
    public $chiefName = "";
    public $destination = "";
    public $date = "";
    public $time = "";
    public $purpose = "";

    public function render()
    {
        return view('livewire.j-livewire.motorpool.add-request');
    }
}
