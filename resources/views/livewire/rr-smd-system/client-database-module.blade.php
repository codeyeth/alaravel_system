<div>
    {{-- MODAL CLIENT DATABASE --}}
    <div class="modal fade" id="modalClientDatabase" tabindex="-1" role="dialog" aria-labelledby="modalClientDatabase" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Client Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ( $clientAddMode == true )
                <form wire:submit.prevent="saveClientData" autocomplete="off">
                    @else
                    <form wire:submit.prevent="updateClientData({{ $clientId }})" autocomplete="off">
                        @endif
                        
                        @csrf
                        
                        @if(session('messageClient'))
                        <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-info mx-2"></i>
                            <strong style="font-size: 150%">  {!! Str::upper(session('messageClient')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                        </div>
                        @endif
                        
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <strong class="text-muted d-block mb-2">Agency/Company Name <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="agencyName" name="agencyName" placeholder="Agency/Company Name" autocomplete="off" required autofocus wire:model="agencyName" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-9">
                                            <strong class="text-muted d-block mb-2">Complete Address <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="agencyAddress" name="agencyAddress" placeholder="Complete Address" autocomplete="off" required autofocus wire:model="agencyAddress" >
                                        </div>
                                        <div class="form-group col-md-3">
                                            <strong class="text-muted d-block mb-2">Region <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="region" name="region" placeholder="Region" autocomplete="off" required autofocus wire:model="region" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <strong class="text-muted d-block mb-2">Contact Person <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="contactPerson" name="contactPerson" placeholder="Contact Person" autocomplete="off" required autofocus wire:model="contactPerson" >
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <strong class="text-muted d-block mb-2">Contact No <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="contactNo" name="contactNo" placeholder="Contact No" autocomplete="off" required autofocus wire:model="contactNo" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <strong class="text-muted d-block mb-2">Email Address <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email Address" autocomplete="off" required autofocus wire:model="emailAddress" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
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
                            
                            <p>Total of <b class="text-info" style="font-size: 130%;"> {{ $clientListCount }} </b> Result/s found.</p>
                            
                            @if (count($clientList) > 0)
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="border-0">#</th>
                                        <th scope="col" class="border-0">CODE</th>
                                        <th style="text-align: right" scope="col" class="border-0" >AGENCY NAME</th>
                                        <th style="text-align: left" scope="col" class="border-0" >AGENCY ADDRESS</th>
                                        <th style="text-align: left" scope="col" class="border-0" >CONTACT PERSON</th>
                                        <th scope="col" class="border-0" ></th>
                                        <th scope="col" class="border-0" ></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientList as $client_list)
                                    <tr>
                                        <td>{{ $client_list->id }}</td>
                                        <td>{{ $client_list->agency_code }}</td>
                                        <td style="text-align: right"> {{ $client_list->agency_name }}</td>
                                        <td style="text-align: left"> {{ $client_list->agency_address }} - {{ $client_list->region }}</td>
                                        <td style="text-align: left"> {{ $client_list->contact_person }} <br> {{ $client_list->contact_no }} <br> {{ $client_list->email }} </td>
                                        <td width="5%">
                                            <button type="button" class="btn btn-accent btn-block btn-sm" wire:click="editClientData({{ $client_list->id }})">  <i class="material-icons">mode_edit</i> Edit</button>
                                        </td>
                                        <td width="5%">
                                            <button type="button" class="btn btn-danger btn-block btn-sm" wire:click="deleteClientData({{ $client_list->id }})">  <i class="material-icons">delete</i> Delete</button>
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
                                {{ $clientList->links() }}
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="refreshTrick">Close</button>
                            <button type="button" class="btn btn-warning" wire:click="refreshTrick">Reset Form</button>
                            @if ( $clientAddMode == true )
                            <button type="submit" class="btn btn-accent">Save Client Data</button>
                            @else
                            <button type="submit" class="btn btn-accent">Update Client Data</button>
                            @endif
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>