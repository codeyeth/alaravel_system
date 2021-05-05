<?php

namespace App\Http\Livewire\RrBallotTracking;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Ballots;
use App\Models\BallotHistory;
use App\Models\BadBallots;
use App\Models\User;
use Auth;
use DB;

class StatusView extends Component
{
    //COUNTS
    public $logList = [];
    public $totalBallots;
    public $remainingBallots;
    public $printedBallots;
    
    public $rePrints;
    public $printedRePrintsSuccessful;
    public $printedRePrintsFailed;
    public $printedRePrintsPending;
    public $printedRePrintsPrinting;
    public $printedRePrintsToVerify;
    
    public $deliveredBallots;
    public $outForDeliveryBallots;
    
    public $sheeter;
    public $temporaryStorage;
    public $verification;
    public $quarantine;
    public $comelecDelivery;
    public $npoSmd;
    public $releasedNoOwner;
    
    protected $listeners = ['refreshContent'];
    
    //ADD LOG TO THE logList ARRAY
    public function refreshContent($logMessage, $userName){
        $now = Carbon::now();
        $this->logList [] = ['logMessage' => $logMessage, 'userName' => $userName, 'now' => $now->toDateTimeString()];
        $logsCount = count($this->logList) - 1;
        $this->emit('scrollToTop', $logsCount);
        $this->countMetrics();
    }
    
    public function countMetrics(){
        $this->totalBallots = Ballots::sum('cluster_total');
        $this->printedBallots = Ballots::where('current_status', '!=', 'PRINTER')->sum('cluster_total');
        $this->remainingBallots = $this->totalBallots - $this->printedBallots;
        
        $this->rePrints = BadBallots::all()->count();
        $this->printedRePrintsSuccessful = BadBallots::where('is_reprint_done_successful', true)->count();
        $this->printedRePrintsFailed = BadBallots::where('is_reprint_done_successful', false)->where('is_reprint_done_successful_by_id', '!=', null)->count();
        
        $this->printedRePrintsPending = BadBallots::where('reprint_batch', null)->orWhere('is_reprint_batch_start', false)->count();

        $this->printedRePrintsPrinting = BadBallots::where('is_reprint_batch_start', true)->where('is_reprint_done', false)->count();

        $this->printedRePrintsToVerify = BadBallots::where('is_reprint_done', true)->where('is_reprint_done_successful_by_id', null)->count();
        
        $this->outForDeliveryBallots = Ballots::where('is_out_for_delivery', true)->where('is_delivered', false)->sum('cluster_total');
        $this->deliveredBallots = Ballots::where('is_delivered', true)->sum('cluster_total');
        
        //// HANDLERS POSSESSION COUNT
        $this->sheeter = Ballots::where('current_status', 'SHEETER')->where('new_status_type', 'IN')->sum('cluster_total');
        $this->temporaryStorage = Ballots::where('current_status', 'TEMPORARY STORAGE')->where('new_status_type', 'IN')->sum('cluster_total');
        $this->verification = Ballots::where('current_status', 'VERIFICATION')->where('new_status_type', 'IN')->sum('cluster_total');
        $this->quarantine = Ballots::where('current_status', 'QUARANTINE')->where('new_status_type', 'IN')->sum('cluster_total');
        $this->comelecDelivery = Ballots::where('current_status', 'COMELEC DELIVERY')->where('new_status_type', 'IN')->sum('cluster_total');
        $this->npoSmd = Ballots::where('current_status', 'NPO SMD')->where('new_status_type', 'IN')->sum('cluster_total');
        $this->releasedNoOwner = Ballots::where('new_status_type', 'OUT')->sum('cluster_total');
    }
    
    public function mount(){
        $this->countMetrics();
    }
    
    public function render()
    {
        return view('livewire.rr-ballot-tracking.status-view');
    }
}
