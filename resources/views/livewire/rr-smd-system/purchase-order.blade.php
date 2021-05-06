<div>
    {{-- MODAL ADD SOFTCOPY --}}
    <div class="modal fade" id="modalPurchaseOrder" tabindex="-1" role="dialog" aria-labelledby="modalPurchaseOrder" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Log Purchase Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="savePurchaseOrder" autocomplete="off">
                    @csrf
                    
                    @if(session('messagePurchaseOrder'))
                    <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-info mx-2"></i>
                        <strong style="font-size: 150%">  {!! Str::upper(session('messagePurchaseOrder')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                    </div>
                    @endif
                    
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">AGENCY NAME <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="POagencyName" name="POagencyName" placeholder="Agency Name" autocomplete="off" required autofocus wire:model="agencyName" wire:keyup="searchClientDatabase">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if ($showClientDatabaseTable == true)
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                @if (count($clientDatabase) > 0)
                                <hr>
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col" class="border-0">#</th>
                                            <th scope="col" class="border-0">AGENCY CODE</th>
                                            <th scope="col" class="border-0">AGENCY NAME</th>
                                            <th scope="col" class="border-0">AGENCY ADDRESS</th>
                                            <th scope="col" class="border-0"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clientDatabase as $client_database)
                                        <tr>
                                            <td>{{ $client_database->id }}</td>
                                            <td>{{ $client_database->agency_code }}</td>
                                            <td>{{ $client_database->agency_name }}</td>
                                            <td>{{ $client_database->agency_address }} - {{ $client_database->region }}</td>
                                            <td><button class="btn btn-accent btn-sm" id="POgetClientDatabase{{ $client_database->id }}" name="POgetClientDatabase{{ $client_database->id }}" wire:click="getClientDatabase({{ $client_database->id }})">Get Client Data</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                @else
                                <p style="text-align: center">No Client Details found.</p>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        <div class="row">
                            <div class="col-sm-10 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <strong class="text-muted d-block mb-2">COMPLETE ADDRESS <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="POagencyAddress" name="POagencyAddress" placeholder="Complete Address" autocomplete="off" required autofocus wire:model="agencyAddress" >
                                    </div>
                                    <div class="form-group col-md-2">
                                        <strong class="text-muted d-block mb-2">REGION <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="POregion" name="POregion" placeholder="Region" autocomplete="off" required autofocus wire:model="region" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">CONTACT PERSON <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="POcontactPerson" name="POcontactPerson" placeholder="Contact Person" autocomplete="off" required autofocus wire:model="contactPerson" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">CONTACT NO <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="POcontactNo" name="POcontactNo" placeholder="Contact No" autocomplete="off" required autofocus wire:model="contactNo" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">EMAIL ADDRESS <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="POemailAddress" name="POemailAddress" placeholder="Email Address" autocomplete="off" required autofocus wire:model="emailAddress" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="hr_dashed">
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">PURCHASE ORDER SOURCE <span class="requiredTag">&bullet;</span></strong>
                                        <select name="poSource" id="poSource" class="form-control" wire:model="poSource" required>
                                            <option disabled selected value="">Select Here</option>
                                            <option value="WALK-IN">WALK-IN</option>
                                            <option value="EMAIL">EMAIL</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="hr_dashed">
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">GOODS TYPE <span class="requiredTag">&bullet;</span></strong>
                                        <select name="POgoodsType" id="POgoodsType" class="form-control" wire:model="goodsType" wire:change="resetGoodsType" required>
                                            <option disabled selected value="">Select Here</option>
                                            <option value="Generic">GENERIC</option>
                                            <option value="Specialized">SPECIALIZED</option>
                                        </select>
                                    </div>
                                    
                                    @if ($goodsType == 'Specialized')
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">FORMS TYPE <span class="requiredTag">&bullet;</span></strong>
                                        <select name="POformType" id="POformType" class="form-control" wire:model="formType" required>
                                            <option disabled selected value="">Select Here</option>
                                            <option value="AF">ACCOUNTABLE FORM</option>
                                            <option value="NAF">NON-ACCOUNTABLE FORM</option>
                                            <option value="SF">STANDARD FORM</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2"><br></strong>
                                        <button type="button" class="btn btn-accent" wire:click="addItemListManual"><i class="material-icons">add</i>Add Item</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @if ($goodsType == 'Generic')
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">PRODUCT<span class="requiredTag">&bullet;</span></strong>
                                        <select name="POproductParent" id="POproductParent" class="form-control" wire:model="productParent" wire:change="spitMatchedSubProduct($event.target.value)" required>
                                            @if (count($productParentFor) > 0)
                                            <option disabled selected value="">Select Here</option>
                                            @foreach ($productParentFor as $product_parent)
                                            <option value="{{ $product_parent->product_code }}">{{ $product_parent->product_name }}</option>
                                            @endforeach
                                            @else
                                            <option value="">No Available Product</option>
                                            @endif
                                        </select>
                                    </div>
                                    
                                    @if (count($productSubParentFor) > 0)
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">SUB-PRODUCT <span class="requiredTag">&bullet;</span></strong>
                                        <select name="POproductSubParent" id="POproductSubParent" class="form-control" wire:model="productSubParent" wire:change="spitMatchedProductItems" required>
                                            @if (count($productSubParentFor) > 0)
                                            <option disabled value="">Select Sub-Product Here</option>
                                            @foreach ($productSubParentFor as $product_sub_parent)
                                            <option value="{{ $product_sub_parent->product_sub_code }}">{{ $product_sub_parent->product_name }}</option>
                                            @endforeach
                                            @else
                                            <option value="">No Available Sub-Product</option>
                                            @endif
                                        </select>
                                    </div>
                                    @endif
                                    
                                    @if (count($productItemsFor) > 0)
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">PRODUCT ITEM/S <span class="requiredTag">&bullet;</span></strong>
                                        <select name="POproductItems" id="POproductItems" class="form-control" wire:model="productItems" wire:change="addItemList($event.target.value)" required>
                                            @if (count($productItemsFor) > 0)
                                            <option disabled value="">Select Item Here</option>
                                            @foreach ($productItemsFor as $product_item)
                                            <option value="{{ $product_item->id }}">{{ $product_item->form_no }}</option>
                                            @endforeach
                                            @else
                                            <option value="">No Available Item</option>
                                            @endif
                                        </select>
                                    </div>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        
                        @if(session('messageItemsRequired'))
                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-info mx-2"></i>
                            <strong style="font-size: 150%">  {!! Str::upper(session('messageItemsRequired')) !!} </strong>
                        </div>
                        @endif
                        
                        @if (count($itemList) > 0)
                        <hr>
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ITEM DESCRIPTION <span class="requiredTag">&bullet;</span></th>
                                    <th>FORM <span class="requiredTag">&bullet;</span></th>
                                    <th>UNIT <span class="requiredTag">&bullet;</span></th>
                                    <th>QTY <span class="requiredTag">&bullet;</span></th>
                                    <th>PRICE <span class="requiredTag">&bullet;</span></th>
                                    <th>ADDITIONAL DESCRIPTION</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itemList as $index => $item)
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Description" wire:model="itemList.{{$loop->index}}.itemDescription" required>
                                    </td>
                                    <td width="10%">
                                        <input type="text" class="form-control" placeholder="Form Type" wire:model="itemList.{{$loop->index}}.formType" required>
                                    </td>
                                    <td width="10%">
                                        <input type="text" class="form-control" placeholder="Unit" wire:model="itemList.{{$loop->index}}.unit" required>
                                    </td>
                                    <td width="10%">
                                        <input type="number" class="form-control" placeholder="Qty" wire:model="itemList.{{$loop->index}}.quantity" required>
                                    </td>
                                    <td width="10%">
                                        <input type="number" class="form-control" placeholder="Price" wire:model="itemList.{{$loop->index}}.price" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Additional Description" wire:model="itemList.{{$loop->index}}.additionalDescription" required>
                                    </td>
                                    <td width="5%">
                                        <button type="button" class="btn btn-danger" wire:click="removeItem({{$loop->index}})"> <i class="material-icons">remove</i></button>
                                    </td>
                                </tr>      
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        
                        <hr class="hr_dashed">
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="refreshTrick">Close</button>
                        <button type="submit" class="btn btn-accent">Save Purchase Order</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>