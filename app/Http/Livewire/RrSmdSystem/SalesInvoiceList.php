<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use App\Models\ClientLedger;

use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use Auth;

class SalesInvoiceList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $keywordMode = true;
    public $searchSalesInvoice = '';
    public $remarks;
    
    public function clearSearch(){
        $this->searchSalesInvoice = '';
        $this->keywordMode = true;
    }
    
    public function postToLedger($id){
        $now = Carbon::now();
        $siParent = SalesInvoice::find($id);
        
        $postToLedger = 
        ClientLedger::create
        ([
            'agency_id' => $siParent->agency_id,
            'agency_code' => $siParent->agency_code,
            
            'pr_no' => $siParent->pr_no,
            'stock_no' => $siParent->stock_no,
            
            'sales_invoice_created_at' => $siParent->created_at,
            'sales_invoice_code' => $siParent->sales_invoice_code,
            'or_no' => $siParent->or_no,
            
            'remarks' => Str::upper($this->remarks),
            
            'created_by_id' => Auth::user()->id,
            'created_by_name' => Str::upper(Auth::user()->name),
            ]
        );
        
        $siParent->update([
            'is_posted' => true,
            'is_posted_by_id' => Auth::user()->id,
            'is_posted_by_name' => Str::upper(Auth::user()->name),
            'is_posted_at' => $now,
            ]
        );
        
        session()->flash('messagePostToLedger', 'Posted Successfully!');
        // $this->refreshTrick();
    }
    
    
    public function render()
    {
        if($this->keywordMode == true){
            return view('livewire.rr-smd-system.sales-invoice-list', [
                'salesInvoiceList' => SalesInvoice::where('sales_invoice_code', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('stock_no', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('agency_name', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('agency_address', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('transaction_type', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('payment_type', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('created_by_name', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
                'salesInvoiceListCount' => SalesInvoice::where('sales_invoice_code', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('stock_no', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('agency_name', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('agency_address', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('transaction_type', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('payment_type', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('created_by_name', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orderBy('created_at', 'DESC')
                ->count(),
                ]
            );
        }
        
        if($this->keywordMode == false){
            return view('livewire.rr-smd-system.sales-invoice-list', [
                'salesInvoiceList' => SalesInvoice::where('created_at', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
                'salesInvoiceListCount' => SalesInvoice::where('created_at', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orderBy('created_at', 'DESC')
                ->count(),
                ]
            );
        }
        
    }
}