<?php

namespace App\Http\Livewire\RrBallotTracking;

use Livewire\Component;
use App\Models\Ballots;
use App\Models\BallotHistory;
use App\Models\BadBallots;
use App\Models\BbDescriptionDatabase;
use App\Models\User;
use Auth;
use Livewire\WithPagination;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ComelecRoles;
use Illuminate\Support\Str;

//Excel Exports
use Maatwebsite\Excel\Facades\Excel;
use App\ExcelExports\ExportExcelSingleBallotHistory;
use App\ExcelExports\ExportExcelAllHistory;
use App\ExcelExports\ExportExcelBallotDate;
use App\ExcelExports\ExportExcelStatusBallotHistory;

use App\ExcelExports\ExportExcelRePrints;
use App\ExcelExports\ExportExcelDelivered;


//REALTIME functions
use App\Events\RefreshBallotList;

class BarcodeFunction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    public $searchMode;
    public $ballotIn;
    public $verificationBadMode;
    public $comelecRolesList = [];
    
    public $isDeliveredMode;
    public $isOutForDeliveryMode;
    
    //BALLOT DETAILS
    public $modalBallotHistoryList = [];
    
    public $exportSingleId;
    public $ballotHistoryCount;
    
    public $dateFrom;
    public $dateTo;
    
    public $statusSelected = '';
    public $statusType = '';
    public $keywordMode = true;
    
    //VIEW THE FULL BALLOT DETAILS
    public $viewBallotParent;
    
    //ALTER BALLOT STATUS
    public $cantAlter = false; //CANT ALTER THE BALLOT IF IT IS OUT FOR DELIVERY OR DELIVERED OR HAS AN DR
    public $alterBallotStatus = '';
    public $alterBallotHistoryList = [];
    
    //ENCODE BAD BALLOTS FOR QUARANTINE
    public $badBallotId;
    public $badBallotsFor = [];
    public $badBallotLists = [];
    public $badBallotCount;
    public $badBallotIdFor;
    public $updateBadBallot = false;
    public $updateBadBallotId;
    public $allRePrintDone = false;
    public $badBallotDescriptionList = [];
    public $descriptionOthers = false;
    // public $quickUpdateMode = false;
    
    //WEBSOCKETS
    // Special Syntax: ['echo:{channel},{event}' => '{method}']
    // protected $listeners = ['echo:RefreshBallotListChannel,RefreshBallotList' => 'refreshContent'];
    
    protected $listeners = ['refreshContent'];
    
    //UPDATE TOGGLE SEARCH MODE
    public function searchModeToggle(){
        $this->search = '';
        if( $this->searchMode == true){
            $this->searchMode = false;
            $updateMyMode = User::find(Auth::user()->id);
            $updateMyMode->update(['is_search_mode' => false,]);
            session()->flash('success', 'Mode set to Ballot Mode');
            return redirect()->to('/ballot_tracking');
        }else{
            $this->searchMode = true;
            $updateMyMode = User::find(Auth::user()->id);
            $updateMyMode->update(['is_search_mode' => true,]);
            $updateMyMode->update(['is_delivered_mode' => false,]);
            $updateMyMode->update(['is_out_for_delivery_mode' => false,]);
            session()->flash('success', 'Mode set to Search Mode');
            return redirect()->to('/ballot_tracking');
        }
    }
    
    public function refreshContent($logMessage){
        // THIS WILL REFRESH THE PAGE CONTENTS HEHEHE CHEAT TRICK NICE LIVEWIRE AND LARAVEL ECHO
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    //UPDATE IS DELIVERED MODE TOGGLE
    public function isDeliveredModeToggle(){
        $this->search = '';
        if( $this->isDeliveredMode == true){
            $this->isDeliveredMode = false;
            $updateMyMode = User::find(Auth::user()->id);
            $updateMyMode->update(['is_delivered_mode' => false,]);
            session()->flash('success', 'Delivered Mode Disabled.');
            return redirect()->to('/ballot_tracking');
        }else{
            $this->isDeliveredMode = true;
            $updateMyMode = User::find(Auth::user()->id);
            $updateMyMode->update(['is_delivered_mode' => true,]);
            $updateMyMode->update(['is_out_for_delivery_mode' => false,]);
            session()->flash('success', 'Delivered Mode Enabled | All barcoded items will be Marked as Delivered.');
            
            return redirect()->to('/ballot_tracking');
        }
    }
    
    //UPDATE IS OUT FOR DELIVERY MODE TOGGLE
    public function isOutForDeliveryModeToggle(){
        $this->search = '';
        if( $this->isOutForDeliveryMode == true){
            $this->isOutForDeliveryMode = false;
            $updateMyMode = User::find(Auth::user()->id);
            $updateMyMode->update(['is_out_for_delivery_mode' => false,]);
            session()->flash('success', 'Out For Delivery Mode Disabled.');
            return redirect()->to('/ballot_tracking');
        }else{
            $this->isOutForDeliveryMode = true;
            $updateMyMode = User::find(Auth::user()->id);
            $updateMyMode->update(['is_out_for_delivery_mode' => true,]);
            $updateMyMode->update(['is_delivered_mode' => false,]);
            session()->flash('success', 'Out For Delivery Mode Enabled | All barcoded items will be Marked as Out for Delivery.');
            
            return redirect()->to('/ballot_tracking');
        }
    }
    
    // VIEW FULL BALLOT DETAILS
    public function getBallotDetails($ballotId){
        $getBallotDetails = Ballots::find($ballotId);
        
        $detailsCurrentStatus = '';
        if( $getBallotDetails->current_status == 'SHEETER' ){
            $detailsCurrentStatus = 'PAPER CUTTER SECTION';
        }
        
        if( $getBallotDetails->current_status == 'TEMPORARY STORAGE' ){
            $detailsCurrentStatus = 'STORAGE SECTION';
        }
        
        if( $getBallotDetails->current_status == 'VERIFICATION' ){
            $detailsCurrentStatus = 'VALIDITY VERIFICATION SECTION';
        }
        
        if( $getBallotDetails->current_status == 'QUARANTINE' ){
            $detailsCurrentStatus = 'REJECTED SECTION';
        }
        
        if( $getBallotDetails->current_status == 'COMELEC DELIVERY' ){
            $detailsCurrentStatus = 'DELIVERY SECTION';
        }
        
        if( $getBallotDetails->current_status == 'NPO SMD' ){
            $detailsCurrentStatus = 'BILLING SECTION';
        }
        
        $this->viewBallotParent = collect([
            'prov_name' => $getBallotDetails->prov_name,
            'mun_name' => $getBallotDetails->mun_name,
            'bgy_name' => $getBallotDetails->bgy_name,
            'pollplace' => $getBallotDetails->pollplace,
            'clustered_prec' => $getBallotDetails->clustered_prec,
            'cluster_total' => $getBallotDetails->cluster_total,
            'ballot_id' => $getBallotDetails->ballot_id,
            // 'current_status' => $getBallotDetails->current_status,
            'current_status' => $detailsCurrentStatus,
            'status_updated_by' => $getBallotDetails->status_updated_by,
            'status_updated_at' => Carbon::parse($getBallotDetails->status_updated_at)->toDayDateTimeString(),
            
            'is_re_print' => $getBallotDetails->is_re_print,
            ]
        );
        
        // dd($this->viewBallotParent , $getBallotDetails);
    }
    
    //UPDATE TOGGLE SEARCH MODE
    public function ballotInToggle(){
        $this->search = '';
        if( $this->ballotIn == true){
            $this->ballotIn = false;
            $updateMyBallotIn = User::find(Auth::user()->id);
            
            if( Auth::user()->comelec_role == 'VERIFICATION'){
                $updateMyBallotIn->update(['is_ballot_in' => false,]);
                // 'is_verification_type_bad' => true,
            }else{
                $updateMyBallotIn->update(['is_ballot_in' => false,]);
            }
            
            session()->flash('success', 'Ballot Out Mode');
            return redirect()->to('/ballot_tracking');
        }else{
            $this->ballotIn = true;
            $updateMyBallotIn = User::find(Auth::user()->id);
            
            if( Auth::user()->comelec_role == 'VERIFICATION'){
                $updateMyBallotIn->update(['is_ballot_in' => true,]);
                // 'is_verification_type_bad' => false,
            }else{
                $updateMyBallotIn->update(['is_ballot_in' => true,]);
            }
            
            session()->flash('success', 'Ballot In Mode');
            return redirect()->to('/ballot_tracking');
        }
    }
    
    //UPDATE TOGGLE VERIFICATION BAD MODE
    public function verificationBadModeToggle(){
        if( $this->verificationBadMode == true){
            $this->verificationBadMode = false;
            $updateMyVerificationMode = User::find(Auth::user()->id);
            $updateMyVerificationMode->update(['is_verification_type_bad' => false,]);
            session()->flash('success', 'Mode set to Verification Good');
            return redirect()->to('/ballot_tracking');
        }else{
            $this->verificationBadMode = true;
            $updateMyVerificationMode = User::find(Auth::user()->id);
            $updateMyVerificationMode->update(['is_ballot_in' => false,'is_verification_type_bad' => true,]);
            session()->flash('success', 'Mode set to Verification Bad');
            return redirect()->to('/ballot_tracking');
        }
    }
    
    //ADD FIELDS INTO THE BAD BALLOTS
    public function addBadBallot()
    {
        $this->badBallotCount++;
        $this->badBallotLists[] =  ['unique_number' => '', 'description' => '', 'descriptionText' => '',];
    }
    
    //REMOVE FIELDS INTO THE BAD BALLOTS
    public function removeBadBallot($index)
    {
        unset($this->badBallotLists[$index]);
        $this->badBallotLists = array_values($this->badBallotLists);
        $this->badBallotCount--;
    }
    
    //SET THE BAD BALLOT ID TO GET THE PARENT BALLOT ID
    public function setBadBallotId($ballotId){
        $this->badBallotId = $ballotId;
        $this->getBadBallot();
    }
    
    //GET ALL THE LISTED BAD BALLOTS
    public function getBadBallot()
    {
        $ballotId = Ballots::find($this->badBallotId);
        $this->badBallotIdFor = $ballotId->ballot_id;
        $this->badBallotsFor = BadBallots::where('ballot_id', $ballotId->ballot_id)->orderBy('id', 'DESC')->get();
        
        $scanForDoneRePrint = BadBallots::where('ballot_id', $ballotId->ballot_id)->where('is_all_successful', false)->count();
        // dd($scanForDoneRePrint);
        if( $scanForDoneRePrint == 0 ){
            $this->allRePrintDone = true;
        }else{
            $this->allRePrintDone = false;
        }
        
        $this->badBallotDescriptionList = BbDescriptionDatabase::all();
    }
    
    public function descriptionSelect($selectedValue){
        if( $selectedValue == 'OTHERS' ){
            $this->descriptionOthers = true;
        }else{
            $this->descriptionOthers = false;
        }
    }
    
    //SAVE THE BAD BALLOTS
    public function saveBadBallots($ballotId){
        $ballotId = Ballots::find($ballotId);
        
        foreach ($this->badBallotLists as $index => $badballotlist){
            $validatedData = Validator::make(
                ['unique_number' => $badballotlist['unique_number']
            ],
            ['unique_number' => 'string|unique:bad_ballots'],
            ['required' => 'The :attribute field is required'],
            )->validate();
            
            
            $description = Str::upper($badballotlist['description']);
            if( Str::upper($badballotlist['description']) == 'OTHERS' ){
                $description = Str::upper($badballotlist['descriptionText']);
            }
            
            BadBallots::create([
                'ballot_id' => $ballotId->ballot_id,
                'unique_number' => $badballotlist['unique_number'],
                'description' => $description,
                'created_by_id' => Auth::user()->id,
                'created_by_name' => Auth::user()->name,
                'created_by_comelec_role' => Auth::user()->comelec_role,
                ]
            );
            
            $scanForDescription = BbDescriptionDatabase::where( 'description', $description )->get();
            if( count($scanForDescription) == 0 ){
                BbDescriptionDatabase::create([
                    'description' => $description,
                    'created_by_id' => Auth::user()->id,
                    'created_by_name' => Auth::user()->name,
                    ]
                );
            }
            
            
        }
        session()->flash('messageBadBallots', 'Bad Ballots Saved Successfully!');
        $this->resetBadBallots();  
    }
    
    public function deleteBadBallots($id){
        $badBallotDelete = BadBallots::find($id);
        $badBallotDelete->delete();
        session()->flash('messageBadBallots', 'Bad Ballot Deleted Successfully!');
        $this->getBadBallot();
    }
    
    public function editBadBallots($id){
        $badBallotEdit = BadBallots::find($id);
        $this->updateBadBallotId = $id;
        $this->badBallotLists = [ ['unique_number' => '', 'description' => '', 'descriptionText' => '',] ];
        $this->badBallotLists[0]['unique_number'] = $badBallotEdit->unique_number;
        $this->badBallotLists[0]['description'] = $badBallotEdit->description;
        $this->updateBadBallot = true;
    }
    
    public function resetBadBallots(){
        $this->getBadBallot();
        $this->updateBadBallot = false;
        $this->descriptionOthers = false;
        $this->badBallotLists = [ ['unique_number' => '', 'description' => '', 'descriptionText' => '',] ];
        $this->emit('refreshReprintModule');
    }
    
    public function updateBadBallots($id){
        $updateBadBallots = BadBallots::find($id);
        foreach ($this->badBallotLists as $index => $badballotlist){
            
            $searchForDuplicates = BadBallots::where('unique_number', $badballotlist['unique_number'])->first();
            // dd($searchForDuplicates);
            
            $description = Str::upper($badballotlist['description']);
            if( Str::upper($badballotlist['description']) == 'OTHERS' ){
                $description = Str::upper($badballotlist['descriptionText']);
            }
            
            if( $searchForDuplicates != null ){
                if($searchForDuplicates->id == $id){
                    $updateBadBallots->update([
                        'unique_number' => $badballotlist['unique_number'],
                        'description' => $description,
                        ]
                    );
                }else{
                    $validatedData = Validator::make(
                        ['unique_number' => $badballotlist['unique_number']
                    ],
                    ['unique_number' => 'string|unique:bad_ballots'],
                    ['required' => 'The :attribute field is required'],
                    )->validate();
                }
            }else{
                $updateBadBallots->update([
                    
                    'unique_number' => $badballotlist['unique_number'],
                    'description' => $description,
                    ]
                );
            }
            
            $scanForDescription = BbDescriptionDatabase::where( 'description', $description )->get();
            if( count($scanForDescription) == 0 ){
                BbDescriptionDatabase::create([
                    'description' => $description,
                    'created_by_id' => Auth::user()->id,
                    'created_by_name' => Auth::user()->name,
                    ]
                );
            }
            
        }
        session()->flash('messageBadBallots', 'Bad Ballots Updated Successfully!');
        $this->resetBadBallots();
    }
    
    public function rePrintDone($id){
        $now = Carbon::now();
        $ballotId = Ballots::find($id);
        $ballotId->update([
            'is_re_print_done' => true,
            'is_re_print_done_by_id' => Auth::user()->id,
            'is_re_print_done_by' => Auth::user()->name,
            'is_re_print_done_at' => $now,
            ]
        );
        $this->allRePrintDone = false;
        session()->flash('messageBadBallots', 'Re-Printing Done Successfully!');
    }
    
    //ALTER THE BALLOT STATUS
    public function alterBallotStatus($id){
        $now = Carbon::now();
        $splittedValue = explode(" - ", $this->alterBallotStatus);
        
        $alterBallotStatus = Ballots::where('id', $id)->first();
        
        $addBallotHistory = BallotHistory::create([
            'ballot_id' => $alterBallotStatus->ballot_id,
            'action' => 'Alter Status',
            'old_status' => $splittedValue[0],
            'old_status_type' => "",
            'new_status' => "",
            'new_status_type' => $splittedValue[1],
            'status_by_id' => Auth::user()->id,
            'status_by_name' => Auth::user()->name,
            'status_by_at' => $now,
            'status_by_at_date' => $now->toDateString(),
            ]
        );
        
        if( $splittedValue[1] == 'IN' ){
            $currentStatus = $splittedValue[0];
        }
        
        //OUT
        
        if( $splittedValue[0] == 'SHEETER' && $splittedValue[1] == 'OUT' ){
            $currentStatus = "TEMPORARY STORAGE";
        }   
        
        if( $splittedValue[0] == 'TEMPORARY STORAGE' && $splittedValue[1] == 'OUT' ){
            $currentStatus = "VERIFICATION";
        }  
        
        if( $splittedValue[0] == 'VERIFICATION' && $splittedValue[1] == 'OUT' ){
            $currentStatus = "COMELEC DELIVERY";
        } 
        
        if( $splittedValue[0] == 'COMELEC DELIVERY' && $splittedValue[1] == 'OUT' ){
            $currentStatus = "NPO SMD";
        }
        
        // dd( $currentStatus , $splittedValue[1]);
        
        $alterBallotStatus->update([
            'current_status' => $currentStatus,
            'new_status_type' => $splittedValue[1],
            'status_updated_by_id' => Auth::user()->id,
            'status_updated_by' => Auth::user()->name,
            'status_updated_at' => $now,
            ]
        );
        
        $this->modalBallotHistoryList = BallotHistory::where('ballot_id', $alterBallotStatus->ballot_id)->get();  
        $this->alterBallotStatus = '';
        session()->flash('messageAltered', $alterBallotStatus->ballot_id . ' Altered Successfully');
        
    }
    
    // BALLOT QUICK UPDATE MODE
    public function updateBallotStatusQuickMode($id){
        // $this->quickUpdateMode = true;
        $convertToBallotId = Ballots::find($id);
        $this->search = $convertToBallotId->ballot_id;
        $this->updateBallotStatus();
    }
    
    // BALLOT QUICK UPDATE MODE SHOW CONFIRMATION BUTTONS
    public function quickUpdate($id){
        $this->emit('showConfirmationButtons', $id);
    }
    
    // BALLOT QUICK UPDATE MODE HIDE CONFIRMATION BUTTONS AND SHOW THE PARENT BUTTON WHEN TRANSACTION CANCELLED
    public function cancelQuickUpdate($id){
        $this->emit('hideConfirmationButtons', $id);
    }
    
    //UPDATE BALLOT STATUS
    public function updateBallotStatus(){
        $now = Carbon::now();
        if($this->search != '' && $this->searchMode == false){
            
            if( Auth::user()->comelec_role == 'SHEETER' && $this->ballotIn == true ){
                $updateBallotStatus = Ballots::where('ballot_id', $this->search)->where('current_status', 'PRINTER')->first();
            }else{
                $updateBallotStatus = Ballots::where('ballot_id', $this->search)->where('current_status', Auth::user()->comelec_role)->first();
            }
            
            if($updateBallotStatus != null){
                if( $this->ballotIn == false && $this->verificationBadMode == true ){
                    $newStatus = 'QUARANTINE';
                    $for = 'BAD BALLOTS';
                    $rePrint = true;
                    $rePrintById = Auth::user()->id;
                    $rePrintBy =  Auth::user()->name;
                    $rePrintAt = $now;
                    $rePrintId = $this->search;
                }else{
                    if( Auth::user()->comelec_role == 'SHEETER' && $this->ballotIn == true ){
                        $newStatus = Auth::user()->comelec_role;
                        $for = '';
                    }elseif( Auth::user()->comelec_role == 'NPO SMD' && $this->ballotIn == false ){
                        $newStatus = 'FOR DELIVERY';
                        $for = '';
                    }elseif($this->ballotIn == true){
                        $newStatus = $updateBallotStatus->current_status;
                        $for = '';
                    }else{
                        $newStatus = Auth::user()->barcoded_receiver;
                        $for = '';
                    }
                    $rePrint = $updateBallotStatus->is_re_print;
                    $rePrintById = $updateBallotStatus->is_re_print_by_id;
                    $rePrintBy = $updateBallotStatus->is_re_print_by;
                    $rePrintAt = $updateBallotStatus->is_re_print_at;
                    $rePrintId = $updateBallotStatus->re_print_id;
                }
                
                if( $this->ballotIn == true ){
                    $statusType = 'IN';
                }else{
                    $statusType = 'OUT';
                    // $newStatus = "FOR " . $newStatus;
                }
                
                if( $updateBallotStatus->current_status == "PRINTER"){
                    $oldStatus = "SHEETER";
                }else{
                    $oldStatus = $updateBallotStatus->current_status;
                }
                
                $addBallotHistory = BallotHistory::create([
                    'ballot_id' => $this->search,
                    'action' => 'Update',
                    'old_status' => $oldStatus,
                    // 'old_status_type' => $updateBallotStatus->new_status_type,
                    'old_status_type' => "",
                    // 'new_status' => $newStatus,
                    'new_status' => "",
                    'new_status_type' => $statusType,
                    'for' => $for,
                    'status_by_id' => Auth::user()->id,
                    'status_by_name' => Auth::user()->name,
                    'status_by_at' => $now,
                    'status_by_at_date' => $now->toDateString(),
                    ]
                );
                
                $updateBallotStatus->update([
                    'current_status' => $newStatus,
                    'new_status_type' => $statusType,
                    'status_updated_by_id' => Auth::user()->id,
                    'status_updated_by' => Auth::user()->name,
                    'status_updated_at' => $now,
                    
                    'is_re_print' => $rePrint,
                    'is_re_print_by_id' => $rePrintById ,
                    'is_re_print_by' => $rePrintBy,
                    'is_re_print_at' => $rePrintAt,
                    're_print_id' => $rePrintId,
                    ]
                );
                
                session()->flash('success', $this->search . ' Ballot ' . $statusType . ' Successful');
                
                $userName = Auth::user()->name;
                $ballot_id = $this->search;
                
                ///// BEEN OVER-WRITED FOR DEMO PURPOSES
                
                if($statusType == 'IN'){
                    $comelec_role = Auth::user()->comelec_role;
                    
                    if($comelec_role == 'SHEETER'){
                        // $barcoded_receiver = 'PRINTER';
                        
                        $comelec_role = 'PAPER CUTTER SECTION';
                        $barcoded_receiver = 'PRINTER';
                    }
                    
                    if($comelec_role == 'TEMPORARY STORAGE'){
                        // $barcoded_receiver = 'SHEETER';
                        
                        $comelec_role = 'STORAGE SECTION';
                        $barcoded_receiver = 'PAPER CUTTER SECTION';
                    }
                    
                    if($comelec_role == 'VERIFICATION'){
                        // $barcoded_receiver = 'TEMPORARY STORAGE';
                        
                        $comelec_role = 'VALIDITY VERIFICATION SECTION';
                        $barcoded_receiver = 'STORAGE SECTION';
                    }
                    
                    if($comelec_role == 'COMELEC DELIVERY'){
                        if($updateBallotStatus->is_re_print == true){
                            // $barcoded_receiver = 'QUARANTINE';
                            
                            $comelec_role = 'DELIVERY SECTION';
                            $barcoded_receiver = 'REJECTED SECTION';
                            
                        }else{
                            // $barcoded_receiver = 'VERIFICATION';
                            
                            $comelec_role = 'DELIVERY SECTION';
                            $barcoded_receiver = 'VALIDITY VERIFICATION SECTION';
                        }
                    }
                    
                    if($comelec_role == 'QUARANTINE'){
                        // $barcoded_receiver = 'VERIFICATION';
                        
                        $comelec_role = 'REJECTED SECTION';
                        $barcoded_receiver = 'VALIDITY VERIFICATION SECTION';
                    }
                    
                    if($comelec_role == 'NPO SMD'){
                        // $barcoded_receiver = 'COMELEC DELIVERY';
                        
                        $comelec_role = 'BILLING SECTION';
                        $barcoded_receiver = 'DELIVERY SECTION';
                    }
                    
                    broadcast(new RefreshBallotList($comelec_role, $ballot_id, $barcoded_receiver, $statusType, $userName));
                }
                
                if($statusType == 'OUT'){
                    // $comelec_role = Auth::user()->comelec_role;
                    
                    if( Auth::user()->comelec_role == 'SHEETER' ){
                        $comelec_role = 'PAPER CUTTER SECTION';
                    }
                    
                    if( Auth::user()->comelec_role == 'TEMPORARY STORAGE' ){
                        $comelec_role = 'STORAGE SECTION';
                    }
                    
                    if( Auth::user()->comelec_role == 'VERIFICATION' ){
                        $comelec_role = 'VALIDITY VERIFICATION SECTION';
                    }
                    
                    if( Auth::user()->comelec_role == 'QUARANTINE' ){
                        $comelec_role = 'REJECTED SECTION';
                    }
                    
                    if( Auth::user()->comelec_role == 'COMELEC DELIVERY' ){
                        $comelec_role = 'DELIVERY SECTION';
                    }
                    
                    if( Auth::user()->comelec_role == 'NPO SMD' ){
                        $comelec_role = 'BILLING SECTION';
                    }
                    
                    if( Auth::user()->comelec_role == 'VERIFICATION' && $this->verificationBadMode == true ){
                        // $barcoded_receiver = 'QUARANTINE';
                        $barcoded_receiver = 'REJECTED SECTION';
                    }else{
                        // $barcoded_receiver = Auth::user()->barcoded_receiver;
                        
                        if( Auth::user()->barcoded_receiver == 'SHEETER' ){
                            $barcoded_receiver = 'PAPER CUTTER SECTION';
                        }
                        
                        if( Auth::user()->barcoded_receiver == 'TEMPORARY STORAGE' ){
                            $barcoded_receiver = 'STORAGE SECTION';
                        }
                        
                        if( Auth::user()->barcoded_receiver == 'VERIFICATION' ){
                            $barcoded_receiver = 'VALIDITY VERIFICATION SECTION';
                        }
                        
                        if( Auth::user()->barcoded_receiver == 'QUARANTINE' ){
                            $barcoded_receiver = 'REJECTED SECTION';
                        }
                        
                        if( Auth::user()->barcoded_receiver == 'COMELEC DELIVERY' ){
                            $barcoded_receiver = 'DELIVERY SECTION';
                        }
                        
                        if( Auth::user()->barcoded_receiver == 'NPO SMD' ){
                            $barcoded_receiver = 'BILLING SECTION';
                        }
                        
                    }
                    
                    broadcast(new RefreshBallotList($comelec_role, $ballot_id, $barcoded_receiver, $statusType, $userName));
                }
                
                return redirect()->to('/ballot_tracking');
            }
        }
    }
    
    //CLEAR SEARCH
    public function clearSearch(){
        $this->search = '';
        $this->dispatchBrowserEvent('clearSearch');
    }
    
    public function updatedKeywordMode(){
        $this->search = '';
        $this->dispatchBrowserEvent('clearSearch');
    }
    
    //GET BALLOT HISTORY
    public function getBallotHistory($ballotId){
        $ballotResult = Ballots::find($ballotId);  
        
        if( $ballotResult->is_dr_done == true || $ballotResult->is_out_for_delivery == true || $ballotResult->is_delivered == true){
            $this->cantAlter = true;
        }else{
            $this->cantAlter = false;
        }
        
        $this->exportSingleId = $ballotId;
        $this->modalBallotHistoryList = BallotHistory::where('ballot_id', $ballotResult->ballot_id)->get();  
        $this->alterBallotHistoryList = BallotHistory::where('ballot_id', $ballotResult->ballot_id)->groupBy('old_status', 'new_status_type')->get();  
        $this->ballotHistoryCount = count($this->modalBallotHistoryList);
    }
    
    //////////////////////////////////////////////REPORTSSSS
    //EXPORT SINGLE BALLOT HISTORY
    public function exportSingleBallotHistory($exportSingleId){
        $ballotSingleExportResult = Ballots::find($exportSingleId);   
        $ballotIdToExcel = $ballotSingleExportResult->ballot_id;
        $export = new ExportExcelSingleBallotHistory($ballotIdToExcel);
        return Excel::download($export, $ballotIdToExcel . '_single_ballot_history.xlsx');
    }
    //////////////////////////////////////////////REPORTSSSS
    
    //MOUNT FUNCTION
    public function mount(){
        $this->searchMode = Auth::user()->is_search_mode;
        $this->ballotIn = Auth::user()->is_ballot_in;
        $this->verificationBadMode = Auth::user()->is_verification_type_bad;
        $this->comelecRolesList = ComelecRoles::all();
        $this->isDeliveredMode = Auth::user()->is_delivered_mode;
        $this->isOutForDeliveryMode = Auth::user()->is_out_for_delivery_mode;
        
        //BAD BALLOTS
        $this->badBallotCount++;
        $this->badBallotLists =  [ ['unique_number' => '', 'description' => '', 'descriptionText' => '',] ];
    }
    
    public function render()
    {
        if( $this->ballotIn == true){
            $statusType = 'OUT';
        }else{
            $statusType = 'IN';
        }
        
        // IF SEARCH MODE IS TRUE SPIT THE INPUT TYPE=TEXT FOR SEARCHING
        if($this->searchMode == true){
            // IF KEYWORD MODE IS TRUE SPIT THE INPUT TYPE=TEXT FOR SEARCHING KEYWORDS
            if( $this->keywordMode == true ){
                return view('livewire.rr-ballot-tracking.barcode-function', [
                    'ballotList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->
                    orWhere('bgy_name', 'like', '%'.$this->search.'%')->
                    orWhere('mun_name', 'like', '%'.$this->search.'%')->
                    orWhere('prov_name', 'like', '%'.$this->search.'%')->
                    orWhere('pollplace', 'like', '%'.$this->search.'%')->
                    orWhere('current_status', 'like', '%'.$this->search.'%')->
                    orWhere('status_updated_at', 'like', '%'.$this->search.'%')->
                    orWhere('status_updated_by', 'like', '%'.$this->search.'%')->
                    paginate(20),
                    'ballotListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->
                    orWhere('bgy_name', 'like', '%'.$this->search.'%')->
                    orWhere('mun_name', 'like', '%'.$this->search.'%')->
                    orWhere('prov_name', 'like', '%'.$this->search.'%')->
                    orWhere('pollplace', 'like', '%'.$this->search.'%')->
                    orWhere('current_status', 'like', '%'.$this->search.'%')->
                    orWhere('status_updated_at', 'like', '%'.$this->search.'%')->
                    orWhere('status_updated_by', 'like', '%'.$this->search.'%')->
                    count(),
                    ]
                );
            }else{
                return view('livewire.rr-ballot-tracking.barcode-function', [
                    'ballotList' =>  DB::table('ballots')->whereRaw('status_updated_at like ?', array('%'.$this->search.'%'))->paginate(20),
                    'ballotListCount' =>  DB::table('ballots')->whereRaw('status_updated_at like ?', array('%'.$this->search.'%'))->count(),
                    ]
                );
            }
        }else{
            // IF SEARCH MODE IS FALSE SPIT THE INPUT-TYPE TEXT FOR UDPATING THE BALLOT STATUS FOR BARCODING IN/OUT
            if( Auth::user()->comelec_role == 'SHEETER' && Auth::user()->is_ballot_in == true ){
                return view('livewire.rr-ballot-tracking.barcode-function', [
                    'ballotList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', 'PRINTER' )->paginate(20),
                    'ballotListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', 'PRINTER' )->count(),
                    ]
                );
            }else{
                // IF USER IS NPO SMD AND IS IN BALLOT OUT MODE THE BALLOT MUST HAVE A ASSOCIATED DR
                if( Auth::user()->comelec_role == 'NPO SMD' && Auth::user()->is_ballot_in == false ){
                    return view('livewire.rr-ballot-tracking.barcode-function', [
                        'ballotList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', Auth::user()->comelec_role )->where('is_dr_done', true )->where('new_status_type', $statusType )->paginate(20),
                        'ballotListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', Auth::user()->comelec_role )->where('is_dr_done', true )->where('new_status_type', $statusType )->count(),
                        ]
                    );
                }elseif( Auth::user()->comelec_role == 'QUARANTINE' && Auth::user()->is_ballot_in == false ){
                    return view('livewire.rr-ballot-tracking.barcode-function', [
                        'ballotList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', Auth::user()->comelec_role )->where('is_re_print_done', true )->where('new_status_type', $statusType )->paginate(20),
                        'ballotListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', Auth::user()->comelec_role )->where('is_re_print_done', true )->where('new_status_type', $statusType )->count(),
                        ]
                    );
                }else{
                    return view('livewire.rr-ballot-tracking.barcode-function', [
                        'ballotList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', Auth::user()->comelec_role )->where('new_status_type', $statusType )->paginate(20),
                        'ballotListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', Auth::user()->comelec_role )->where('new_status_type', $statusType )->count(),
                        ]
                    );
                }
            }
        }
    }
}