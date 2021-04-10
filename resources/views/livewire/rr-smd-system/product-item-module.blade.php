<div>
    {{-- MODAL PRODUCT ITEM --}}
    <div class="modal fade" id="modalProductItem" tabindex="-1" role="dialog" aria-labelledby="modalProductItem" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Item/s to Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ( $itemAddMode == true )
                <form wire:submit.prevent="saveItem" autocomplete="off">
                    @else
                    <form wire:submit.prevent="updateItem({{ $editItemId }})" autocomplete="off">
                        @endif
                        
                        @csrf
                        
                        @if(session('messageItem'))
                        <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-info mx-2"></i>
                            <strong style="font-size: 150%">  {!! Str::upper(session('messageItem')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                        </div>
                        @endif
                        
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">PRODUCT NAME <span class="requiredTag">&bullet;</span></strong>
                                            <select class="form-control" name="selectedProduct" id="selectedProduct" wire:model="selectedProduct" wire:change="spitMatchedSubProduct($event.target.value)" required>
                                                @if (count($productParentSelect) > 0)
                                                <option selected disabled value="">Select Product</option>
                                                @foreach ($productParentSelect as $item)
                                                <option value="{{ $item->product_code }}">{{ $item->product_name }}</option>
                                                @endforeach
                                                @else
                                                <option value="">No Product Found.</option>
                                                @endif
                                            </select>
                                        </div>
                                        @if (count($productSubParentSelect) > 0)
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">SUB-PRODUCT NAME <span class="requiredTag">&bullet;</span></strong>
                                            <select class="form-control" name="selectedSubProduct" id="selectedSubProduct" wire:model="selectedSubProduct" required>
                                                @if (count($productSubParentSelect) > 0)
                                                <option selected disabled value="">Select Sub-Product</option>
                                                @foreach ($productSubParentSelect as $item1)
                                                <option value="{{ $item1->product_sub_code }}">{{ $item1->product_name }}</option>
                                                @endforeach
                                                @else
                                                <option value="">No Sub-Product Found.</option>
                                                @endif
                                            </select>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            
                            @if ( $itemAddMode == true )
                            <button type="button" class="btn btn-accent btn-block" wire:click="addItem"><i class="material-icons">add</i>Add Item</button>
                            @endif
                            
                            <br>
                            
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>FORM NO</th>
                                        <th>DESCRIPTION</th>
                                        <th>UNIT</th>
                                        @if ( $itemAddMode == true )
                                        <th></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itemList as $index => $item_list)
                                    <tr>
                                        <td width="30%">
                                            <input type="text" class="form-control" placeholder="Form No" wire:model="itemList.{{$index}}.form_no" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Description" wire:model="itemList.{{$index}}.description" required>
                                        </td>
                                        <td width="10%">
                                            <input type="text" class="form-control" placeholder="Unit" wire:model="itemList.{{$index}}.unit" required>
                                        </td>
                                        @if ( $itemAddMode == true )
                                        <td width="5%">
                                            <button type="button" class="btn btn-danger btn-block" wire:click="removeItem({{$index}})"> <i class="material-icons">remove</i> Remove</button>
                                        </td>
                                        @endif
                                    </tr>      
                                    @endforeach
                                </tbody>
                            </table>
                            
                            @if (count($itemList) <= 0 )
                            <p style="text-align: center"> Click Add Item to add.</p>
                            @endif
                            
                            <hr>
                            
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="input-group mb-3">
                                        <input class="form-control form-control-lg mb-0" type="text" placeholder="Search" wire:model="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <p>Total of <b class="text-info" style="font-size: 130%;"> {{ $productItemListCount }} </b> Result/s found.</p>
                            
                            @if (count($productItemList) > 0)
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="border-0">#</th>
                                        <th scope="col" class="border-0">PRODUCT CODE</th>
                                        <th scope="col" class="border-0">SUB-PRODUCT CODE</th>
                                        <th scope="col" class="border-0">FORM NO.</th>
                                        <th scope="col" class="border-0">DESCRIPTION</th>
                                        <th scope="col" class="border-0">UNIT</th>
                                        <th scope="col" class="border-0" ></th>
                                        <th scope="col" class="border-0" ></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productItemList as $indexKey => $product_item_list)
                                    <tr>
                                        <td>{{ $product_item_list->id }}</td>
                                        <td>
                                            @foreach ($parentProductFor as $parent_product_for)
                                            @if ( $parent_product_for->product_code == $product_item_list->product_code)
                                            {{ $product_item_list->product_code }} <br> <small> {{ $parent_product_for->product_name }} </small>
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($subProductFor as $sub_product_for)
                                            @if ( $sub_product_for->product_sub_code == $product_item_list->product_sub_code )
                                            {{ $product_item_list->product_sub_code }} <br> <small> {{ $sub_product_for->product_name }} </small>
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $product_item_list->form_no }}</td>
                                        <td>{{ $product_item_list->description }}</td>
                                        <td>{{ $product_item_list->unit }}</td>
                                        <td width="5%">
                                            <button type="button" class="btn btn-accent btn-block btn-sm" wire:click="editItem({{ $product_item_list->id}}, {{ $indexKey }})">  <i class="material-icons">mode_edit</i> Edit</button>
                                        </td>
                                        <td width="5%">
                                            <button type="button" class="btn btn-danger btn-block btn-sm" wire:click="deleteItem({{ $product_item_list->id }})">  <i class="material-icons">delete</i> Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p style="text-align: center"> No Product Item/s Found.</p>
                            @endif
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-warning" wire:click="refreshTrick">Reset Form</button>
                            @if ( $itemAddMode == true )
                            <button type="submit" class="btn btn-accent">Save Item</button>
                            @else
                            <button type="submit" class="btn btn-accent">Update Item</button>
                            @endif
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>