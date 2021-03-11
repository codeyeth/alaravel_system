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
    public $search_dr_fts = '';
   
        
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
                    $ballotList = DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->paginate(5);
                    $ballotListCount = DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->count();
                    $ballotListCountTitle = 'Total FTS in Delivery'; 
                   
                }else{
                    $ballotList = Delivery::where(function ($query) { $query->where('BALLOT_ID', 'like', '%F_%'); })->where(function ($query) {$query->where('BALLOT_ID', $this->search)->orWhere('DR_NO', $this->search); })->paginate(5);
                    $ballotListCount =  Delivery::where(function ($query) { $query->where('BALLOT_ID', 'like', '%F_%'); })->where(function ($query) { $query->where('BALLOT_ID', $this->search)->orWhere('DR_NO', $this->search); })->count();
                    $ballotListCountTitle = 'Search Result Found:';   
            
                }

                if ($this->search_dr_fts == ''){
                    $drftslist = DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->where('BALLOT_ID','!=','')->paginate(5);
                    $drftslistresult = '';
                }else{
                    $drftslist = DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->where('BALLOT_ID','!=','')->where('DR_NO', $this->search_dr_fts)->paginate(5);
                    $drftslistresult = 'Search Result Found: '.DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->where('BALLOT_ID','!=','')->where('DR_NO', $this->search_dr_fts)->count();
                }
                    return view('livewire.j-livewire.delivery.delivery-fts',compact('ballotList','ballotListCount','ballotListCountTitle','drftslist','drftslistresult'));
             
            }
        }
                    
                
            
        
                