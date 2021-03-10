<?php

namespace App\Http\Livewire\JLivewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class DeliveryFts extends Component

{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $ballotlists = [];
    public $search = '';
    public $loopCount;
    
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
    
    public function searchBallotId(){
        dd(1);
        $this->ballotlists = [
            ['ballot_id' => '', 'clustered_precint' => 'BURAT', 'city_mun_prov' => '', 'quantity' => '']
        ];
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
        
        public function render()
        {
            if ($this->search == ''){
                return view('livewire.j-livewire.delivery.delivery-fts', [
                    'ballotList' => DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->paginate(5),
                    ]);
                }else{
                    return view('livewire.j-livewire.delivery.delivery-fts', [
                        'ballotList' => Delivery::where('BALLOT_ID', $this->search)->Where('BALLOT_ID', 'like', '%F_%')->paginate(5),
                        ]);
                    }
                    
                }
                
                public function storefts()
                {
                    $this->save();
                    //create model and add fillable, create clearfields and reset
                }
                
                
            }
            