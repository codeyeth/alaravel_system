<div>
    <div class="row">
        
        <style>
            input { 
                text-transform: uppercase;
            }
            ::-webkit-input-placeholder { /* WebKit browsers */
                text-transform: none;
            }
        </style>
        
        <div class="col-lg-6 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Actions</h6>
                </div>
                
                {{-- @if(session('messageSalesInvoice'))
                <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-info mx-2"></i>
                    <strong style="font-size: 150%">  {!! Str::upper(session('messageSalesInvoice')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                </div>
                @endif --}}
                
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3">
                            <span class="d-flex mb-2">
                                <i class="material-icons mr-1">add</i>
                                <strong class="mr-1">Total Sales Invoice for Today:</strong>
                                {{-- <strong class="text-success">{{ $visiblePublications }}</strong> --}}
                                <strong class="text-success"> 1 </strong>
                                <a class="ml-auto" href="#">View</a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalSalesInvoice">
                                <i class="material-icons">add</i> Encode Sales Invoice
                            </button>
                            <div style="margin-left: 10px;"></div>
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalAddProduct">
                                <i class="material-icons">add</i> Add Product
                            </button>
                            <div style="margin-left: 10px;"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        {{-- MODAL ADD SOFTCOPY --}}
        <div class="modal fade" id="modalSalesInvoice" tabindex="-1" role="dialog" aria-labelledby="modalSalesInvoice" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Encode Sales Invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="saveSoftcopy" autocomplete="off">
                        @csrf
                        
                        @if(session('messageSalesInvoice'))
                        <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-info mx-2"></i>
                            <strong style="font-size: 150%">  {!! Str::upper(session('messageSalesInvoice')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                        </div>
                        @endif
                        
                        <div class="modal-body">
                            
                            <p style="text-align: right; font-size: 120%;" class="text-accent mb-0">S.I No: {{ $salesInvoiceNumber }} </p>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <strong class="text-muted d-block mb-2">AGENCY NAME <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="agencyName" name="agencyName" placeholder="Agency Name" autocomplete="off" required autofocus wire:model="agencyName" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-10 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <strong class="text-muted d-block mb-2">COMPLETE ADDRESS <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="agencyAddress" name="agencyAddress" placeholder="Complete Address" autocomplete="off" required autofocus wire:model="agencyAddress" >
                                        </div>
                                        <div class="form-group col-md-2">
                                            <strong class="text-muted d-block mb-2">REGION <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="region" name="region" placeholder="Region" autocomplete="off" required autofocus wire:model="region" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <strong class="text-muted d-block mb-2">CONTACT PERSON <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="contactPerson" name="contactPerson" placeholder="Contact Person" autocomplete="off" required autofocus wire:model="contactPerson" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <strong class="text-muted d-block mb-2">CONTACT NO <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="contactNo" name="contactNo" placeholder="Contact No" autocomplete="off" required autofocus wire:model="contactNo" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <strong class="text-muted d-block mb-2">EMAIL ADDRESS <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email Address" autocomplete="off" required autofocus wire:model="emailAddress" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">TRANSACTION TYPE <span class="requiredTag">&bullet;</span></strong>
                                            <select name="transactionType" id="transactionType" class="form-control" wire:model="transactionType">
                                                <option disabled selected value="">Select Here</option>
                                                <option value="WALK-IN">WALK-IN</option>
                                                <option value="EMAIL">EMAIL</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">STOCK NO <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="stockNo" name="stockNo" placeholder="Stock No" autocomplete="off" required autofocus wire:model="stockNo" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <button type="button" class="btn btn-accent btn-block" wire:click="addItemList"><i class="material-icons">add</i>Add Item</button>
                            
                            <br>
                            
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ITEM DETAILS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itemList as $item)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <strong class="text-muted d-block mb-2">QUANTITY <span class="requiredTag">&bullet;</span></strong>
                                                            <input type="text" class="form-control" placeholder="Quantity" wire:model="itemList.{{$loop->index}}.quantity">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <strong class="text-muted d-block mb-2">UNIT OF MEASURE <span class="requiredTag">&bullet;</span></strong>
                                                            <input type="text" class="form-control" placeholder="Unit" wire:model="itemList.{{$loop->index}}.unit">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <strong class="text-muted d-block mb-2">PRICE <span class="requiredTag">&bullet;</span></strong>
                                                            <input type="text" class="form-control" placeholder="Price" wire:model="itemList.{{$loop->index}}.price">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <strong class="text-muted d-block mb-2">DESCRIPTION <span class="requiredTag">&bullet;</span></strong>
                                                            <input type="text" class="form-control" placeholder="Description" wire:model="itemList.{{$loop->index}}.descriptionOne">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <strong class="text-muted d-block mb-2"> <span class="requiredTag">&bullet;</span></strong>
                                                            <input type="text" class="form-control" placeholder="Additional Description" wire:model="itemList.{{$loop->index}}.descriptionTwo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <button type="button" class="btn btn-danger" wire:click="removeItem({{$loop->index}})"> <i class="material-icons">remove</i> Remove</button>
                                            
                                        </td>
                                    </tr>      
                                    @endforeach
                                </tbody>
                            </table>
                            
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-accent">Save Sales Invoice</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
        {{-- MODAL ADD PRODUCT --}}
        <div class="modal fade" id="modalAddProduct" tabindex="-1" role="dialog" aria-labelledby="modalAddProduct" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @if ( $productAddMode == true )
                    <form wire:submit.prevent="saveProduct" autocomplete="off">
                        @else
                        <form wire:submit.prevent="updateProduct({{ $editProductId }})" autocomplete="off">
                            @endif
                            
                            @csrf
                            
                            @if(session('messageSaveProduct'))
                            <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <i class="fa fa-info mx-2"></i>
                                <strong style="font-size: 150%">  {!! Str::upper(session('messageSaveProduct')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                            </div>
                            @endif
                            
                            <div class="modal-body">
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <strong class="text-muted d-block mb-2">PRODUCT NAME <span class="requiredTag">&bullet;</span></strong>
                                                <input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name" autocomplete="off" required autofocus wire:model="productName" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                @if ($productAddMode == true)
                                <button type="button" class="btn btn-accent btn-block" wire:click="addproductSubName"><i class="material-icons">add</i>Add Sub-Product</button>
                                @else
                                <button type="button" class="btn btn-accent btn-block" wire:click="addUpdateProductSubName"><i class="material-icons">add</i>Add Sub-Product</button>
                                @endif
                                
                                <br>
                                
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SUB-PRODUCT NAME</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productSubName as $index => $product_item)
                                        <tr>
                                            <td>
                                                {{-- <input type="text" class="form-control" placeholder="Sub-Product Name" wire:model="productSubName.{{$index}}.product_sub_id" required> --}}
                                                <input type="text" class="form-control" placeholder="Sub-Product Name" wire:model="productSubName.{{$index}}.product_sub_name" required>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-block" wire:click="removeProductSubName({{$index}})"> <i class="material-icons">remove</i> Remove</button>
                                            </td>
                                        </tr>      
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                @if (count($productSubName) <= 0 )
                                <p style="text-align: center"> Click Add Sub-Product to add.</p>
                                @endif
                                
                                <hr>
                                
                                @if (count($productList) > 0)
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col" class="border-0">#</th>
                                            <th scope="col" class="border-0">CODE</th>
                                            <th style="text-align: right" scope="col" class="border-0" >PRODUCT NAME <br>
                                                <i class="material-icons text-danger">info</i> <small class="text-danger"> Deleting a Product <br> will also Delete its Sub Products. </small>
                                            </th>
                                            <th style="text-align: left" scope="col" class="border-0" >SUB-PRODUCT</th>
                                            <th scope="col" class="border-0" ></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productList as $product_list)
                                        <tr>
                                            <td>{{ $product_list->id }}</td>
                                            <td>{{ $product_list->product_code }}</td>
                                            <td style="text-align: right"> <a href="#" class="text-danger" wire:click="deleteProduct({{ $product_list->id }})"> <i class="material-icons">delete</i>Delete</a> {{ $product_list->product_name }}</td>
                                            <td style="text-align: left">
                                                @foreach ($productSubList as $sub_list)
                                                @if ($product_list->product_code == $sub_list->product_code)
                                                <li> {{ $sub_list->product_name }} <a href="#" class="text-danger" wire:click="deleteSubProduct({{ $sub_list->id }})"> <i class="material-icons">delete</i>Delete</a> </li> 
                                                @endif
                                                @endforeach
                                            </td>
                                            <td width="5%">
                                                <button type="button" class="btn btn-accent btn-block btn-sm" wire:click="editProduct({{ $product_list->id }}, {{ $loop->index }})">  <i class="material-icons">mode_edit</i> Edit</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p style="text-align: center"> No Product/s Found.</p>
                                @endif
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-warning" wire:click="refreshTrick">Refresh Form</button>
                                @if ( $productAddMode == true )
                                <button type="submit" class="btn btn-accent">Save Product</button>
                                @else
                                <button type="submit" class="btn btn-accent">Update Product</button>
                                @endif
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    