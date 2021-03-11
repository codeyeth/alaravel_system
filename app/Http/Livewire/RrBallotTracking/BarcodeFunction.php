<?php

namespace App\Http\Livewire\RrBallotTracking;

use Livewire\Component;
use App\Models\Ballots;
use App\Models\BallotHistory;
use App\Models\User;
use Auth;
use Livewire\WithPagination;
use Carbon\Carbon;

//Excel Exports
use Maatwebsite\Excel\Facades\Excel;
use App\ExcelExports\ExportExcelSingleBallotHistory;
use App\ExcelExports\ExportExcelAllHistory;
use App\ExcelExports\ExportExcelBallotDate;
use App\ExcelExports\ExportExcelStatusBallotHistory;
use App\Models\ComelecRoles;

class BarcodeFunction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    public $searchMode;
    public $ballotIn;
    public $verificationBadMode;
    public $comelecRolesList = [];
    
    //Ballot Details
    public $modalBallotHistoryList = [];
    
    public $exportSingleId;
    public $ballotHistoryCount;
    
    public $dateFrom;
    public $dateTo;
    
    public $statusSelected;
    
    
    //Update Toggle Search Mode
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
            session()->flash('success', 'Mode set to Search Mode');
            return redirect()->to('/ballot_tracking');
        }
    }
    
    //Update Toggle Search Mode
    public function ballotInToggle(){
        $this->search = '';
        if( $this->ballotIn == true){
            $this->ballotIn = false;
            $updateMyBallotIn = User::find(Auth::user()->id);
            
            if( Auth::user()->comelec_role == 'VERIFICATION'){
                $updateMyBallotIn->update(['is_ballot_in' => false,'is_verification_type_bad' => true,]);
            }else{
                $updateMyBallotIn->update(['is_ballot_in' => false,]);
            }
            
            session()->flash('success', 'Ballot Out Mode');
            return redirect()->to('/ballot_tracking');
        }else{
            $this->ballotIn = true;
            $updateMyBallotIn = User::find(Auth::user()->id);
            
            if( Auth::user()->comelec_role == 'VERIFICATION'){
                $updateMyBallotIn->update(['is_ballot_in' => true,'is_verification_type_bad' => false,]);
            }else{
                $updateMyBallotIn->update(['is_ballot_in' => true,]);
            }
            
            session()->flash('success', 'Ballot In Mode');
            return redirect()->to('/ballot_tracking');
        }
    }
    
    //Update Toggle Verification Bad Mode
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
    
    //Update Ballot Status
    public function updateBallotStatus(){
        $now = Carbon::now();
        // dd($now);
        if($this->search != '' && $this->searchMode == false){
            
            if( Auth::user()->comelec_role == 'SHEETER' && $this->ballotIn == true ){
                $updateBallotStatus = Ballots::where('ballot_id', $this->search)->where('current_status', 'PRINTER')->first();
            }else{
                $updateBallotStatus = Ballots::where('ballot_id', $this->search)->where('current_status', Auth::user()->comelec_role)->first();
            }
            
            if($updateBallotStatus != null){
                if( $this->verificationBadMode == true ){
                    $newStatus = 'QUARANTINE';
                    $rePrint = true;
                    $rePrintById = Auth::user()->id;
                    $rePrintBy =  Auth::user()->name;
                    $rePrintAt = $now;
                    $rePrintId = $this->search;
                }else{
                    if( Auth::user()->comelec_role == 'SHEETER' && $this->ballotIn == true ){
                        $newStatus = Auth::user()->comelec_role;
                    }elseif($this->ballotIn == true){
                        $newStatus = $updateBallotStatus->current_status;
                    }else{
                        $newStatus = Auth::user()->barcoded_receiver;
                    }
                    $rePrint = $updateBallotStatus->is_re_print;
                    $rePrintById = $updateBallotStatus->is_re_print_by_id;
                    $rePrintBy = $updateBallotStatus->is_re_print_by;
                    $rePrintAt = $updateBallotStatus->is_re_print_at;
                    $rePrintId = $updateBallotStatus->re_print_id;
                }
                
                if( $this->ballotIn == true){
                    $statusType = 'IN';
                }else{
                    $statusType = 'OUT';
                }
                
                $addBallotHistory = BallotHistory::create([
                    'ballot_id' => $this->search,
                    'action' => 'Update',
                    'old_status' => $updateBallotStatus->current_status,
                    'old_status_type' => $updateBallotStatus->new_status_type,
                    'new_status' => $newStatus,
                    'new_status_type' => $statusType,
                    'status_by_id' => Auth::user()->id,
                    'status_by_name' => Auth::user()->name,
                    'status_by_at' => $now,
                    'status_by_at_date' => $now->toDateString(),
                    ]);
                    
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
                        ]);
                        
                        session()->flash('success', $this->search . ' Ballot Status Updated Successfully');
                        return redirect()->to('/ballot_tracking');
                    }
                }
            }
            
            //Clear Search
            public function clearSearch(){
                $this->search = '';
            }
            
            //Get Ballot History
            public function getBallotHistory($ballotId){
                $ballotResult = Ballots::find($ballotId);   
                $this->exportSingleId = $ballotId;
                $this->modalBallotHistoryList = BallotHistory::where('ballot_id', $ballotResult->ballot_id)->get();  
                $this->ballotHistoryCount = count($this->modalBallotHistoryList);
            }
            
            //Export Single Ballot History
            public function exportSingleBallotHistory($exportSingleId){
                $ballotSingleExportResult = Ballots::find($exportSingleId);   
                $ballotIdToExcel = $ballotSingleExportResult->ballot_id;
                $export = new ExportExcelSingleBallotHistory($ballotIdToExcel);
                return Excel::download($export, $ballotIdToExcel . '_single_ballot_history.xlsx');
            }
            
            //Export All Ballot History
            public function exportAllBallotHistory(){
                return Excel::download(new ExportExcelAllHistory, 'all_ballot_history.xlsx');
            }
            
            //Export Date Range Ballot History
            public function exportDateBallot(){
                if($this->dateFrom != null &&  $this->dateTo != null){
                    $export = new ExportExcelBallotDate($this->dateFrom, $this->dateTo);
                    return Excel::download($export, 'date_ballot_history.xlsx');
                }
            }
            
            //Export Based on Status Selected Ballot History
            public function exportStatusBallotHistory(){
                $statusSelected = $this->statusSelected;
                $export = new ExportExcelStatusBallotHistory($statusSelected);
                return Excel::download($export, $statusSelected . '_status_ballot_history.xlsx');
            }
            
            //Mount Function
            public function mount(){
                $this->searchMode = Auth::user()->is_search_mode;
                $this->ballotIn = Auth::user()->is_ballot_in;
                $this->verificationBadMode = Auth::user()->is_verification_type_bad;
                $this->comelecRolesList = ComelecRoles::all();
            }
            
            public function render()
            {
                // reverse
                if( $this->ballotIn == true){
                    $statusType = 'OUT';
                }else{
                    $statusType = 'IN';
                }
                
                if($this->searchMode == true){
                    return view('livewire.rr-ballot-tracking.barcode-function', [
                        'userList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->
                        orWhere('bgy_name', 'like', '%'.$this->search.'%')->
                        orWhere('mun_name', 'like', '%'.$this->search.'%')->
                        orWhere('prov_name', 'like', '%'.$this->search.'%')->
                        orWhere('pollplace', 'like', '%'.$this->search.'%')->
                        orWhere('current_status', 'like', '%'.$this->search.'%')->
                        orWhere('status_updated_at', 'like', '%'.$this->search.'%')->
                        paginate(20),
                        'userListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->
                        orWhere('bgy_name', 'like', '%'.$this->search.'%')->
                        orWhere('mun_name', 'like', '%'.$this->search.'%')->
                        orWhere('prov_name', 'like', '%'.$this->search.'%')->
                        orWhere('pollplace', 'like', '%'.$this->search.'%')->
                        orWhere('current_status', 'like', '%'.$this->search.'%')->
                        orWhere('status_updated_at', 'like', '%'.$this->search.'%')->
                        count(),
                        ]);
                    }else{
                        if( Auth::user()->comelec_role == 'SHEETER' && Auth::user()->is_ballot_in == true ){
                            return view('livewire.rr-ballot-tracking.barcode-function', [
                                'userList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', 'PRINTER' )->paginate(20),
                                'userListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', 'PRINTER' )->count(),
                                ]);
                            }else{
                                return view('livewire.rr-ballot-tracking.barcode-function', [
                                    'userList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', Auth::user()->comelec_role )->where('new_status_type', $statusType )->paginate(20),
                                    'userListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('current_status', Auth::user()->comelec_role )->where('new_status_type', $statusType )->count(),
                                    ]);
                                }
                            }
                        }
                    }