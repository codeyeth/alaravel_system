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
    public function refreshContent($logDetails, $userName){
        $now = Carbon::now();
        $this->logList [] = ['logDetails' => $logDetails, 'userName' => $userName, 'now' => $now->toDateTimeString()];
        $logsCount = count($this->logList) - 1;
        $this->emit('scrollToTop', $logsCount);
        $this->countMetrics();
    }
    
    public function countMetrics(){
        $this->totalBallots = Ballots::sum('cluster_total');
        $this->printedBallots = Ballots::where('current_status', '!=', 'PRINTER')->sum('cluster_total');
        $this->remainingBallots = $this->totalBallots - $this->printedBallots;
        $this->rePrints = BadBallots::all()->count();
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
