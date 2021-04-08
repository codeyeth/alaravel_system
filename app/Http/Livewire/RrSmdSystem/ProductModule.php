<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use App\Models\ProductParent;
use App\Models\ProductSubParent;
use Illuminate\Support\Str;
use DB;

class ProductModule extends Component
{
    public $quantity;
    public $unit;
    public $descriptionOne;
    public $descriptionTwo;
    public $price;
    
    //ADD PRODUCTS
    public $productName;
    public $productSubName = [];
    public $productList = [];
    public $productSubList = [];
    public $editProductId;
    public $productAddMode = true;
    public $arrayCountUpdate;
    
    public function addproductSubName(){
        $this->productSubName[] = [
            [ 'product_sub_id' => '', 'product_sub_name' => '',]
        ];
    }
    
    // ADD INPUT WHEN UPDATE MODE IS ENABLED
    public function addUpdateProductSubName(){
        $this->productSubName[$this->arrayCountUpdate]['product_sub_id'] = '0000';
        $this->productSubName[$this->arrayCountUpdate]['product_sub_name'] = '';
        $this->arrayCountUpdate++;
    }
    
    public function removeProductSubName($index){
        unset($this->productSubName[$index]);
        $this->productSubName = array_values($this->productSubName);
    }
    
    public function refreshTrick(){
        $this->productName = '';
        $this->productSubName = [];
        $this->productAddMode = true;
        //PRODUCT LIST
        $this->productList = ProductParent::all();
        $this->productSubList = ProductSubParent::all();
    }
    
    public function saveProduct(){
        $productCount = ProductParent::count() + 1;
        $productCode = str_pad($productCount,4,'0',STR_PAD_LEFT);
        
        $saveProduct = ProductParent::create([
            'product_code' => $productCode,
            'product_name' => Str::upper($this->productName),
            ]);
            
            foreach ($this->productSubName as $sub_name){
                $saveSubProduct = ProductSubParent::create([
                    'product_code' => $productCode,
                    'product_sub_code' => 'SUB'.$productCode,
                    'product_name' => Str::upper($sub_name['product_sub_name']),
                    ]);
                }
                session()->flash('messageSaveProduct', 'Product/s Added Successfully!');
                $this->refreshTrick();
            }
            
            public function editProduct($productId, $indexKey){
                $this->editProductId = $productId;
                $this->refreshTrick();
                
                $this->productAddMode = false;
                $postEdit = ProductParent::find($productId);
                $this->productName = $postEdit->product_name;
                
                $subProductList = DB::table('product_sub_parents')->where('product_code', $postEdit->product_code)->get();
                foreach($subProductList as $sub_product_list){
                    $indexKey++;
                    $this->arrayCountUpdate = $indexKey + 1;
                    $this->productSubName[$indexKey]['product_sub_id'] = $sub_product_list->id;
                    $this->productSubName[$indexKey]['product_sub_name'] = $sub_product_list->product_name;
                }
            }
            
            public function updateProduct($productId){
                $updateProduct = ProductParent::find($productId);
                $updateProduct->update(
                    ['product_name' => $this->productName]
                );
                
                foreach ($this->productSubName as $product_sub_name_for){
                    if( $product_sub_name_for['product_sub_id'] != "0000" ){
                        $updatesubProduct = ProductSubParent::find($product_sub_name_for['product_sub_id']);
                        $updatesubProduct->update(
                            ['product_name' => $product_sub_name_for['product_sub_name']]
                        );
                    }else{
                        ProductSubParent::create([
                            'product_code' => $updateProduct->product_code,
                            'product_sub_code' => 'SUB'.$updateProduct->product_code,
                            'product_name' => Str::upper($product_sub_name_for['product_sub_name']),
                            ]);
                        }
                    }
                    
                    session()->flash('messageSaveProduct', 'Publication Type/s Updated Successfully!');
                    $this->refreshTrick();
                }
                
                public function deleteProduct($productId){
                    $postDelete = ProductParent::find($productId);
                    DB::table('product_sub_parents')->where('product_code', $postDelete->product_code)->delete();
                    $postDelete->delete();
                    
                    session()->flash('messageSaveProduct', 'Deleted Successfully!');
                    $this->refreshTrick();
                }
                
                public function deleteSubProduct($productId){
                    $postDelete = ProductSubParent::find($productId);
                    $postDelete->delete();
                    session()->flash('messageSaveProduct', 'Deleted Successfully!');
                    $this->refreshTrick();
                }
                
                public function mount(){
                    $this->productList = ProductParent::all();
                    $this->productSubList = ProductSubParent::all();
                }
                
                public function render()
                {
                    return view('livewire.rr-smd-system.product-module');
                }
            }
            