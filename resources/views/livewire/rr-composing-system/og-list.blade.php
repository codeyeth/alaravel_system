<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Softcopy Lists</h6>
                </div>
                <div class="card-body pt-0 pb-3 text-center">
                    <div class="row border-bottom py-2 mb-0 bg-light">
                        {{-- <div class="col-12 col-sm-10">
                            <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by ID, Name, User Role, Position, Division, Section" wire:model="search">
                        </div>
                        <div class="col-12 col-sm-2">
                            <button type="button" class="btn btn-success btn-block">Export All Users</button>
                        </div> --}}
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-3">
                                <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by ID, Name, User Role, Position, Division, Section" wire:model="search">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" wire:click="exportAllUser">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pb-3 text-center">
                        @if (count($ogList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Article Title</th>
                                    <th scope="col" class="border-0">Publication Type</th>
                                    <th scope="col" class="border-0">Date Published</th>
                                    <th scope="col" class="border-0">Publication Status</th>
                                    <th scope="col" class="border-0">Added at</th>
                                    <th scope="col" class="border-0">Last Updated at</th>
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ogList as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->article_title }}</td>
                                    <td>{{ $item->publication_type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date_published)->toFormattedDateString() }} </td>
                                    <td>
                                        @if ( $item->is_downloadable == true)
                                        <span class="text-success"> Downloadable </span>
                                        @else
                                        <span class="text-danger"> Restricted </span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString() }} </td>
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->toDayDateTimeString() }} </td>
                                    
                                    
                                    <td><button type="button" class="btn btn-accent" data-toggle="modal" data-target="#modalUserDetail" wire:click.preventDefault="modalUserDetail({{ $item->id }})"> <i class="material-icons">search</i> View</button></td>
                                    <td>
                                        <button type="button" class="btn btn-accent" wire:click="editOgSoftcopy({{ $item->id }})" data-toggle="modal" data-target="#modalEditOg"> <i class="material-icons">mode_edit</i> Edit Softcopy</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-accent" wire:click="encodePetitioner({{ $item->id }})" data-toggle="modal" data-target="#modalEncode"> <i class="material-icons">mode_edit</i> Encode Petitioner</button>
                                    </td>
                                    
                                    <td>
                                        <button type="button" class="btn btn-danger" wire:click="deleteOgSoftcopy({{ $item->id }})"> <i class="material-icons">delete</i> Delete</button>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <br>
                        <p style="text-align: center">No Publication Softcopy found.</p>    
                        @endif
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center"> 
            {{ $ogList->links() }}
        </div>
        
        {{-- MODAL EDIT SOFTCOPY --}}
        <div class="modal fade" id="modalEditOg" tabindex="-1" role="dialog" aria-labelledby="modalEditOg" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit OG Softcopy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="updateOgSoftcopy({{ $edit_Id }})" autocomplete="off">
                        @csrf
                        
                        <div class="modal-body">
                            
                            <div class="col-lg-12 mb-0">
                                
                                @if ( Auth::user()->id == $edit_ogId || $edit_ogId == null)                                

                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <strong class="text-muted d-block mb-2">Article Title <span class="requiredTag">&bullet;</span></strong>
                                                <input type="text" class="form-control" id="edit_articleTitle" name="edit_articleTitle" placeholder="Article Title" autocomplete="off" autofocus wire:model="edit_articleTitle" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <strong class="text-muted d-block mb-2">Publication Type </strong>
                                                <select name="edit_publicationType" id="edit_publicationType" class="form-control" wire:model="edit_publicationType">
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
                                                <strong class="text-muted d-block mb-2">Date Published  </strong>
                                                <input type="date" class="form-control" id="edit_datePublished" name="edit_datePublished" placeholder="Date Published" wire:model="edit_datePublished" value="{{ $edit_datePublished }}">
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
                                                        <input type="checkbox" class="custom-control-input" id="edit_isDownloadable" name="edit_isDownloadable" wire:model="edit_isDownloadable" >
                                                        <label class="custom-control-label" for="edit_isDownloadable">IS DOWNLOADABLE</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox mb-1">
                                                        <input type="checkbox" class="custom-control-input" id="edit_isSearchable" name="edit_isSearchable" value="{{ $edit_isSearchable }}" wire:model="edit_isSearchable">
                                                        <label class="custom-control-label" for="edit_isSearchable">IS SEARCHABLE</label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 mb-3">
                                        <strong class="text-muted d-block mb-2">Upload File <small>File Max size 50mb | Single File only | File Type PDF</small> </strong> 
                                        <input type="file" class="form-control @if (!$errors->any() && $edit_fileUpload != null ) is-valid @endif @error('edit_fileUpload') is-invalid @enderror" name="edit_fileUpload" id="edit_fileUpload" wire:model="edit_fileUpload">
                                        <div class="invalid-feedback"> @error('edit_fileUpload') {{ $message }} @enderror </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 mb-3">
                                        <strong class="text-muted d-block mb-2">Current Uploaded File - <span class="text-danger">Uploading a New File will Overwrite and Delete this Current File</span> </strong> 
                                        @if ( count($edit_currentFileUpload) > 0 )
                                        @foreach ($edit_currentFileUpload as $currentFile )
                                        <li>
                                            <a href="{{ asset ('/storage/og_files/') }}/{{ $currentFile->converted_filename }}" target="_blank">{{ $currentFile->original_filename }}</a>
                                        </li>
                                        @endforeach
                                        @else
                                        <p>No Uploaded Files</p>
                                        @endif
                                    </div>
                                </div>

                                @else
                                <h6 class="text-danger" style="text-align:center;"><strong>YOU CAN'T EDIT THE PUBLICATION SOFTCOPY DETAILS!</strong></h6>
                                @endif
                                
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
        
        {{-- MODAL ENCODE PETITIONER DETAILS --}}
        <div class="modal fade" id="modalEncode" tabindex="-1" role="dialog" aria-labelledby="modalEncode" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Encode/Edit Petitioner Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="updateOgPetitioner({{ $edit_Id }})" autocomplete="off">
                        @csrf
                        
                        <div class="modal-body">
                            
                            <div class="col-lg-12 mb-0">
                                
                                @if ( Auth::user()->id == $edit_petId || $edit_petId == null)                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <strong class="text-muted d-block mb-2">Petitioner Name </strong>
                                                <input type="text" class="form-control" id="edit_petitionerName" name="edit_petitionerName" placeholder="Petitioner Name" autocomplete="off" wire:model="edit_petitionerName">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <strong class="text-muted d-block mb-2">Petitioner Address </strong>
                                                <input type="text" class="form-control" id="edit_petitionerAddress" name="edit_petitionerAddress" placeholder="Petitioner Address" autocomplete="off" wire:model="edit_petitionerAddress" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <strong class="text-muted d-block mb-2">Amount Paid</strong>
                                                <input type="text" class="form-control" id="edit_amountPaid" name="edit_amountPaid" placeholder="Amount Paid" autocomplete="off" wire:model="edit_amountPaid" >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <strong class="text-muted d-block mb-2">Date Paid </strong>
                                                <input type="date" class="form-control" id="edit_datePaid" name="edit_datePaid" placeholder="Date Paid" autocomplete="off" wire:model="edit_datePaid">
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
                                                        <input type="checkbox" class="custom-control-input" id="edit_isPaymentComplete" name="edit_isPaymentComplete" wire:model="edit_isPaymentComplete">
                                                        <label class="custom-control-label" for="edit_isPaymentComplete">IS PAYMENT COMPLETE</label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <h6 class="text-danger" style="text-align:center;"><strong>YOU CAN'T EDIT THE PETITIONER DETAILS!</strong></h6>
                                @endif
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            @if ( Auth::user()->id == $edit_petId )                                
                            <button type="submit" class="btn btn-primary">Save</button>
                            @endif
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
    </div>