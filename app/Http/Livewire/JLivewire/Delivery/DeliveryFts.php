<?php

namespace App\Http\Livewire\JLivewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use App\Models\Ballots;
use App\Models\DeliveryConfig;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class DeliveryFts extends Component

{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $ballotlists = [];
    public $search = '';
    public $inspected = '';
    public $loopCount;
    public $saveCount;
    public $searchBallotsResultMessage;
    public $search_dr_fts = '';
    public $datefrom ='';
    public $dateto = '';
    public $showSaveBtn = false;
    public $ballotIdCollection = [];
    public $canShowData = true;
    
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
        
        if($ballotId != null){
            $searchResult = Ballots::where('ballot_id', $ballotId)->Where('ballot_id', 'like', '%F_%')->where('current_status', 'NPO SMD')->where('new_status_type', 'IN')->first();
            
            if($searchResult != null){
                
                if( count($this->ballotlists) > 1){
                    $duplicateCount = 0;
                    foreach($this->ballotlists as $index => $ballot_list){
                        if( $this->ballotlists[$index]['ballot_id'] == $ballotId ){
                            $duplicateCount++;
                            $this->canShowData = true;
                        }
                        if($duplicateCount > 1){
                            $this->canShowData = false;
                            session()->flash('messageFts', 'Duplicate Ballot ID');
                        }
                    }
                }
                
                if( $this->canShowData == true ){
                    $this->showSaveBtn = true;
                    $this->ballotlists[$indexKey]['clustered_precint'] = $searchResult->clustered_prec;
                    $this->ballotlists[$indexKey]['city_mun_prov'] = $searchResult->prov_name . ' ' . $searchResult->mun_name . ' ' . $searchResult->bgy_name;
                    $this->ballotlists[$indexKey]['quantity'] = $searchResult->cluster_total;
                    $addOneField = true;
                    
                    //IF SEARCH SUCCESS
                    $idFocus = $indexKey + 1;
                    $this->dispatchBrowserEvent('searchSucceed', ['idFocus' => $idFocus]);
                    $this->addBallot();
                }
                
                
            }else{
                $this->showSaveBtn = false;
                $this->canShowData = false;
                // $this->ballotlists[$indexKey]['clustered_precint'] = "No Data Found!";
                // $this->ballotlists[$indexKey]['city_mun_prov'] = "No Data Found!";
                // $this->ballotlists[$indexKey]['quantity'] =  "No Data Found!";
                session()->flash('messageFts', 'Invalid Ballot ID');
                $addOneField = false;
            }
            
        }
    }
    
    public function save(){
      

        foreach ($this->ballotlists as $index => $ballotlist){
            $ifExisting = Delivery::where('BALLOT_ID', $this->ballotlists[$index]['ballot_id'])->count();
            if( $this->ballotlists[$index]['clustered_precint'] != '' && $ifExisting == 0){
                $endingCount = $index + 1;
                if(count($this->ballotlists) == $endingCount){
                    $this->canShowData = true;
                }
            }else{
                $this->canShowData = false;
            }
        }

        $drno = DB::table('deliveries')
        ->groupBy('DR_NO')
        ->get();
        if ($drno->isEmpty()) {
            $c = 1;
        }else{
            $c = $drno->count() + 1;
        }
        $total_row = str_pad($c, 7, '0', STR_PAD_LEFT);
        if($this->canShowData == true){
            foreach ($this->ballotlists as $index => $ballotlist){
                Delivery::create([
                    'DR_NO' => $total_row,
                    'BALLOT_ID' => $ballotlist['ballot_id'],
                    'CLUSTERED_PREC' => $ballotlist['clustered_precint'],
                    'CITY_MUN_PROV' => $ballotlist['city_mun_prov'],
                    'CLUSTER_TOTAL' => $ballotlist['quantity']
                    ]);
                    session()->flash('message', 'DR Number Created!');
                }
                $this->ballotlists = [ ['ballot_id' => '', 'clustered_precint' => '', 'city_mun_prov' => '', 'quantity' => ''] ];
            }else{
                session()->flash('messageFts', 'There are Invalid Values!');
            }
            
        }
        
        
        public function render()
        {
        
            $config_query = DB::table('delivery_configs')->get();
            if ($this->search == ''){
                $ballotList = DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->paginate(10);
                $ballotListCount = DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->count();
                $ballotListCountTitle = 'Total FTS in Delivery'; 
                
            }else{
                $ballotList = Delivery::where(function ($query) { $query->where('BALLOT_ID', 'like', '%F_%'); })->where(function ($query) {$query->where('BALLOT_ID', $this->search)->orWhere('DR_NO', $this->search); })->paginate(10);
                $ballotListCount =  Delivery::where(function ($query) { $query->where('BALLOT_ID', 'like', '%F_%'); })->where(function ($query) { $query->where('BALLOT_ID', $this->search)->orWhere('DR_NO', $this->search); })->count();
                $ballotListCountTitle = 'Search Result Found:';   
            }
            
            if ($this->search_dr_fts == ''){
                $drftslist = DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->where('BALLOT_ID','!=','')->paginate(10);
                $drftslistresult = '';
            }else{
                $drftslist = DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->where('BALLOT_ID','!=','')->where('DR_NO', $this->search_dr_fts)->paginate(10);
                $drftslistresult = 'Search Result Found: '.DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->where('BALLOT_ID','!=','')->where('DR_NO', $this->search_dr_fts)->count();
            }
            if ($this->datefrom == '' || $this->dateto == '' ){
                $datedftslist = DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->where('BALLOT_ID','!=','')->paginate(10);
                $datedftslistresult = '';
            }else{
                $datedftslist = DB::table('deliveries')->where('BALLOT_ID','<>','')
                ->Where('BALLOT_ID', 'like', '%F_%')
                ->whereRaw('updated_at >= ? AND updated_at <= ?', array($this->datefrom.' 00:00:00', $this->dateto.' 23:59:59'))->paginate(10);
                $datedftslistresult = 'Search Result Found: '.DB::table('deliveries')  ->where('BALLOT_ID','!=','')
                ->Where('BALLOT_ID', 'like', '%F_%')
                ->whereRaw('updated_at >= ? AND updated_at <= ?', array($this->datefrom.' 00:00:00', $this->dateto.' 23:59:59'))->count();
                
            }
            return view('livewire.j-livewire.delivery.delivery-fts',compact('config_query','ballotList','ballotListCount','ballotListCountTitle','drftslist','drftslistresult','datedftslist','datedftslistresult'));
            
        }
        function storefts(){
            $this->save();
        }
    }
    