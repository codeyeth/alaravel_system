<?php

namespace App\Http\Livewire\JLivewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use App\Models\Ballots;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class DeliveryOb extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $ballotlists = [];
    public $search = '';
    public $loopCount;
    public $saveCount;
    public $searchBallotsResultMessage;
    public $search_dr_ob = '';
    public $datefrom ='';
    public $dateto = '';
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
        
        // $this->mydata[] =  DB::table('deliveries')->where('DR_NO', 0000001)->paginate(10);
        
        
        $this->ballotlists = [
            ['ballot_id' => '', 'clustered_precint' => '', 'city_mun_prov' => '', 'quantity' => '']
        ];
    }
    

    public function searchBallotId($ballotId, $indexKey){
        $searchResult = Ballots::where('ballot_id', $ballotId)
        ->Where('ballot_id', 'not like', '%F_%')
        ->first();
        
        if($searchResult != null){
            $this->showSaveBtn = true;
            $this->ballotlists[$indexKey]['clustered_precint'] = $searchResult->clustered_prec;
            $this->ballotlists[$indexKey]['city_mun_prov'] = $searchResult->prov_name . ' ' . $searchResult->mun_name . ' ' . $searchResult->bgy_name;
            $this->ballotlists[$indexKey]['quantity'] = $searchResult->cluster_total;
            $addOneField = true;
        }else{
            $this->showSaveBtn = false;
            $this->ballotlists[$indexKey]['clustered_precint'] = "No Data Found!";
            $this->ballotlists[$indexKey]['city_mun_prov'] = "No Data Found!";
            $this->ballotlists[$indexKey]['quantity'] =  "No Data Found!";
            $addOneField = false;
        }
        
        if($addOneField == true){
            $idFocus = $indexKey + 1;
            // dd($idFocus);
            $this->dispatchBrowserEvent('searchSucceed', ['idFocus' => $idFocus]);
            $this->addBallot();
        }
    }
    
    
    
    public function save(){
        foreach ($this->ballotlists as $ballotlist){
            /*doesnt need this query anymore
            $searchResult = Ballots::where('ballot_id', $ballotlist['ballot_id'])
            ->Where('ballot_id', 'not like', '%F_%')
            ->first(); 
            */
            Delivery::create([
                'BALLOT_ID' => $ballotlist['ballot_id'],
                'CLUSTERED_PREC' => $ballotlist['clustered_precint'],
                'CITY_MUN_PROV' => $ballotlist['city_mun_prov'],
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
                    $ballotList = DB::table('deliveries')->Where('BALLOT_ID', 'not like', '%F_%')->paginate(5);
                    $ballotListCount = DB::table('deliveries')->Where('BALLOT_ID', 'not like', '%F_%')->count();
                    $ballotListCountTitle = 'Total Official Ballots in Delivery';
                }else{
                $ballotList = Delivery::where(function ($query) { $query->where('BALLOT_ID', 'not like', '%F_%'); })->where(function ($query) {$query->where('BALLOT_ID', $this->search)->orWhere('DR_NO', $this->search);})->paginate(5);
                $ballotListCount = Delivery::where(function ($query) {
                    $query->where('BALLOT_ID', 'not like', '%F_%');})->where(function ($query) {$query->where('BALLOT_ID', $this->search)->orWhere('DR_NO', $this->search);})->count();
                    $ballotListCountTitle ='Search Result Found:';
                }
                if ($this->search_dr_ob == ''){
                    $droblist = DB::table('deliveries')->Where('BALLOT_ID', 'not like', '%F_%')->where('BALLOT_ID','!=','')->paginate(5);
                    $droblistresult = '';
                }else{
                    $droblist = DB::table('deliveries')->Where('BALLOT_ID', 'not like', '%F_%')->where('BALLOT_ID','!=','')->where('DR_NO', $this->search_dr_ob)->paginate(5);
                    $droblistresult = 'Search Result Found: '.DB::table('deliveries')->Where('BALLOT_ID', 'not like', '%F_%')->where('BALLOT_ID','!=','')->where('DR_NO', $this->search_dr_ob)->count();
                }
                if ($this->datefrom == '' || $this->dateto == '' ){
                    $dailyoblist = DB::table('deliveries')->Where('BALLOT_ID', 'not like', '%F_%')->where('BALLOT_ID','!=','')->paginate(5);
                    $dailyoblistresult = '';
                }else{
                $dailyoblist = DB::table('deliveries')->where('BALLOT_ID','!=','')
                ->Where('BALLOT_ID', 'not like', '%F_%')
                ->whereRaw('updated_at >= ? AND updated_at <= ?', array($this->datefrom.' 00:00:00', $this->dateto.' 23:59:59'))->paginate(5);
                $dailyoblistresult = 'Search Result Found: '.DB::table('deliveries')  ->where('BALLOT_ID','!=','')
                ->Where('BALLOT_ID', 'not like', '%F_%')
                ->whereRaw('updated_at >= ? AND updated_at <= ?', array($this->datefrom.' 00:00:00', $this->dateto.' 23:59:59'))->count();
          
                }

                
                return view('livewire.j-livewire.delivery.delivery-ob',compact('ballotList','ballotListCount','ballotListCountTitle','droblist','droblistresult','dailyoblist','dailyoblistresult'));
                
            }
            
            public function storeob()
            {
                $this->save();
                //create model and add fillable, create clearfields and reset
            }
            
        }
        