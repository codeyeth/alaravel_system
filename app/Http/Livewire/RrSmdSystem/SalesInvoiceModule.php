<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use App\Models\ProductParent;
use App\Models\ProductSubParent;
use App\Models\ClientDatabase;
use App\Models\ProductItems;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;

use Illuminate\Support\Str;
use DB;
use Auth;

class SalesInvoiceModule extends Component
{
    public $salesInvoiceNumber;
    public $agencyCode;
    public $agencyName;
    public $agencyAddress;
    public $region;
    public $contactPerson;
    public $contactNo;
    public $emailAddress;
    public $transactionType = '';
    public $paymentType = '';
    public $packageType = '';
    public $workOrderNo;
    public $code;
    public $issuedBy;
    public $stockNo;
    
    // public $siCode;
    
    //ENCODING FROM STOCK FORM
    public $itemList = [];
    
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
        $productSubParentCount = ProductSubParent::where('product_code', $productItems->product_code)->count();
        if($productSubParentCount > 0){
            $productSubParent = ProductSubParent::where('product_code', $productItems->product_code)->where('product_sub_code', $productItems->product_sub_code)->value('product_name');
        }
        $this->itemListCount++;
        
        $this->itemList[] =
        [[
            'itemDescription' => '', 
            'unit' => '', 
            'quantity' => '', 
            'price' => '', 
            'additionalDescription' => '', 
            ]
        ];
        
        $indexKey = $this->itemListCount - 1;
        $this->itemList[$indexKey]['itemDescription'] = $productParent . ' ' . $productItems->form_no;
        $this->itemList[$indexKey]['unit'] = $productItems->unit;
    }
    
    public function removeItem($index){
        unset($this->itemList[$index]);
        $this->itemList = array_values($this->itemList);
        $this->itemListCount--;
        
        // $this->productParent = '';
        // $this->productSubParentFor = [];
        // $this->productItemsFor = [];
    }
    
    public function refreshTrick(){
        $salesInvoiceCount = SalesInvoice::count() + 1;
        $this->salesInvoiceNumber = str_pad($salesInvoiceCount,6,'0',STR_PAD_LEFT);
        
        $this->agencyCode = '';
        $this->agencyName = '';
        $this->agencyAddress = '';
        $this->region = '';
        $this->contactPerson = '';
        $this->contactNo = '';
        $this->emailAddress = '';
        $this->transactionType = '';
        $this->paymentType = '';
        $this->packageType = '';
        $this->workOrderNo = '';
        $this->code = '';
        $this->issuedBy = '';
        $this->stockNo = '';
        
        //ENCODING FROM STOCK FORM
        $this->itemList = [];
        
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
    }
    
    public function saveSalesInvoice(){
        if(count($this->itemList) > 0){
            $saveSalesInvoice = 
            SalesInvoice::create
            ([
                'sales_invoice_code' => $this->salesInvoiceNumber,
                'code' => $this->code,
                'agency_code' => Str::upper($this->agencyCode),
                'agency_name' => Str::upper($this->agencyName),
                'agency_address' => Str::upper($this->agencyAddress),
                'region' => Str::upper($this->region),
                'contact_person' => Str::upper($this->contactPerson),
                'contact_no' => Str::upper($this->contactNo),
                'email' => Str::upper($this->emailAddress),
                'payment_type' => $this->paymentType,
                'transaction_type' => $this->transactionType,
                'work_order_no' => $this->workOrderNo,
                'stock_no' => $this->stockNo,
                'issued_by' => Str::upper($this->issuedBy),
                'created_by_id' => Auth::user()->id,
                'created_by_name' => Str::upper(Auth::user()->name),
                ]
            );
            
            foreach ($this->itemList as $item_list){
                $salesInvoiceTotal = $item_list['quantity'] * $item_list['price'];
                
                $saveSalesInvoiceItem = 
                SalesInvoiceItem::create
                ([
                    'sales_invoice_code' => $saveSalesInvoice->sales_invoice_code,
                    'quantity' => $item_list['quantity'],
                    'unit' => Str::upper($item_list['unit']),
                    'item_description' => Str::upper($item_list['itemDescription']),
                    'additional_description' => Str::upper($item_list['additionalDescription']),
                    'price' => Str::upper($item_list['price']),
                    'total' => $salesInvoiceTotal,
                    'created_by_id' => Auth::user()->id,
                    'created_by_name' => Str::upper(Auth::user()->name),
                    ]
                );
            }
            
            session()->flash('messageSalesInvoice', 'Sales Invoice Created Successfully!');
            $this->refreshTrick();
        }else{
            session()->flash('messageItemsRequired', 'Sales Invoice Items is Required!');
        }
        
    }
    
    public function mount(){
        $salesInvoiceCount = SalesInvoice::count() + 1;
        $this->salesInvoiceNumber = str_pad($salesInvoiceCount,6,'0',STR_PAD_LEFT);
        
        //GET PRODUCT PARENT
        $this->productParentFor =  ProductParent::all();
    }
    
    public function render()
    {
        return view('livewire.rr-smd-system.sales-invoice-module');
    }
}
