<?php

namespace App\Http\Livewire\JLivewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use App\Models\Ballots;
use App\Models\DeliveryConfig;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Request;
use Auth;

class DeliveryManagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $copies;
    public $title;
    public $person_name;
    public $description;
    public $delivered_to;
    public $person_title = '';
    public $person_auth = '';

    
    //create dr ob
    public $ballotlists = [];
    public $showSaveBtn = false;
    public $canShowData = true;
    public $loopCount;


    

    public $wire_search_dr_no = '';
    public $wire_daily_dr_no = '';
    public $wire_monthly_datefrom ='';
    public $wire_monthly_dateto = '';

    public $wire_dr_reports_identifier;
    public $wire_dr_types_identifier;
    
    public $wire_search_dr_home;

    public function function_dr_types_identifier($id){
        $this->wire_dr_types_identifier = $id;
    }
    
    public function function_dr_reports_identifier($id){ 
        $this->wire_dr_reports_identifier = $id;
    }

////////////////for dr config settings
    protected $messages = [
        'person_name.required' => 'Personnel Name cannot be empty.',
        'person_title.required' => 'Personnel\'s Position cannot be empty. Choose N/A if none.',
        'person_auth.required' => 'Personnel\'s Role cannot be empty.',
    ];
  
////////////////for dr config settings
    public function refresh(){
        $this->copies = '';
        $this->title = '';
        $this->person_name = '';
        $this->person_auth = '';
        $this->person_title = '';
        $this->description = '';
        $this->delivered_to = '';
        
    }

    ////////////////for dr config settings
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'person_name' => 'required',
            'delivered_to' => 'required',
            'description' => 'required',
            'title' => 'required',
            'copies' => 'required',
        ]);
    }

    ////////////////for dr config settings
    public function saveconfig($id){
        if($id == 1){
            $validatedData = $this->validate([
                'person_name' => 'required',
                'person_title' => 'required',
                'person_auth' => 'required',
            ]);
            $save = DeliveryConfig::create([
                'personnel' => $this->person_name,
                'title' => $this->person_title,
                'authorization' => $this->person_auth,
                ]);
                session()->flash('messageSavePerson', ''.$this->person_name.'  has been added to the List');
        }elseif($id == 2){
            $validatedData = $this->validate([
                'delivered_to' => 'required',
            ]);
            $save = DeliveryConfig::create([
                'delivered_to' => $this->delivered_to,
                ]);
                session()->flash('messageSaveDelivered', ''.$this->delivered_to.'  has been added to the List');
        }elseif($id == 3){
            $validatedData = $this->validate([
                'description' => 'required',
            ]);
            $save = DeliveryConfig::create([
                'description' => $this->description,
                ]);
                session()->flash('messageSaveDescription', ''.$this->description.'  has been added to the List');  
        }elseif($id == 4){
            $validatedData = $this->validate([
                'title' => 'required',
            ]);
            $save = DeliveryConfig::create([
                'title_list' => $this->title,
                ]);
                session()->flash('messageSaveTitle', ''.$this->title.'  has been added to the List');
        }elseif($id == 5){
            $validatedData = $this->validate([
                'copies' => 'required',
            ]);
            $save = DeliveryConfig::create([
                'copies' => $this->copies,
                ]);
                session()->flash('messageSaveCopies', ''.$this->copies.'  has been added to the List'); 
        }
        $this->refresh();
    }

    ////////////////for dr config settings
    public function remove($id, $value){
        $remove = DeliveryConfig::find($id);
        $remove->delete();
        if($value == 1){
            session()->flash('messageDeletePerson', ''.$remove->personnel.' has been removed from the List');
        }elseif($value == 2){
            session()->flash('messageDeleteDelivered', ''.$remove->delivered_to.' has been removed from the List');
        }elseif($value == 3){
            session()->flash('messageDeleteDescription', ''.$remove->description.' has been removed from the List');
        }elseif($value == 4){
            session()->flash('messageDeleteTitle', ''.$remove->title_list.' has been removed from the List');
        }elseif($value == 5){
            session()->flash('messageDeleteCopies', ''.$remove->copies.' has been removed from the List');
        }
      
    }
