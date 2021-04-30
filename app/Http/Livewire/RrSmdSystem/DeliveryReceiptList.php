<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use App\Models\ClientLedger;
use App\Models\SmdDeliveryReceipt;

use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use Auth;

class DeliveryReceiptList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $keywordMode = true;
    public $searchDeliverReceipt = '';
    
    //GET THE DR DETAILS
    public $showViewDrModal = false;
    public $parentDr = [];
    public $childDr = [];
    
    public $issuedBy;
    public $receivedBy;
    public $noOfBundles;
    public $remarks;
    
    public function clearSearch(){
        $this->searchDeliverReceipt = '';
        $this->keywordMode = true;
    }
    
    public function updatedKeywordMode()
    {
        $this->searchDeliverReceipt = '';
    }
    
    public function updatingSearchDeliverReceipt()
    {
        $this->resetPage();
    }
    
    public function getDr($id){
        $this->showViewDrModal = true;
        $this->parentDr = SmdDeliveryReceipt::find($id);
        $this->childDr = SalesInvoiceItem::where('sales_invoice_code', $this->parentDr->sales_invoice_code)->get();
        
        $this->issuedBy = $this->parentDr->issued_by;
        $this->receivedBy = $this->parentDr->received_by;
        $this->noOfBundles = $this->parentDr->no_of_bundles;
        $this->remarks = $this->parentDr->remarks;
    }
    
    public function updateSaveDetails($id){
        $drParent = SmdDeliveryReceipt::find($id);
        
        $issuedBy = $this->issuedBy;
        $receivedBy = $this->receivedBy;
        $noOfBundles = $this->noOfBundles;
        $remarks = $this->remarks;
        
        if($issuedBy == ''){
            $issuedBy = $drParent->issued_by;
        }
        
        if($receivedBy == ''){
            $receivedBy = $drParent->received_by;
        }
        
        if($noOfBundles == ''){
            $noOfBundles = $drParent->no_of_bundles;
        }
        
        if($remarks == ''){
            $remarks = $drParent->remarks;
        }
        
        $drParent->update([
            'issued_by' => Str::upper($issuedBy),
            'received_by' => Str::upper($receivedBy),
            'no_of_bundles' => $noOfBundles,
            'remarks' => Str::upper($remarks),
            ]
        );
        
        session()->flash('messageDrUpdate', 'Details Saved/Updated Successfully!');
    }
    
    public function markAsDelivered($id){
        $now = Carbon::now();
        
        $drParent = SmdDeliveryReceipt::find($id);
        $siParent = SalesInvoice::find($drParent->sales_invoice_id);
        $drParent->update([
            'is_delivered' => true,
            'is_delivered_by_id' => Auth::user()->id,
            'is_delivered_by_name' => Auth::user()->name,
            'is_delivered_at' => $now,
            ]
        );
        $siParent->update([
            'is_delivered' => true,
            'is_delivered_by_id' => Auth::user()->id,
            'is_delivered_by_name' => Auth::user()->name,
            'is_delivered_at' => $now,
            ]
        );
        session()->flash('messageDrDelivered', 'DR Set as Delivered Successful!');
    }
    
    public function render()
    {
        if($this->keywordMode == true){
            return view('livewire.rr-smd-system.delivery-receipt-list', [
                'drList' => SmdDeliveryReceipt::where('dr_no', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orWhere('sales_invoice_code', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orWhere('stock_no', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orWhere('or_no', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orWhere('agency_name', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orWhere('created_by_name', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
                'drListCount' => SmdDeliveryReceipt::where('dr_no', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orWhere('sales_invoice_code', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orWhere('stock_no', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orWhere('or_no', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orWhere('agency_name', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orWhere('created_by_name', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orderBy('created_at', 'DESC')
                ->count(),
                ]
            );
        }
        
        if($this->keywordMode == false){
            return view('livewire.rr-smd-system.delivery-receipt-list', [
                'drList' => SmdDeliveryReceipt::where('created_at', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
                'drListCount' => SmdDeliveryReceipt::where('created_at', 'like', '%'.$this->searchDeliverReceipt.'%')
                ->orderBy('created_at', 'DESC')
                ->count(),
                ]
            );
        }
        
    }
}
