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

class BarcodeFunction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    public $searchMode;
    public $verificationBadMode;
    
    //Ballot Details
    public $modalBallotHistoryList = [];
    
    public $exportSingleId;
    public $ballotHistoryCount;
    
    public $dateFrom;
    public $dateTo;
    
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
    
    //Update Toggle Verification Bad Mode
    public function verificationBadModeToggle(){
        if( $this->verificationBadMode == true){
            $this->verificationBadMode = false;
            $updateMyVerificationMode = User::find(Auth::user()->id);
            $updateMyVerificationMode->update(['is_verification_type_bad' => false,]);
            session()->flash('success', 'Mode set to Verification Good');
        }else{
            $this->verificationBadMode = true;
            $updateMyVerificationMode = User::find(Auth::user()->id);
            $updateMyVerificationMode->update(['is_verification_type_bad' => true,]);
            session()->flash('success', 'Mode set to Verification Bad');
        }
    }
    
    //Update Ballot Status
    public function updateBallotStatus(){
        $now = Carbon::now();
        // dd($now);
        if($this->search != '' && $this->searchMode == false){
            $updateBallotStatus = Ballots::where('ballot_id', $this->search)->where('current_status', Auth::user()->comelec_role)->first();
            if($updateBallotStatus != null){
                if( $this->verificationBadMode == true ){
                    $addBallotHistory = BallotHistory::create([
                        'ballot_id' => $this->search,
                        'action' => 'Update',
                        'old_status' => $updateBallotStatus->current_status,
                        'new_status' => 'QUARANTINE',
                        'status_by_id' => Auth::user()->id,
                        'status_by_name' => Auth::user()->name,
                        'status_by_at' => $now,
                        'status_by_at_date' => $now->toDateString(),
                        ]);
                        
                        $updateBallotStatus->update([
                            'current_status' => 'QUARANTINE',
                            'status_updated_by_id' => Auth::user()->id,
                            'status_updated_by' => Auth::user()->name,
                            'status_updated_at' => $now,
                            'is_re_print' => true,
                            'is_re_print_by_id' => Auth::user()->id,
                            'is_re_print_by' => Auth::user()->name,
                            'is_re_print_at' =>$now,
                            're_print_id' =>$updateBallotStatus->ballot_id,
                            ]);
                        }else{
                            $addBallotHistory = BallotHistory::create([
                                'ballot_id' => $this->search,
                                'action' => 'Update',
                                'old_status' => $updateBallotStatus->current_status,
                                'new_status' => Auth::user()->barcoded_receiver,
                                'status_by_id' => Auth::user()->id,
                                'status_by_name' => Auth::user()->name,
                                'status_by_at' => $now,
                                'status_by_at_date' => $now->toDateString(),
                                ]);
                                
                                $updateBallotStatus->update([
                                    'current_status' => Auth::user()->barcoded_receiver,
                                    'status_updated_by_id' => Auth::user()->id,
                                    'status_updated_by' => Auth::user()->name,
                                    'status_updated_at' => $now,
                                    ]);
                                }
                                
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
                    
                    //Export Single Ballot History
                    public function exportDateBallot(){
                        $export = new ExportExcelBallotDate($this->dateFrom, $this->dateTo);
                        return Excel::download($export, 'date_ballot_history.xlsx');
                    }
                    
                    //Mount Function
                    public function mount(){
                        $this->searchMode = Auth::user()->is_search_mode;
                        $this->verificationBadMode = Auth::user()->is_verification_type_bad;
                    }
                    
                    public function render()
                    {
                        if($this->searchMode == true){
                            return view('livewire.rr-ballot-tracking.barcode-function', [
                                'userList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->
                                orWhere('bgy_name', 'like', '%'.$this->search.'%')->
                                orWhere('mun_name', 'like', '%'.$this->search.'%')->
                                orWhere('prov_name', 'like', '%'.$this->search.'%')->
                                orWhere('pollplace', 'like', '%'.$this->search.'%')->
                                orWhere('current_status', 'like', '%'.$this->search.'%')->
                                paginate(20),
                                'userListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->
                                orWhere('bgy_name', 'like', '%'.$this->search.'%')->
                                orWhere('mun_name', 'like', '%'.$this->search.'%')->
                                orWhere('prov_name', 'like', '%'.$this->search.'%')->
                                orWhere('pollplace', 'like', '%'.$this->search.'%')->
                                orWhere('current_status', 'like', '%'.$this->search.'%')->
                                count(),
                                ]);
                            }else{
                                return view('livewire.rr-ballot-tracking.barcode-function', [
                                    'userList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->paginate(20),
                                    'userListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->count(),
                                    ]);
                                }
                            }
                        }