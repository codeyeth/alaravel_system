<?php

namespace App\Http\Livewire\RrHomeDashboard;

use Livewire\Component;
use App\Models\Ballots;
use DB;
use Auth;

class HomeDashboard extends Component
{
    public $allBallots;
    public $allPrintedBallots;
    public $remainingBallots;
    public $possesionBallots;
    
    public function mount(){
        // $this->allBallots = Ballots::sum('cluster_total');
        // $this->allPrintedBallots = Ballots::where('current_status', '!=', 'PRINTER')->sum('cluster_total');
        // $this->remainingBallots = Ballots::where('current_status', 'PRINTER')->sum('cluster_total');
        // $this->possesionBallots = Ballots::where('current_status', Auth::user()->comelec_role)->sum('cluster_total');
    }
    
    public function render()
    {
        return view('livewire.rr-home-dashboard.home-dashboard');
    }
}