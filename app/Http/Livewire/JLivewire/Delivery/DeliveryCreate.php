<?php

namespace App\Http\Livewire\JLivewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;

class DeliveryCreate extends Component
{
    public $ballotlists = [];
    public $users, $name, $email, $user_id;

    public function addBallot()
    {
        $this->ballotlists[] =  ['ballot_id' => '', 'clustered_precint' => '', 'city_mun_prov' => '', 'quantity' => ''];
    }
    public function removeBallot($index)
    {
        unset($this->ballotlists[$index]);
        $this->ballotlists = array_values($this->ballotlists);
    }
    public function mount()
    {
        $this->ballotlists = [
            ['ballot_id' => '', 'clustered_precint' => '', 'city_mun_prov' => '', 'quantity' => '']
        ];
    }

    public function render()
    {
        return view('livewire.j-livewire.delivery.delivery-create');
    }
    
    public function store()
    {
        //create model and add fillable, create clearfields and reset
      

         foreach ($this->ballotlists as $ballotlist){
            Delivery::create(['BALLOT_ID' => $ballotlist['ballot_id']]);
        }
        $this->ballotlists = [
            ['ballot_id' => '', 'clustered_precint' => '', 'city_mun_prov' => '', 'quantity' => '']
        ];

        session()->flash('message', 'DR Number Created!.');
    }
}
