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

class ClientLedgerList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $keywordMode = true;
    public $searchClientLedger = '';
    
    //GET CLIENT DATA
    public $clientDatabase = [];
    
    //GET SALES INVOICE ITEMS DATA
    public $salesInvoiceItems = [];
    
    public function clearSearch(){
        $this->searchClientLedger = '';
        $this->keywordMode = true;
    }
    
    public function mount(){
        $this->clientDatabase = ClientDatabase::all();
        $this->salesInvoiceItems = SalesInvoiceItem::all();
    }
    
    public function render()
    {
        if($this->keywordMode == true){
            return view('livewire.rr-smd-system.client-ledger-list', [
                'clientLedgerList' => ClientLedger::where('agency_id', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('agency_code', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('agency_name', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('pr_no', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('stock_no', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('sales_invoice_code', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('or_no', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('remarks', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('created_by_name', 'like', '%'.$this->searchClientLedger.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
                'clientLedgerListCount' => ClientLedger::where('agency_id', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('agency_code', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('agency_name', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('pr_no', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('stock_no', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('sales_invoice_code', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('or_no', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('remarks', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('created_by_name', 'like', '%'.$this->searchClientLedger.'%')
                ->orderBy('created_at', 'DESC')
                ->count(),
                ]
            );
        }
        
        if($this->keywordMode == false){
            return view('livewire.rr-smd-system.client-ledger-list', [
                'clientLedgerList' => ClientLedger::where('created_at', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('sales_invoice_created_at', 'like', '%'.$this->searchClientLedger.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
                'clientLedgerListCount' => ClientLedger::where('created_at', 'like', '%'.$this->searchClientLedger.'%')
                ->orWhere('sales_invoice_created_at', 'like', '%'.$this->searchClientLedger.'%')
                ->orderBy('created_at', 'DESC')
                ->count(),
                ]
            );
        }
    }
}
