<div>
    <style>
        input { 
            text-transform: uppercase;
        }
        ::-webkit-input-placeholder { /* WebKit browsers */
            text-transform: none;
        }
    </style>
    
    <h3 style="text-align: center">
        <i class="material-icons">
            login
        </i>
        <strong> LOGBOOK SYSTEM </strong>
    </h3>
    
    <br>
    
    <div class="d-flex">
        <div class="mb-3">
            <button class="btn btn-accent" type="button" data-toggle="modal" data-target="#logHere">
                <i class="material-icons">login</i> New Visitor
            </button>
        </div>
        <div class="p-2"></div>
        <div class="ml-auto p-2">
            Total of <b class="text-success" style="font-size: 120%;"> {{ $logbookListCount }} </b> Result/s Found
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="input-group mb-3">
                <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by Control Number, Agency/Company Name" wire:model="search" value="">
                <div class="input-group-append">
                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-sm-12">
            @if (count($logbookList) > 0)
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th scope="col" class="border-0">#</th>
                        <th scope="col" class="border-0">Control Number</th>
                        <th scope="col" class="border-0">Agency Name</th>
                        <th scope="col" class="border-0">Agency Address</th>
                        <th scope="col" class="border-0">Client Name</th>
                        <th scope="col" class="border-0">Purpose</th>
                        <th scope="col" class="border-0">Recorded at</th>
                        <th width="1%" scope="col" class="border-0"></th>
                        <th width="1%" scope="col" class="border-0"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logbookList as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->uuid }}</td>
                        <td>{{ $item->agency_name }}</td>
                        <td>{{ $item->agency_address }}</td>
                        
                        @foreach ($logbookChildList as $itemChild)
                        @if ($item->uuid == $itemChild->uuid)
                        <td>{{ $itemChild->client_name }}</td>
                        <td>{{ $itemChild->visiting_nature }}</td>
                        <td>{{ \Carbon\Carbon::parse($itemChild->created_at)->toDayDateTimeString() }} </td>
                        @break
                        
                        @endif
                        @endforeach
                        {{-- <td>{{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString() }} </td> --}}
                        
                        <td style="text-align: center">
                            <button type="button" class="btn btn-accent btn-sm" wire:click="getChildLogbookDetails({{ $item->id }})" data-toggle="modal" data-target="#updateLogHere"> <i class="material-icons">login</i> Old Visitor</button>
                        </td>
                        
                        <td style="text-align: center">
                            <button type="button" class="btn btn-info btn-sm" wire:click="getLogbookChildren({{ $item->id }})" data-toggle="modal" data-target="#getLogbookChildren"> <i class="material-icons">search</i> View</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <br>
            <p style="text-align: center">No Logbook Records found.</p>    
            @endif
            
            
            <br>
            
        </div>
    </div>
    
    <br>
    
    <div style="text-align: right"> 
        {{ $logbookList->links() }}
    </div>
    
    {{-- LOG HERE MODAL --}}
    <div class="modal fade" id="logHere" tabindex="-1" role="dialog" aria-labelledby="logHere" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Log Here</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form wire:submit.prevent="savetoLogbook" autocomplete="off">
                    @csrf
                    
                    @if(session('messageLogbook'))
                    <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-info mx-2"></i>
                        <strong style="font-size: 100%">  {!! Str::upper(session('messageLogbook')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                    </div>
                    @endif
                    
                    <div class="modal-body">
                        
                        <p class="text-accent"> <i class="material-icons">info</i> Please always keep your Control Number for faster Signing when Visiting again.</p>
                        <hr>
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
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Agency Address <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="agencyAddress" name="agencyAddress" placeholder="Agency Address" autocomplete="off" required autofocus wire:model="agencyAddress" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Client Name <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" required autofocus wire:model="clientName" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Purpose of Visit <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="visitingNature" name="visitingNature" placeholder="Purpose of Visit" autocomplete="off" required autofocus wire:model="visitingNature" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="refreshTrick">Close</button>
                        <button type="submit" class="btn btn-accent">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- UPDATE LOG MODAL --}}
    <div class="modal fade" id="updateLogHere" tabindex="-1" role="dialog" aria-labelledby="updateLogHere" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Log Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form wire:submit.prevent="updateLogbookChild" autocomplete="off">
                    @csrf
                    
                    @if(session('messageUpdateLogbook'))
                    <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-info mx-2"></i>
                        <strong style="font-size: 150%">  {!! Str::upper(session('messageUpdateLogbook')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                    </div>
                    @endif
                    
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Agency/Company Name </strong>
                                        <input type="text" class="form-control" id="updateAgencyName" name="updateAgencyName" placeholder="Agency/Company Name" autocomplete="off" required autofocus wire:model="updateAgencyName" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Agency Address </strong>
                                        <input type="text" class="form-control" id="updateAgencyAddress" name="updateAgencyAddress" placeholder="Agency Address" autocomplete="off" required autofocus wire:model="updateAgencyAddress" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Client Name <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="updateClientName" name="updateClientName" placeholder="Client Name" autocomplete="off" required autofocus wire:model="updateClientName" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Purpose of Visit <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="updateVisitingNature" name="updateVisitingNature" placeholder="Purpose of Visit" autocomplete="off" required autofocus wire:model="updateVisitingNature" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="refreshTrick">Close</button>
                        <button type="submit" class="btn btn-accent">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- GET LOGBOOK CHILDRENS --}}
    <div class="modal fade" id="getLogbookChildren" tabindex="-1" role="dialog" aria-labelledby="getLogbookChildren" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Logbook History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ( count($getlogbookChildrenFor) > 0 )
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0">Control Number</th>
                                <th scope="col" class="border-0">Client Name</th>
                                <th scope="col" class="border-0">Purpose</th>
                                <th scope="col" class="border-0">Recorded at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getlogbookChildrenFor as $item)
                            
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->uuid }}</td>
                                <td>{{ $item->client_name }}</td>
                                <td>{{ $item->visiting_nature }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString() }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    @else
                    <p style="text-align: center">No Logbook History Found.</p>
                    @endif
                    
                    {{-- {{ $getlogbookChildrenFor->links() }} --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="refreshTrick">Close</button>
                </div>
            </div>
        </div>
    </div>
    
</div>