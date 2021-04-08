<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use App\Models\ProductParent;
use App\Models\ProductSubParent;
use Illuminate\Support\Str;
use DB;

class SalesInvoiceModule extends Component
{
    public $salesInvoiceNumber;
    public $agencyName;
    public $agencyAddress;
    public $region;
    public $contactPerson;
    public $contactNo;
    public $emailAddress;
    public $transactionType = '';
    public $workOrderkNo;
    public $stockNo;
    public $siCode;
    
    //ENCODING FROM STOCK FORM
    public $itemList = [];
    
    public function addItemList(){
        $this->itemList[] = [
            [ 'quantity' => '', 'unit' => '', 'descriptionOne' => '', 
            'descriptionTwo' => '', 'price' => '', ]
        ];
    }
    
    public function removeItem($index){
        unset($this->itemList[$index]);
        $this->itemList = array_values($this->itemList);
    }
    
    public function mount(){
        $Number = 1;
        $this->salesInvoiceNumber = str_pad($Number,6,'0',STR_PAD_LEFT);
    }
    
    public function render()
    {
        return view('livewire.rr-smd-system.sales-invoice-module');
    }
}