////////////////end for dr config settings


    public function addBallot()
    {
     
            $this->loopCount++;
            $this->ballotlists[] =  ['ballot_id' => '', 'clustered_precint' => '', 'city_mun_prov' => '', 'quantity' => ''];
        
    }



    public function removeBallot($index)
    {
        /*  not properly working
            unset($this->ballotlists[$index]);
            $this->ballotlists = array_values($this->ballotlists);
            $this->loopCount--;  
            */
         
        
           
           
            
            unset($this->ballotlists[$index]);
            $this->showSaveBtn = true;
        


           
           


    }


   

    public function mount()
    {   
     
        $this->ballotlists =  [['ballot_id' => '', 'clustered_precint' => '', 'city_mun_prov' => '', 'quantity' => '']];
        $this->wire_dr_types_identifier = 0;
    }
    
    public function searchBallotId($ballotId, $indexKey){
       
   
            $search_in_ballot = Ballots::where('ballot_id', $ballotId)->Where('current_status', 'NPO SMD')->where('new_status_type', 'IN')->where('ballot_id', 'not like', '%F_%')->first();
            $search_in_delivery = Delivery::where('BALLOT_ID', $ballotId)->first();
            $search_in_ballot_smd = Ballots::where('ballot_id', $ballotId)->Where('current_status','!=', 'NPO SMD')->where('ballot_id', 'not like', '%F_%')->first();
            if($search_in_ballot_smd != null){
                $this->showSaveBtn = false;
                $this->canShowData = false;
                $this->ballotlists[$indexKey]['clustered_precint'] = "No Data Found!";
                $this->ballotlists[$indexKey]['city_mun_prov'] = "No Data Found!";
                $this->ballotlists[$indexKey]['quantity'] =  "No Data Found!";
                session()->flash('messageDR', 'Ballot ID not in Delivery Area. Status: '.$search_in_ballot_smd->current_status.' ');
                $addOneField = false;
            }elseif ($search_in_ballot == null) {
                $this->showSaveBtn = false;
                $this->canShowData = false;
                $this->ballotlists[$indexKey]['clustered_precint'] = "No Data Found!";
                $this->ballotlists[$indexKey]['city_mun_prov'] = "No Data Found!";
                $this->ballotlists[$indexKey]['quantity'] =  "No Data Found!";
                session()->flash('messageDR', 'Invalid Ballot ID. ');
                $addOneField = false;
              } elseif ($search_in_delivery != null) {
                $line_error = $indexKey + 1;
                $this->showSaveBtn = false;
                $this->canShowData = false;
                $this->ballotlists[$indexKey]['clustered_precint'] = "No Data Found!";
                $this->ballotlists[$indexKey]['city_mun_prov'] = "No Data Found!";
                $this->ballotlists[$indexKey]['quantity'] =  "No Data Found!";
                session()->flash('messageDR', 'Ballot ID '.$ballotId.' in Line '.$line_error.' already have DR No. DR No.' .$search_in_delivery->DR_NO.' ');
                $addOneField = false;
              } else {
                $searchResult = Ballots::where('ballot_id', $ballotId)->Where('current_status', 'NPO SMD')->where('new_status_type', 'IN')->where('ballot_id', 'not like', '%F_%')->first();
                $duplicateCount = 0;
                foreach($this->ballotlists as $index => $ballot_list){
                    if( $this->ballotlists[$index]['ballot_id'] == $ballotId ){
                        $duplicateCount++;
                        $this->canShowData = true;
                    }
                    if($duplicateCount > 1){
                        $line_error = $indexKey + 1;
                        $this->canShowData = false;
                        $this->showSaveBtn = false;
                        $this->ballotlists[$indexKey]['clustered_precint'] = $searchResult->clustered_prec;
                        $this->ballotlists[$indexKey]['city_mun_prov'] = $searchResult->prov_name . ' ' . $searchResult->mun_name . ' ' . $searchResult->bgy_name;
                        $this->ballotlists[$indexKey]['quantity'] = $searchResult->cluster_total;
                        session()->flash('messageDR', 'Ballot ID '.$ballotId.' Duplicate Entry at Line '.$line_error.'' );
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
              }


    }

  
    public function save(){
      
      // --start-- for creation of dr number
        $drno = DB::table('deliveries')
        ->groupBy('DR_NO')
        ->get();
        if ($drno->isEmpty()) {
            $c = 1;
        }else{
            $c = $drno->count() + 1;
        }
        $total_row = str_pad($c, 7, '0', STR_PAD_LEFT);
    //--end-- for creation of dr number

       

    foreach ($this->ballotlists as $ballotlist){
    $this->validate(
        [
            'ballotlists.*.ballot_id' => 'unique:deliveries,BALLOT_ID',
          
        ],
        [
          
            'ballotlists.*.*.unique' => 'exist in delivery'.$ballotlist['ballot_id'].'',   
        ]
    );
}
  
    foreach ($this->ballotlists as $index => $ballotlist){
   


                    Delivery::create([
                        'DR_NO' => $total_row,
                        'BALLOT_ID' => $ballotlist['ballot_id'],
                        'CLUSTERED_PREC' => $ballotlist['clustered_precint'],
                        'CITY_MUN_PROV' => $ballotlist['city_mun_prov'],
                        'CLUSTER_TOTAL' => $ballotlist['quantity']
                        ]);
                        $update_selected = DB::table('ballots')
                        ->where('ballot_id', $ballotlist['ballot_id'])
                        ->update(['is_dr_done' => 1,
                                  'is_dr_done_by_id' => Auth::user()->id,
                                  'status_updated_by' => Auth::user()->name,
                                  'status_updated_at' => Carbon::now()
                                  ]);
                        session()->flash('message', 'DR Number Created!');
                    }
                
    }
                
  



        

  
    

        public function store()
        {
            $this->save();
            //create model and add fillable, create clearfields and reset
        }

  

       
     









































    public function render()
    {
        $descriptionList = DB::table('delivery_configs')->where('description','<>','')->get();
        $deliveredList = DB::table('delivery_configs')->where('delivered_to','<>','')->get();
        $copyList = DB::table('delivery_configs')->where('copies','<>','')->get();
        $titleList = DB::table('delivery_configs')->where('title_list','<>','')->where('title_list','!=','N/A')->get();
        $nameList = DB::table('delivery_configs')->where('personnel','<>','')->get();
        $config_query = DB::table('delivery_configs')->get();

        $ob_query = DB::table('deliveries')->Where('BALLOT_ID', 'not like', '%F_%')->where('BALLOT_ID','<>','');
        $fts_query = DB::table('deliveries')->Where('BALLOT_ID', 'like', '%F_%')->where('BALLOT_ID','<>','');

        if ($this->wire_search_dr_home == ''){
            if($this->wire_dr_types_identifier == 1){
                $ballotList = (clone $ob_query)->paginate(10);
                $ballotListCount = (clone $ob_query)->count();
                $ballotListCountTitle = 'Total Official Ballots in Delivery';
            }elseif($this->wire_dr_types_identifier == 0){
                $ballotList = DB::table('deliveries')->where('BALLOT_ID','<>','')->paginate(10);
                $ballotListCount = DB::table('deliveries')->where('BALLOT_ID','<>','')->count();
                $ballotListCountTitle = 'All Ballots in Delivery';
            }else{
                $ballotList = (clone $fts_query)->paginate(10);
                $ballotListCount = (clone $fts_query)->count();
                $ballotListCountTitle = 'Total FTS Ballots in Delivery';
            }
        }else{
            if($this->wire_dr_types_identifier == 1){
        $ballotList = Delivery::where(function ($query) { $query->where('BALLOT_ID', 'not like', '%F_%'); })->where(function ($query) {$query->where('BALLOT_ID', $this->wire_search_dr_home)->orWhere('DR_NO', $this->wire_search_dr_home);})->paginate(10);
        $ballotListCount = Delivery::where(function ($query) {
            $query->where('BALLOT_ID', 'not like', '%F_%');})->where(function ($query) {$query->where('BALLOT_ID', $this->wire_search_dr_home)->orWhere('DR_NO', $this->wire_search_dr_home);})->count();
        }elseif($this->wire_dr_types_identifier == 0){
            $ballotList = Delivery::where('BALLOT_ID', $this->wire_search_dr_home)->where('BALLOT_ID','<>','')->orWhere('DR_NO', $this->wire_search_dr_home)->paginate(10);
            $ballotListCount = Delivery::where('BALLOT_ID', $this->wire_search_dr_home)->where('BALLOT_ID','<>','')->orWhere('DR_NO', $this->wire_search_dr_home)->count();
        }
        else{
            $ballotList = Delivery::where(function ($query) { $query->where('BALLOT_ID', 'like', '%F_%'); })->where(function ($query) {$query->where('BALLOT_ID', $this->wire_search_dr_home)->orWhere('DR_NO', $this->wire_search_dr_home);})->paginate(10);
            $ballotListCount = Delivery::where(function ($query) {
            $query->where('BALLOT_ID', 'like', '%F_%');})->where(function ($query) {$query->where('BALLOT_ID', $this->wire_search_dr_home)->orWhere('DR_NO', $this->wire_search_dr_home);})->count();
                
        }
            $ballotListCountTitle ='Search Result Found:';

        }





        if ($this->wire_search_dr_no == ''){
            if($this->wire_dr_types_identifier == 1){
                $drlist =  (clone $ob_query)->paginate(10);
            }else{
                $drlist =  (clone $fts_query)->paginate(10);
            }
            $drlistresult = '';
        }else{
            if($this->wire_dr_types_identifier == 1){
                if($this->wire_dr_reports_identifier == 1){
                    $drlist = (clone $ob_query)->where('DR_NO', $this->wire_search_dr_no)->paginate(10);
                    $drlistresult = 'Search Result Found: '.(clone $ob_query)->where('DR_NO', $this->wire_search_dr_no)->count();
                }else{
                    $drlist = (clone $ob_query)->where('created_at','like','%'.$this->wire_search_dr_no.'%')->paginate(10);
                    $drlistresult = 'Search Result Found: '.(clone $ob_query)->where('created_at','like','%'.$this->wire_search_dr_no.'%')->count();
                }
            }else{
                if($this->wire_dr_reports_identifier == 1){
                    $drlist = (clone $fts_query)->where('DR_NO', $this->wire_search_dr_no)->paginate(10);
                    $drlistresult = 'Search Result Found: '.(clone $fts_query)->where('DR_NO', $this->wire_search_dr_no)->count();   
                }else{
                    $drlist = (clone $fts_query)->where('created_at','like','%'.$this->wire_search_dr_no.'%')->paginate(10);
                    $drlistresult = 'Search Result Found: '.(clone $fts_query)->where('created_at','like','%'.$this->wire_search_dr_no.'%')->count();  
                } 
            }
        }

        if ($this->wire_monthly_datefrom == '' || $this->wire_monthly_dateto == '' ){
            if($this->wire_dr_types_identifier == 1){
                $monthlydrlist = (clone $ob_query)->paginate(10);
            }else{
                $monthlydrlist = (clone $fts_query)->paginate(10);
            }
                $monthlydrlistresult = '';
        }else{
            if($this->wire_dr_types_identifier == 1){
                $monthlydrlist = (clone $ob_query)->whereRaw('updated_at >= ? AND updated_at <= ?', array($this->wire_monthly_datefrom.' 00:00:00', $this->wire_monthly_dateto.' 23:59:59'))->paginate(10);
                $monthlydrlistresult = 'Search Result Found: '.(clone $ob_query)->whereRaw('updated_at >= ? AND updated_at <= ?', array($this->wire_monthly_datefrom.' 00:00:00', $this->wire_monthly_dateto.' 23:59:59'))->count();
            }else{
                $monthlydrlist = (clone $fts_query)->whereRaw('updated_at >= ? AND updated_at <= ?', array($this->wire_monthly_datefrom.' 00:00:00', $this->wire_monthly_dateto.' 23:59:59'))->paginate(10);
                $monthlydrlistresult = 'Search Result Found: '.(clone $fts_query)->whereRaw('updated_at >= ? AND updated_at <= ?', array($this->wire_monthly_datefrom.' 00:00:00', $this->wire_monthly_dateto.' 23:59:59'))->count();
            }
    }
        return view('livewire.j-livewire.delivery.delivery-management', compact('descriptionList','deliveredList','copyList','titleList','nameList','ballotList','ballotListCount','ballotListCountTitle','config_query','drlist','drlistresult','monthlydrlist','monthlydrlistresult'));
    }
}
