<?php

namespace App\Http\Livewire\JLivewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use App\Models\Ballots;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class DeliveryFts extends Component

{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $ballotlists = [];
    public $search = '';
    public $loopCount;
    public $saveCount;
    public $searchBallotsResultMessage;
    public $search_dr_fts = '';
    public $showSaveBtn = false;
    
    public function addBallot()
    {
        $this->loopCount++;
        $this->ballotlists[] =  ['ballot_id' => '', 'clustered_precint' => '', 'city_mun_prov' => '', 'quantity' => ''];
    }
    public function removeBallot($index)
    {
        unset($this->ballotlists[$index]);
        $this->ballotlists = array_values($this->ballotlists);
        $this->loopCount--;
    }
    public function mount()
    {
        $this->ballotlists = [
            ['ballot_id' => '', 'clustered_precint' => '', 'city_mun_prov' => '', 'quantity' => '']
        ];
    }
    
    public function searchBallotId($ballotId, $indexKey){
        $searchResult = Ballots::where('ballot_id', $ballotId)->first();
        
        if($searchResult != null){
            $this->showSaveBtn = true;
            $this->ballotlists[$indexKey]['clustered_precint'] = $searchResult->clustered_prec;
            $this->ballotlists[$indexKey]['city_mun_prov'] = $searchResult->prov_name . ' ' . $searchResult->mun_name . ' ' . $searchResult->bgy_name;
            $this->ballotlists[$indexKey]['quantity'] = $searchResult->cluster_total;
        }else{
            $this->showSaveBtn = false;
            $this->ballotlists[$indexKey]['clustered_precint'] = "No Data Found!";
            $this->ballotlists[$indexKey]['city_mun_prov'] = "No Data Found!";
            $this->ballotlists[$indexKey]['quantity'] =  "No Data Found!";
        }
    }
    
    public function save(){
        foreach ($this->ballotlists as $ballotlist){
            $searchResult = Ballots::where('ballot_id', $ballotlist['ballot_id'])->first();
            Delivery::create([
                'BALLOT_ID' => $ballotlist['ballot_id'],
                'CLUSTERED_PREC' => $ballotlist['clustered_precint'],
                'PROV_NAME' => $searchResult->prov_name,
                'MUN_NAME' => $searchResult->mun_name,
                'BGY_NAME' => $searchResult->bgy_name,
                'CLUSTER_TOTAL' => $ballotlist['quantity']
                ]);
                session()->flash('message', 'DR Number Created!');
            }
            
            $this->ballotlists = [
                ['ballot_id' => '', 'clustered_precint' => '', 'city_mun_prov' => '', 'quantity' => '']
            ];
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
        
        public function storefts(){
            $this->save();
        }
    }