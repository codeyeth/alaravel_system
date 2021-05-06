<?php

namespace App\Http\Livewire\RrBallotTracking;

use Livewire\Component;
use App\Models\Ballots;
use App\Models\BallotHistory;
use App\Models\BadBallots;
use App\Models\User;
use Auth;
use Livewire\WithPagination;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ComelecRoles;

//Excel Exports
use Maatwebsite\Excel\Facades\Excel;
use App\ExcelExports\ExportExcelSingleBallotHistory;
use App\ExcelExports\ExportExcelAllHistory;
use App\ExcelExports\ExportExcelBallotDate;
use App\ExcelExports\ExportExcelStatusBallotHistory;

use App\ExcelExports\ExportExcelRePrints;
use App\ExcelExports\ExportExcelDelivered;
use App\ExcelExports\ExportExcelBadBallots;
use App\ExcelExports\ExportExcelRePrintsHistory;
use App\ExcelExports\ExportExcelOutForDelivery;

class ReportModule extends Component
{
    public $comelecRolesList = [];
    public $statusSelected = '';
    public $statusType = '';
    public $dateFrom;
    public $dateTo;
    ///////////////////////////////REPORTS
    
    //EXPORT SINGLE BALLOT HISTORY
    public function exportSingleBallotHistory($exportSingleId){
        $ballotSingleExportResult = Ballots::find($exportSingleId);   
        $ballotIdToExcel = $ballotSingleExportResult->ballot_id;
        $export = new ExportExcelSingleBallotHistory($ballotIdToExcel);
        return Excel::download($export, $ballotIdToExcel . '_single_ballot_history.xlsx');
    }
    
    //EXPORT ALL BALLOT HISTORY
    public function exportAllBallotHistory(){
        return Excel::download(new ExportExcelAllHistory, 'all_ballot_history.xlsx');
    }
    
    //EXPORT DATE RANGE BALLOT HISTORY
    public function exportDateBallot(){
        if($this->dateFrom != null &&  $this->dateTo != null){
            $export = new ExportExcelBallotDate($this->dateFrom, $this->dateTo);
            $dateFromFormatted = Carbon::create($this->dateFrom)->toDayDateTimeString();
            $dateToFormatted = Carbon::create($this->dateTo)->toDayDateTimeString();
            return Excel::download($export, 'date_ballot_history' . ' ' . $dateFromFormatted . ' ' . $dateToFormatted . '.xlsx');
        }
    }
    
    //EXPORT BASED ON STATUS SELECTED BALLOT HISTORY
    public function exportStatusBallotHistory(){
        $statusSelected = $this->statusSelected;
        $statusType = $this->statusType;
        $export = new ExportExcelStatusBallotHistory($statusSelected, $statusType);
        return Excel::download($export, $statusSelected . '_status_ballot_history.xlsx');
    }
    
    //EXPORT REPRINTS (BALLOT ID)
    public function exportRePrints(){
        return Excel::download(new ExportExcelRePrints, 'reprinted_ballot.xlsx');
    }
    
    //EXPORT DELIVERED BALLOTS
    public function exportDelivered(){
        return Excel::download(new ExportExcelDelivered, 'delivered_ballots.xlsx');
    }
    
    //EXPORT OUT FOR DELIVERY BALLOTS
    public function exportOutForDelivery(){
        return Excel::download(new ExportExcelOutForDelivery, 'out_for_delivery_ballots.xlsx');
    }
    
    //EXPORT ALL BAD BALLOTS
    public function exportBadBallots(){
        return Excel::download(new ExportExcelBadBallots, 'bad_ballots.xlsx');
    }
    
    //EXPORT RE-PRINT HISTORY
    public function exportRePrintHistory(){
        return Excel::download(new ExportExcelRePrintsHistory, 're-prints_history.xlsx');
    }
    
    public function mount(){
        $this->comelecRolesList = ComelecRoles::all();
    }
    
    public function render()
    {
        return view('livewire.rr-ballot-tracking.report-module');
    }
}
