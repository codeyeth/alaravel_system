<div>
    {{-- MODAL CLIENT DATABASE --}}
    <div class="modal fade" id="modalCourierDatabase" tabindex="-1" role="dialog" aria-labelledby="modalCourierDatabase" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Courier Information Database</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ( $courierAddMode == true )
                <form wire:submit.prevent="saveCourierData" autocomplete="off">
                    @else
                    <form wire:submit.prevent="updateCourierData({{ $courierId }})" autocomplete="off">
                        @endif
                        
                        @csrf
                        
                        @if(session('messageCourier'))
                        <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-info mx-2"></i>
                            <strong style="font-size: 150%">  {!! Str::upper(session('messageCourier')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                        </div>
                        @endif
                        
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <strong class="text-muted d-block mb-2">Courier Name <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="courierName" name="courierName" placeholder="Courier Name" autocomplete="off" required wire:model="courierName" >
                                        </div>
                                        <div class="form-group col-md-3">
                                            <strong class="text-muted d-block mb-2">Contact No <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="contactNo" name="contactNo" placeholder="Contact No" autocomplete="off" required wire:model="contactNo" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <strong class="text-muted d-block mb-2">Vehicle Type <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="vehicleType" name="vehicleType" placeholder="Vehicle Type" autocomplete="off" required wire:model="vehicleType" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Company Name </strong>
                                            <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Company Name" autocomplete="off" wire:model="companyName" >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Company Address </strong>
                                            <input type="text" class="form-control" id="companyAddress" name="companyAddress" placeholder="Company Address" autocomplete="off" wire:model="companyAddress" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">DR # Claiming <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="drNo" name="drNo" placeholder="DR # Claiming" autocomplete="off" required wire:model="drNo" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-8 mb-3">
                                    <strong class="text-muted d-block mb-2">Upload File <small>File Max size 20mb | Single File only | File Type PDF</small> 
                                        @if ( $courierAddMode == true )
                                        <span class="requiredTag">&bullet;</span>
                                        @endif
                                    </strong> 
                                    <input type="file" class="form-control @if (!$errors->any() && $fileUpload != null ) is-valid @endif @error('fileUpload') is-invalid @enderror" name="fileUpload" id="fileUpload" wire:model="fileUpload" 
                                    {{ $courierAddMode == true ? 'required':''}} wire:change="$set('hasFile', true)">
                                    <div class="invalid-feedback"> @error('fileUpload') {{ $message }} @enderror </div>
                                </div>
                            </div>
                            
                            @if ( $courierAddMode == false )
                            <div class="row">
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <strong class="text-muted d-block mb-2">Current Uploaded File - <span class="text-danger">Uploading a New File will Overwrite and Delete this Current File</span> </strong> 
                                    @if ( count($edit_currentFileUpload) > 0 )
                                    @foreach ($edit_currentFileUpload as $currentFile )
                                    <li>
                                        <a href="{{ asset ('/storage/courier_files/') }}/{{ $currentFile->converted_filename }}" target="_blank">{{ $currentFile->original_filename }}</a>
                                    </li>
                                    @endforeach
                                    @else
                                    <p>No Uploaded Files</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            <hr class="hr_dashed">
                            
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
                            
                            <p>Total of <b class="text-info" style="font-size: 130%;"> {{ $courierListCount }} </b> Result/s found.</p>
                            
                            @if (count($courierList) > 0)
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="border-0">#</th>
                                        <th scope="col" class="border-0">COURIER NAME</th>
                                        <th style="text-align: right" scope="col" class="border-0" >COMPANY</th>
                                        <th style="text-align: left" scope="col" class="border-0" >VEH. TYPE</th>
                                        <th style="text-align: left" scope="col" class="border-0" >CLAIMED DR NO</th>
                                        <th scope="col" class="border-0" ></th>
                                        <th scope="col" class="border-0" ></th>
                                        <th scope="col" class="border-0" ></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courierList as $courier_list)
                                    <tr>
                                        <td>{{ $courier_list->id }}</td>
                                        <td>{{ $courier_list->name }} <br> {{ $courier_list->contact_no }}</td>
                                        <td style="text-align: right"> {{ $courier_list->company_name }} <br> {{ $courier_list->company_address }}</td>
                                        <td style="text-align: left"> {{ $courier_list->vehicle_type }}</td>
                                        <td style="text-align: left"> {{ $courier_list->dr_no }}</td>
                                        <td width="5%">
                                            <a href="{{ asset ('/view_courier') }}/{{ $courier_list->id }}" class="btn btn-accent" target="_blank" title="View Courier Details"><i class="material-icons">search</i>View</a>
                                        </td>
                                        <td width="5%">
                                            <button type="button" class="btn btn-accent btn-block btn-sm" wire:click="editCourierData({{ $courier_list->id }})">  <i class="material-icons">mode_edit</i> Edit</button>
                                        </td>
                                        <td width="5%">
                                            <button type="button" class="btn btn-danger btn-block btn-sm" wire:click="deleteCourierData({{ $courier_list->id }})">  <i class="material-icons">delete</i> Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p style="text-align: center"> No Client/s Found.</p>
                            @endif
                            
                            <br>
                            
                            <div class="text-center"> 
                                {{ $courierList->links() }}
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="refreshTrick">Close</button>
                            <button type="button" class="btn btn-warning" wire:click="refreshTrick">Reset Form</button>
                            @if ( $courierAddMode == true )
                            <button type="submit" class="btn btn-accent">Save Client Data</button>
                            @else
                            <button type="submit" class="btn btn-accent">Update Client Data</button>
                            @endif
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
        <script>
            window.addEventListener('clear-file', event => {
                document.getElementById("fileUpload").value = null;
            })
        </script>
        
    </div>