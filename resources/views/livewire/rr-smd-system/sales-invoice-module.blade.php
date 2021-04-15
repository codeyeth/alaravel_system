<div>
    {{-- MODAL ADD SOFTCOPY --}}
    <div class="modal fade" id="modalSalesInvoice" tabindex="-1" role="dialog" aria-labelledby="modalSalesInvoice" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Encode Sales Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="saveSalesInvoice" autocomplete="off">
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
                        
                        <p style="text-align: right;" class="mb-1">SALES INVOICE NO. : <b style="font-size: 200%;" class="text-accent mb-0"> {{ $salesInvoiceNumber }} </b> </p>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">AGENCY NAME <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="SIagencyName" name="SIagencyName" placeholder="Agency Name" autocomplete="off" required autofocus wire:model="agencyName" wire:keyup="searchClientDatabase">
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
                                            <td><button class="btn btn-accent btn-sm" id="getClientDatabase" name="getClientDatabase" wire:click="getClientDatabase({{ $client_database->id }})">Get Client Data</button></td>
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
                                        <input type="text" class="form-control" id="SIagencyAddress" name="SIagencyAddress" placeholder="Complete Address" autocomplete="off" required autofocus wire:model="agencyAddress" >
                                    </div>
                                    <div class="form-group col-md-2">
                                        <strong class="text-muted d-block mb-2">REGION <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="SIregion" name="SIregion" placeholder="Region" autocomplete="off" required autofocus wire:model="region" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">CONTACT PERSON <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="SIcontactPerson" name="SIcontactPerson" placeholder="Contact Person" autocomplete="off" required autofocus wire:model="contactPerson" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">CONTACT NO <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="SIcontactNo" name="SIcontactNo" placeholder="Contact No" autocomplete="off" required autofocus wire:model="contactNo" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">EMAIL ADDRESS <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="SIemailAddress" name="SIemailAddress" placeholder="Email Address" autocomplete="off" required autofocus wire:model="emailAddress" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="hr_dashed">
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">TRANSACTION TYPE <span class="requiredTag">&bullet;</span></strong>
                                        <select name="transactionType" id="transactionType" class="form-control" wire:model="transactionType">
                                            <option disabled selected value="">Select Here</option>
                                            <option value="WALK-IN">WALK-IN</option>
                                            <option value="EMAIL">EMAIL</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">MODE OF PAYMENT <span class="requiredTag">&bullet;</span></strong>
                                        <select name="paymentMode" id="paymentMode" class="form-control" wire:model="paymentMode">
                                            <option disabled selected value="">Select Here</option>
                                            <option value="CASH">CASH</option>
                                            <option value="CHECK">CHECK</option>
                                            <option value="ADA">ADA</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">PACKAGE TYPE <span class="requiredTag">&bullet;</span></strong>
                                        <select name="packageType" id="packageType" class="form-control" wire:model="packageType">
                                            <option disabled selected value="">Select Here</option>
                                            <option value="CARRY">CARRY</option>
                                            <option value="COURIER">COURIER</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <strong class="text-muted d-block mb-2">CODE <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" autocomplete="off" required autofocus wire:model="code" >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <strong class="text-muted d-block mb-2">WORK ORDER NO <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="workOrderNo" name="workOrderNo" placeholder="Work Order No" autocomplete="off" required autofocus wire:model="workOrderNo" >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <strong class="text-muted d-block mb-2">STOCK NO <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="stockNo" name="stockNo" placeholder="Stock No" autocomplete="off" required autofocus wire:model="stockNo" >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <strong class="text-muted d-block mb-2">ISSUED BY <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="issuedBy" name="issuedBy" placeholder="Issued By" autocomplete="off" required autofocus wire:model="issuedBy" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="hr_dashed">
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">PRODUCT<span class="requiredTag">&bullet;</span></strong>
                                        <select name="productParent" id="productParent" class="form-control" wire:model="productParent" wire:change="spitMatchedSubProduct($event.target.value)" required>
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
                                        <select name="productSubParent" id="productSubParent" class="form-control" wire:model="productSubParent" wire:change="spitMatchedProductItems" required>
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
                                        <select name="productItems" id="productItems" class="form-control" wire:model="productItems" wire:change="addItemList($event.target.value)" required>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-accent">Save Sales Invoice</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>