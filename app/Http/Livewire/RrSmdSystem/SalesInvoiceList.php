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
    
    protected $listeners = ['refreshTable'];
    
    
    //SALES INVOICE DETAILS
    public $showViewSalesInvoiceModal = false;
    public $parentSalesInvoiceDetails = [];
    public $childSalesInvoiceDetails = [];
    
    // UPDATE CONTROL NUMBERS
    public $prNo;
    public $drNo;
    public $orNo;
    
    public function clearSearch(){
        $this->searchSalesInvoice = '';
        $this->keywordMode = true;
    }
    
    public function refreshTable(){
        $this->resetPage();
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
    }
    
    public function getSalesInvoice($siID){
        $this->showViewSalesInvoiceModal = true;
        $this->parentSalesInvoiceDetails = SalesInvoice::find($siID);
        $this->childSalesInvoiceDetails = SalesInvoiceItem::where('sales_invoice_code', $this->parentSalesInvoiceDetails->sales_invoice_code)->get();
    }
    
    public function updateControlNumber($id){
        $siParent = SalesInvoice::find($id);
        
        $prNo = $this->prNo;
        $drNo = $this->drNo;
        $orNo = $this->orNo;
        
        if($prNo == ''){
            $prNo = $siParent->pr_no;
        }
        
        if($drNo == ''){
            $drNo = $siParent->dr_no;
        }
        
        if($orNo == ''){
            $orNo = $siParent->or_no;
        }
        
        $siParent->update([
            'pr_no' => $prNo,
            'dr_no' => $drNo,
            'or_no' => $orNo,
            ]
        );
        
        $this->parentSalesInvoiceDetails = SalesInvoice::find($id);
        $this->childSalesInvoiceDetails = SalesInvoiceItem::where('sales_invoice_code', $this->parentSalesInvoiceDetails->sales_invoice_code)->get();
        
        $this->prNo = '';
        $this->drNo = '';
        $this->orNo = '';
        
        session()->flash('messageControlNumberUpdate', 'Control Number/s Updated Successfully!');
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
                ->orWhere('payment_mode', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('package_type', 'like', '%'.$this->searchSalesInvoice.'%')    
                ->orWhere('created_by_name', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
                'salesInvoiceListCount' => SalesInvoice::where('sales_invoice_code', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('stock_no', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('agency_name', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('agency_address', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('transaction_type', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('payment_mode', 'like', '%'.$this->searchSalesInvoice.'%')
                ->orWhere('package_type', 'like', '%'.$this->searchSalesInvoice.'%')
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