<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use App\Models\ProductParent;
use App\Models\ProductSubParent;
use App\Models\ClientDatabase;
use App\Models\ProductItems;
use App\Models\PurchaseOrderModel;
use App\Models\PurchaseOrderItem;

use Illuminate\Support\Str;
use DB;
use Auth;
use Carbon\Carbon;

class PurchaseOrder extends Component
{
    public $search = '';
    
    // public $salesInvoiceNumber;
    public $agencyId;
    public $agencyCode;
    public $agencyName;
    public $agencyAddress;
    public $region;
    public $contactPerson;
    public $contactNo;
    public $emailAddress;
    
    public $poSource = '';
    
    //ENCODING FROM STOCK FORM
    public $itemList = [];
    public $goodsType = '';
    public $formType = '';
    
    //GET CLIENT DATABASE
    public $clientDatabase = [];
    public $showClientDatabaseTable = false;
    
    //PRODUCT DETAILS
    public $productParentFor = [];
    public $productSubParentFor = [];
    public $productItemsFor = [];
    public $productParent = '';
    public $productSubParent = '';
    public $productItems = '';
    public $itemListCount;
    
    public function searchClientDatabase(){
        if($this->agencyName != ''){
            $this->clientDatabase = ClientDatabase::where('agency_name', 'like', '%'.$this->agencyName.'%')->get();
            $this->showClientDatabaseTable = true;
        }else{
            $this->clientDatabase = [];
            $this->showClientDatabaseTable = false;
        }
    }
    
    public function getClientDatabase($clientId){
        $clientData = ClientDatabase::find($clientId);
        $this->agencyId = $clientData->id;
        $this->agencyCode = $clientData->agency_code;
        $this->agencyName = $clientData->agency_name;
        $this->agencyAddress = $clientData->agency_address;
        $this->region = $clientData->region;
        $this->contactPerson = $clientData->contact_person;
        $this->contactNo = $clientData->contact_no;
        $this->emailAddress = $clientData->email;
        
        $this->clientDatabase = [];
        $this->showClientDatabaseTable = false;
    }
    
    public function spitMatchedSubProduct($parentProductCode){
        $this->productSubParentFor = [];
        $this->productItemsFor = [];
        
        $this->productSubParent = '';
        $this->productItems = '';
        
        $selectFromSubProductFirst = ProductSubParent::where('product_code', $parentProductCode)->count();
        if($selectFromSubProductFirst > 0){
            $this->productSubParentFor =  ProductSubParent::where('product_code', $parentProductCode)->get();
        }else{
            $this->productItemsFor = ProductItems::where('product_code', $this->productParent)->get();
        }
    }
    
    public function spitMatchedProductItems(){
        $this->productItemsFor = [];
        $this->productItems = '';
        
        $this->productItemsFor = ProductItems::where('product_code', $this->productParent)->where('product_sub_code', $this->productSubParent)->get();
    }
    
    public function addItemList($productItemId){
        $productItems = ProductItems::find($productItemId);
        
        $productParent =  ProductParent::where('product_code', $productItems->product_code)->value('product_name');
        $productCode =  ProductParent::where('product_code', $productItems->product_code)->value('product_code');
        $productSubParentCount = ProductSubParent::where('product_code', $productItems->product_code)->count();
        if($productSubParentCount > 0){
            $productSubParent = ProductSubParent::where('product_code', $productItems->product_code)->where('product_sub_code', $productItems->product_sub_code)->value('product_name');
        }
        $this->itemListCount++;
        
        $this->itemList[] =
        [[
            'formType' => '', 
            'itemDescription' => '', 
            'unit' => '', 
            'quantity' => '', 
            'price' => '', 
            'additionalDescription' => '', 
            ]
        ];
        
        $indexKey = $this->itemListCount - 1;
        
        if( $productCode == '0001' ){
            $this->itemList[$indexKey]['formType'] = 'NAF';
        }elseif( $productCode == '0002' ){
            $this->itemList[$indexKey]['formType'] = 'AF';
        }else{
            $this->itemList[$indexKey]['formType'] = 'SF';
        }
        
        // $this->itemList[$indexKey]['formType'] = $productCode;
        
        $this->itemList[$indexKey]['itemDescription'] = $productParent . ' ' . $productItems->form_no;
        $this->itemList[$indexKey]['unit'] = $productItems->unit;
    }
    
