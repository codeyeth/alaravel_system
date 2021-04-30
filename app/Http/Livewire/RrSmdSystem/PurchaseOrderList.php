<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PurchaseOrderModel;
use App\Models\PurchaseOrderItem;

use Illuminate\Support\Str;
use DB;
use Auth;
use Carbon\Carbon;

class PurchaseOrderList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $keywordMode = true;
    public $search = '';
    
    public $parentPurchaseOrderDetails = [];
    public $childPurchaseOrderDetails = [];
    public $showPurchaseOrderModal = false ;
    
    protected $listeners = ['refreshTable'];

    public function clearSearch(){
        $this->search = '';
        $this->keywordMode = true;
    }
    
    public function updatedKeywordMode()
    {
        $this->search = '';
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function refreshTable(){
        $this->resetPage();
    }
    
    public function getPurchaseOrder($id){
        $this->showPurchaseOrderModal = true;
        $this->parentPurchaseOrderDetails = PurchaseOrderModel::find($id);
        $this->childPurchaseOrderDetails = PurchaseOrderItem::where('purchase_order_no', $this->parentPurchaseOrderDetails->purchase_order_no)->get();
    }
    
    public function render()
    {
        if($this->keywordMode == true){
            return view('livewire.rr-smd-system.purchase-order-list', [
                'purchaseOrderList' => PurchaseOrderModel::where('purchase_order_no', 'like', '%'.$this->search.'%')
                ->orWhere('agency_name', 'like', '%'.$this->search.'%')
                ->orWhere('agency_address', 'like', '%'.$this->search.'%')
                ->orWhere('goods_type', 'like', '%'.$this->search.'%')
                ->orWhere('po_source', 'like', '%'.$this->search.'%')
                ->orWhere('created_by_name', 'like', '%'.$this->search.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
                'purchaseOrderListCount' => PurchaseOrderModel::where('purchase_order_no', 'like', '%'.$this->search.'%')
                ->orWhere('agency_name', 'like', '%'.$this->search.'%')
                ->orWhere('agency_address', 'like', '%'.$this->search.'%')
                ->orWhere('goods_type', 'like', '%'.$this->search.'%')
                ->orWhere('po_source', 'like', '%'.$this->search.'%')
                ->orWhere('created_by_name', 'like', '%'.$this->search.'%')
                ->orderBy('created_at', 'DESC')
                ->count(),
                ]
            );
        }
        
        if($this->keywordMode == false){
            return view('livewire.rr-smd-system.purchase-order-list', [
                'purchaseOrderList' => PurchaseOrderModel::where('created_at', 'like', '%'.$this->search.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
                'purchaseOrderListCount' => PurchaseOrderModel::where('created_at', 'like', '%'.$this->search.'%')
                ->orderBy('created_at', 'DESC')
                ->count(),
                ]
            );
        }
        
    }
}