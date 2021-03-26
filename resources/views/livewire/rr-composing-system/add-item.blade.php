<div>
    <div class="row">
        <style scoped>
            .requiredTag{
                color: red;
            }
        </style>
        
        {{-- MODAL ADD SOFTCOPY --}}
        <div class="modal fade" id="modalAddOg" tabindex="-1" role="dialog" aria-labelledby="modalAddOg" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add OG Softcopy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="saveSoftcopy" autocomplete="off">
                        @csrf
                        
                        <div class="modal-body">
                            
                            <div class="col-lg-12 mb-0">
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <strong class="text-muted d-block mb-2">Article Title <span class="requiredTag">&bullet;</span></strong>
                                                <input type="text" class="form-control" id="articleTitle" name="articleTitle" placeholder="Article Title" autocomplete="off" required autofocus wire:model="articleTitle" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <strong class="text-muted d-block mb-2">Publication Type <span class="requiredTag">&bullet;</span></strong>
                                                <select name="publicationType" id="publicationType" class="form-control" required wire:model="publicationType">
                                                    <option disabled selected value="">Select here</option>
                                                    <option value="REPUBLIC ACTS & IRRS">REPUBLIC ACTS & IRRS</option>
                                                    <option value="EXECUTIVE ORDERS & IRRS">EXECUTIVE ORDERS & IRRS</option>
                                                    <option value="PROCLAMATIONS">PROCLAMATIONS</option>
                                                    <option value="ADMINISTRATIVE ORDERS & IRRS">ADMINISTRATIVE ORDERS & IRRS</option>
                                                    <option value="MEMORANDUM CIRCULARS">MEMORANDUM CIRCULARS</option>
                                                    <option value="MEMORANDUM ORDERS">MEMORANDUM ORDERS</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <strong class="text-muted d-block mb-2">Date Published <span class="requiredTag">&bullet;</span> </strong>
                                                <input type="date" class="form-control" id="datePublished" name="datePublished" placeholder="Date Published" wire:model="datePublished" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <strong class="text-muted d-block mb-2">Publication Status </strong>
                                                <fieldset>
                                                    <div class="custom-control custom-checkbox mb-1">
                                                        <input type="checkbox" class="custom-control-input" id="isDownloadable" name="isDownloadable" value="{{ $isDownloadable }}" wire:model="isDownloadable">
                                                        <label class="custom-control-label" for="isDownloadable">IS DOWNLOADABLE</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox mb-1">
                                                        <input type="checkbox" class="custom-control-input" id="isSearchable" name="isSearchable" value="{{ $isSearchable }}" wire:model="isSearchable">
                                                        <label class="custom-control-label" for="isSearchable">IS SEARCHABLE</label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 mb-3">
                                        <strong class="text-muted d-block mb-2">Upload File <small>File Max size 50mb | Single File only | File Type PDF</small> <span class="requiredTag">&bullet;</span></strong> 
                                        <input type="file" class="form-control @if (!$errors->any() && $fileUpload != null ) is-valid @endif @error('fileUpload') is-invalid @enderror" name="fileUpload" id="fileUpload" wire:model="fileUpload" required>
                                        <div class="invalid-feedback"> @error('fileUpload') {{ $message }} @enderror </div>
                                    </div>
                                </div>
                                
                                {{-- <hr>
                                    
                                    <h6 class="text-accent"><strong>PETITIONER DETAILS</strong></h6>
                                    
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <strong class="text-muted d-block mb-2">Petitioner Name </strong>
                                                    <input type="text" class="form-control" id="petitionerName" name="petitionerName" placeholder="Petitioner Name" autocomplete="off" wire:model="petitionerName" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <strong class="text-muted d-block mb-2">Petitioner Address </strong>
                                                    <input type="text" class="form-control" id="petitionerAddress" name="petitionerAddress" placeholder="Petitioner Address" autocomplete="off" wire:model="petitionerAddress" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <strong class="text-muted d-block mb-2">Amount Paid </strong>
                                                    <input type="text" class="form-control" id="amountPaid" name="amountPaid" placeholder="Amount Paid" autocomplete="off" wire:model="amountPaid" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <strong class="text-muted d-block mb-2">Date Paid </strong>
                                                    <input type="date" class="form-control" id="datePaid" name="datePaid" placeholder="Date Paid" autocomplete="off" wire:model="datePaid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <strong class="text-muted d-block mb-2">Payment Status </strong>
                                                    <fieldset>
                                                        <div class="custom-control custom-checkbox mb-1">
                                                            <input type="checkbox" class="custom-control-input" id="isPaymentComplete" name="isPaymentComplete" value="{{ $isPaymentComplete }}" wire:model="isPaymentComplete">
                                                            <label class="custom-control-label" for="isPaymentComplete">IS PAYMENT COMPLETE</label>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    
                                    
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-accent">Add OG Softcopy</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            
            
            <div class="col-lg-3 col-md-12">
                <div class="card card-small mb-3">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Actions</h6>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-3">
                                <span class="d-flex mb-2">
                                    <i class="material-icons mr-1">search</i>
                                    <strong class="mr-1">Search Engine Status:</strong> 
                                    <strong class="text-danger">Offline</strong>
                                    
                                    <a class="ml-auto" href="#">Turn On</a>
                                </span>
                                <span class="d-flex mb-2">
                                    <i class="material-icons mr-1">visibility</i>
                                    <strong class="mr-1">Visible Publications:</strong>
                                    <strong class="text-success">1250</strong>
                                    {{-- <a class="ml-auto" href="#">Edit</a> --}}
                                </span>
                                {{-- <span class="d-flex mb-2">
                                    <i class="material-icons mr-1">calendar_today</i>
                                    <strong class="mr-1">Schedule:</strong> Now
                                    <a class="ml-auto" href="#">Edit</a>
                                </span>
                                <span class="d-flex">
                                    <i class="material-icons mr-1">score</i>
                                    <strong class="mr-1">Readability:</strong>
                                    <strong class="text-warning">Ok</strong>
                                </span> --}}
                            </li>
                            <li class="list-group-item d-flex px-3">
                                <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalAddOg">
                                    <i class="material-icons">add</i> Add New Softcopy</button>
                                    {{-- <button class="btn btn-sm btn-accent ml-auto">
                                        <i class="material-icons">file_copy</i> Publish</button> --}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                {{-- <script>
                    $(function () {
                        $('#datePublished').datepicker({
                            autoclose: true,
                            format: 'yyyy-mm-dd',
                            todayHighlight: true,
                        })
                        
                        $('#datePaid').datepicker({
                            autoclose: true,
                            format: 'yyyy-mm-dd',
                            todayHighlight: true,
                        })
                    })
                </script>
                --}}
                
                
            </div>