    public function addItemListManual(){
        $this->itemListCount++;
        $indexKey = $this->itemListCount - 1;
        
        $this->itemList[] =
        [[
            'formType' => '', 
            'itemDescription' => '', 
            'unit' => '', 
            'quantity' => '', 
            'price' => '', 
            'additionalDescription' => '', 
            ]
        ];
        $this->itemList[$indexKey]['formType'] = $this->formType;
        
    }
    
    public function removeItem($index){
        unset($this->itemList[$index]);
        $this->itemList = array_values($this->itemList);
        $this->itemListCount--;
    }
    
    public function refreshTrick(){
        $this->agencyCode = '';
        $this->agencyName = '';
        $this->agencyAddress = '';
        $this->region = '';
        $this->contactPerson = '';
        $this->contactNo = '';
        $this->emailAddress = '';
        $this->poSource = '';
        
        //ENCODING FROM STOCK FORM
        $this->itemList = [];
        $this->itemListCount = '';
        $this->goodsType = '';
        
        //GET CLIENT DATABASE
        $this->clientDatabase = [];
        $this->showClientDatabaseTable = false;
        
        //PRODUCT DETAILS
        // $this->productParentFor = [];
        $this->productSubParentFor = [];
        $this->productItemsFor = [];
        $this->productParent = '';
        $this->productSubParent = '';
        $this->productItems = '';

        $this->emit('newPurchaseOrderAdded');

    }
    
    public function resetGoodsType(){
        //ENCODING FROM STOCK FORM
        $this->itemList = [];
        $this->itemListCount = '';
        $this->formType = '';
        
        //PRODUCT DETAILS
        $this->productSubParentFor = [];
        $this->productItemsFor = [];
        $this->productParent = '';
        $this->productSubParent = '';
        $this->productItems = '';
    }
    
    public function savePurchaseOrder(){
        $now = Carbon::now();
        
        $purchaseOrderCount = PurchaseOrderModel::count() + 1;
        $purchaseOrderNumber = str_pad($purchaseOrderCount,6,'0',STR_PAD_LEFT);
        
        if(count($this->itemList) > 0){
            $savePurchaseOrder = 
            PurchaseOrderModel::create
            ([
                'purchase_order_no' => $purchaseOrderNumber,
                'agency_id' => $this->agencyId,
                'agency_code' => Str::upper($this->agencyCode),
                'agency_name' => Str::upper($this->agencyName),
                'agency_address' => Str::upper($this->agencyAddress),
                'region' => Str::upper($this->region),
                'contact_person' => Str::upper($this->contactPerson),
                'contact_no' => $this->contactNo,
                'email' => Str::upper($this->emailAddress),
               
                'goods_type' => Str::upper($this->goodsType),
                'po_source' => $this->poSource,
            
                'created_by_id' => Auth::user()->id,
                'created_by_name' => Str::upper(Auth::user()->name),
                'date' => $now->toDateString(),
             
                ]
            );
            
            foreach ($this->itemList as $item_list){
                $savePurchaseOrderTotal = $item_list['quantity'] * $item_list['price'];
                
                $savePurchaseOrderItem = 
                PurchaseOrderItem::create
                ([
                    'purchase_order_no' => $savePurchaseOrder->purchase_order_no,
                    'quantity' => $item_list['quantity'],
                    'unit' => Str::upper($item_list['unit']),
                    'item_description' => Str::upper($item_list['itemDescription']),
                    'additional_description' => Str::upper($item_list['additionalDescription']),
                    'price' => Str::upper($item_list['price']),
                    'total' => $savePurchaseOrderTotal,
                    'created_by_id' => Auth::user()->id,
                    'created_by_name' => Str::upper(Auth::user()->name),
                    'form_type' => Str::upper($item_list['formType']),
                    ]
                );
            }
            
            session()->flash('messagePurchaseOrder', 'Purchase Order Saved Successfully!');
            $this->refreshTrick();
        }else{
            session()->flash('messageItemsRequired', 'Purchase Order Items is Required!');
        }
        
    }

    public function mount(){
        //GET PRODUCT PARENT
        $this->productParentFor = ProductParent::all();
    }
    
    public function render()
    {
        return view('livewire.rr-smd-system.purchase-order');
    }
}
