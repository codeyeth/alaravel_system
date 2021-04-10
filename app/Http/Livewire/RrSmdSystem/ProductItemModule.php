<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use App\Models\ProductParent;
use App\Models\ProductSubParent;
use App\Models\ProductItems;
use Illuminate\Support\Str;
use DB;
use Auth;

class ProductItemModule extends Component
{
    public $itemAddMode = true;
    public $editItemId;
    public $search = '';
    
    //GET THE PRODUCTS
    public $selectedProduct = '';
    public $selectedSubProduct = '';
    public $productParentSelect = [];
    public $productSubParentSelect = [];
    
    //FOR LOOP TO SHOW PRODUCT NAMES
    public $parentProductFor = [];
    public $subProductFor = [];
    
    //ITEM LIST
    public $itemList = [];
    
    public function clearSearch(){
        $this->search = '';
    }
    
    public function refreshTrick(){
        $this->selectedProduct = '';
        $this->selectedSubProduct = '';
        $this->itemList = [];
        $this->itemAddMode = true;
        //PRODUCT LIST
        $this->productSubParentSelect = [];
    }
    
    public function addItem(){
        $this->itemList[] = [
            [ 'form_no' => '', 'description' => '', 'unit' => '',]
        ];
    }
    
    public function removeItem($index){
        unset($this->itemList[$index]);
        $this->itemList = array_values($this->itemList);
    }
    
    public function spitMatchedSubProduct($productCode){
        $this->productSubParentSelect = ProductSubParent::where('product_code', $productCode)->get();
        $this->selectedSubProduct = '';
    }
    
    public function saveItem(){
        foreach ($this->itemList as $item_list){
            $saveItem = ProductItems::create([
                'product_code' => $this->selectedProduct,
                'product_sub_code' => $this->selectedSubProduct,
                'form_no' => Str::upper($item_list['form_no']),
                'description' => Str::upper($item_list['description']),
                'unit' => Str::upper($item_list['unit']),
                'created_by_id' => Auth::user()->id,
                'created_by_name' => Str::upper(Auth::user()->name),
                ]);
            }
            
            session()->flash('messageItem', 'Items Added Successfully!');
            $this->refreshTrick();
        }
        
        public function editItem($itemId, $indexKey){
            $this->editItemId = $itemId;
            $this->refreshTrick();
            
            $this->itemAddMode = false;
            $postEdit = ProductItems::find($itemId);
            $this->selectedProduct = $postEdit->product_code;
            $this->selectedSubProduct = $postEdit->product_sub_code;
            $this->productSubParentSelect = ProductSubParent::where('product_code', $postEdit->product_code)->get();
            
            $this->itemList[$indexKey]['form_no'] = $postEdit->form_no;
            $this->itemList[$indexKey]['description'] = $postEdit->description;
            $this->itemList[$indexKey]['unit'] = $postEdit->unit;
        }
        
        public function updateItem($itemId){
            $updateItem = ProductItems::find($itemId);
            
            foreach ($this->itemList as $item_list){
                $updateItem->update([
                    'product_code' => $this->selectedProduct,
                    'product_sub_code' => $this->selectedSubProduct,
                    'form_no' => Str::upper($item_list['form_no']),
                    'description' => Str::upper($item_list['description']),
                    'unit' => Str::upper($item_list['unit']),
                    ]); 
                }
                
                session()->flash('messageItem', 'Item/s Updated Successfully!');
                $this->refreshTrick();
            }
            
            public function deleteItem($itemId){
                $postDelete = ProductItems::find($itemId);
                $postDelete->delete();
                
                session()->flash('messageItem', 'Deleted Successfully!');
                $this->refreshTrick();
            }
            
            public function mount(){
                $this->productParentSelect = ProductParent::all();
                
                //FOR LOOP TO SHOW PRODUCT NAMES
                $this->parentProductFor = ProductParent::all();
                $this->subProductFor = ProductSubParent::all();
            }
            
            public function render()
            {
                return view('livewire.rr-smd-system.product-item-module', [
                    'productItemList' => ProductItems::where('product_code', 'like', '%'.$this->search.'%')
                    ->orWhere('product_sub_code', 'like', '%'.$this->search.'%')
                    ->orWhere('form_no', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%')
                    ->orWhere('unit', 'like', '%'.$this->search.'%')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10),
                    'productItemListCount' =>  ProductItems::where('product_code', 'like', '%'.$this->search.'%')
                    ->orWhere('product_sub_code', 'like', '%'.$this->search.'%')
                    ->orWhere('form_no', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%')
                    ->orWhere('unit', 'like', '%'.$this->search.'%')
                    ->orderBy('created_at', 'DESC')
                    ->count(),
                    ]);
                }
            }
            