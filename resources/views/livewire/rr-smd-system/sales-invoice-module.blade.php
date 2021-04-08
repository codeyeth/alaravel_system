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
</div>