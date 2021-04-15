<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;

use App\Models\ProductItems;
use App\Models\ClientDatabase;
use App\Models\ClientLedger;
use App\Models\SalesInvoice;

use Carbon\Carbon;

class ActionBar extends Component
{
    public $salesInvoiceTodayCount;
    public $postedTransactionCount;
    public $now;
    
    public function mount(){
        $this->now = Carbon::now()->toDateString();
        
        $this->salesInvoiceTodayCount = SalesInvoice::where('created_at', 'like', '%'.$this->now.'%')->count();
        $this->postedTransactionCount = ClientLedger::where('created_at', 'like', '%'.$this->now.'%')->count();
    }
    
    public function render()
    {
        return view('livewire.rr-smd-system.action-bar');
    }
}