<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use App\Models\ClientLedger;
use App\Models\ClientDatabase;

use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use Auth;

class ClientLedgerView extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    //ID FROM CLIENT LEDGER LIST
    public $client_id;
    
    public $clientDetails = [];
    public $clientLedger = [];
    public $salesInvoice = [];
    public $salesInvoiceItems = [];
    public $salesInvoiceTotal = [];
    
    
    public function mount(){
        $this->clientDetails = ClientDatabase::find($this->client_id);
        $this->clientLedger = ClientLedger::where('agency_id', $this->clientDetails->id)->orderBy('created_at', 'DESC')->get();
        
        $this->salesInvoice = SalesInvoice::all()->sortByDesc('created_at',);
        
        $this->salesInvoiceItems = SalesInvoiceItem::all()->sortByDesc('created_at',);
        
        // $this->salesInvoiceTotal = 
        // dd($this->salesInvoiceItems[0]->total);
    }
    
    public function render()
    {
        return view('livewire.rr-smd-system.client-ledger-view');
    }
}