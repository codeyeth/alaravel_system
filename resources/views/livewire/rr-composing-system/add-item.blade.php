<div>
    <div class="row">
        <style scoped>
            .requiredTag{
                color: red;
            }
        </style>
        
        <div class="col-lg-9 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">OG Softcopy Details</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <form wire:submit.prevent="saveSoftcopy" autocomplete="off">
                        @csrf
                        
                        <li class="list-group-item p-0 px-3 pt-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <strong class="text-muted d-block mb-2">Article Title <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="articleTitle" name="articleTitle" placeholder="Article Title" autocomplete="off" required autofocus wire:model="articleTitle" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        {{-- <li class="list-group-item p-0 px-3 pt-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <strong class="text-muted d-block mb-2">Petitioner Name <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="petitionerName" name="petitionerName" placeholder="Petitioner Name" autocomplete="off" required wire:model="petitionerName" >
                                        </div>
                                        <div class="form-group col-md-9">
                                            <strong class="text-muted d-block mb-2">Petitioner Address </strong>
                                            <input type="text" class="form-control" id="petitionerAddress" name="petitionerAddress" placeholder="Petitioner Address" autocomplete="off" wire:model="petitionerAddress" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <strong class="text-muted d-block mb-2">Amount Paid <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="amountPaid" name="amountPaid" placeholder="Amount Paid" autocomplete="off" required wire:model="amountPaid" >
                                        </div>
                                        <div class="form-group col-md-2">
                                            <strong class="text-muted d-block mb-2">Date Paid <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="datePaid" name="datePaid" placeholder="Date Paid" autocomplete="off" wire:model="datePaid" onchange="this.dispatchEvent(new InputEvent('input'))">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                        
                        <li class="list-group-item p-0 px-3 pt-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
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
                                        <div class="form-group col-md-3">
                                            <strong class="text-muted d-block mb-2">Date Published <span class="requiredTag">&bullet;</span> </strong>
                                            <input type="text" class="form-control" id="datePublished" name="datePublished" placeholder="Date Published" wire:model="datePublished" onchange="this.dispatchEvent(new InputEvent('input'))" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <strong class="text-muted d-block mb-2">Publication Status </strong>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox mb-1">
                                                    <input type="checkbox" class="custom-control-input" id="isDownloadable" name="isDownloadable" value="{{ $isDownloadable }}" wire:model="isDownloadable">
                                                    <label class="custom-control-label" for="isDownloadable">IS DOWNLOADABLE</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li class="list-group-item p-0 px-3 pt-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-4 mb-3">
                                    <strong class="text-muted d-block mb-2">Upload File <small>File Max size 50mb | Single File only | File Type PDF</small> </strong> 
                                    <input type="file" class="form-control @if (!$errors->any() && $fileUpload != null ) is-valid @endif @error('fileUpload') is-invalid @enderror" name="fileUpload" id="fileUpload" wire:model="fileUpload">
                                    <div class="invalid-feedback"> @error('fileUpload') {{ $message }} @enderror </div>
                                </div>
                            </div>
                        </li>
                        
                        <li class="list-group-item px-3">
                            <button type="submit" class="btn btn-accent">Add OG Softcopy</button>
                        </li>
                        
                    </form>
                    
                </ul>
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
                                <i class="material-icons mr-1">flag</i>
                                <strong class="mr-1">Status:</strong> Draft
                                <a class="ml-auto" href="#">Edit</a>
                            </span>
                            <span class="d-flex mb-2">
                                <i class="material-icons mr-1">visibility</i>
                                <strong class="mr-1">Visibility:</strong>
                                <strong class="text-success">Public</strong>
                                <a class="ml-auto" href="#">Edit</a>
                            </span>
                            <span class="d-flex mb-2">
                                <i class="material-icons mr-1">calendar_today</i>
                                <strong class="mr-1">Schedule:</strong> Now
                                <a class="ml-auto" href="#">Edit</a>
                            </span>
                            <span class="d-flex">
                                <i class="material-icons mr-1">score</i>
                                <strong class="mr-1">Readability:</strong>
                                <strong class="text-warning">Ok</strong>
                            </span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <button class="btn btn-sm btn-outline-accent">
                                <i class="material-icons">save</i> Save Draft</button>
                                <button class="btn btn-sm btn-accent ml-auto">
                                    <i class="material-icons">file_copy</i> Publish</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <script>
                $(function () {
                    $('#datePublished').datepicker({
                        autoclose: true,
                        format: 'yyyy-mm-dd',
                    })
                    
                    $('#datePaid').datepicker({
                        autoclose: true,
                        format: 'yyyy-mm-dd',
                    })
                })
            </script>
            
        </div>