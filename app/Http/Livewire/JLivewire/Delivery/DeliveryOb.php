<?php

namespace App\Http\Livewire\JLivewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class DeliveryOb extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $ballotlists = [];
    public $name;
    public $search = '';
  
  


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

    public function modalUserDetail($userID){
        $modalUser = Delivery::find($userID);   
        $this->name = $modalUser->BALLOT_ID;

    }

 

    private function save(){
        foreach ($this->ballotlists as $ballotlist){
            Delivery::create([
                'BALLOT_ID' => $ballotlist['ballot_id'],
                'CLUSTERED_PREC' => $ballotlist['clustered_precint'],
                'REGION' => $ballotlist['city_mun_prov'],
                'CLUSTER_TOTAL' => $ballotlist['quantity']
                ]);
        }
        $this->ballotlists = [
            ['ballot_id' => '', 'clustered_precint' => '', 'city_mun_prov' => '', 'quantity' => '']
        ];

        session()->flash('message', 'DR Number Created!.');
    }

    public function retrieve(){
        
    }

    public function render()
    {
        if ($this->search == ''){
            return view('livewire.j-livewire.delivery.delivery-main', [
                'ballotList' => DB::table('deliveries')->Where('BALLOT_ID', 'not like', '%F_%')->paginate(5),
                'ballotListCount' => DB::table('deliveries')->Where('BALLOT_ID', 'not like', '%F_%')->count(),
                'ballotListCountTitle' => 'Total Ballot ID of Delivery With DR No',
                ]);
            }else{
                return view('livewire.j-livewire.delivery.delivery-main', [
                    'ballotList' => Delivery::where('BALLOT_ID', 'not like', '%F_%')
                    ->orWhere('BALLOT_ID', $this->search)
                    ->orWhere('DR_NO', $this->search)
                    ->paginate(5),
                    'ballotListCount' => Delivery::where('BALLOT_ID', 'not like', '%F_%')
                    ->orWhere('BALLOT_ID', $this->search)
                    ->orWhere('DR_NO', $this->search)
                    ->count(),
                    'ballotListCountTitle' => 'Search Result Found:',
                    ]);
                }










        if ($this->search == ''){
            return view('livewire.j-livewire.delivery.delivery-ob', [
                'ballotList' => DB::table('deliveries')->Where('BALLOT_ID', 'not like', '%F_%')->paginate(5),
                ]);
            }else{
                return view('livewire.j-livewire.delivery.delivery-ob', [
                    'ballotList' => Delivery::where('BALLOT_ID', $this->search)->Where('BALLOT_ID', 'not like', '%F_%')->paginate(5),
                    
                    ]);
                }










    }
    
    public function storeob()
    {
        $this->save();
        //create model and add fillable, create clearfields and reset
    }

}
