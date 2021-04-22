<div>
    {{-- ACTION BAR --}}
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card card-small mb-2">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Actions</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3">
                            {{-- SEARCH MODE TOGGLE --}}
                            <span class="d-flex mb-2">
                                <strong class="mr-1">  <i class="material-icons mr-1">search</i> Search Mode:</strong>
                                @if ( $searchMode == true)
                                <strong class="text-success">ON</strong>
                                @else
                                <strong class="text-danger">OFF</strong>
                                @endif
                                <div class="custom-control custom-toggle custom-toggle-lg mb-1 ml-auto">
                                    <input type="checkbox" id="customToggle1" name="customToggle1" class="custom-control-input custom-control-lg" wire:click="searchModeToggle" {{ $searchMode == true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customToggle1"></label> 
                                    {{-- SEARCH MODE --}}
                                </div>
                            </span>
                            
                            @if ( $isDeliveredMode == false && $isOutForDeliveryMode == false)
                            
                            {{-- BALLOT MODE TOGGLE --}}
                            @if ( $searchMode == false)
                            <span class="d-flex mb-2">
                                <strong class="mr-1"> <i class="material-icons mr-1">margin</i> Ballot Mode:</strong>
                                @if ( $ballotIn == true)
                                <strong class="text-success">BALLOT IN</strong>
                                @else
                                <strong class="text-danger">BALLOT OUT</strong>
                                @endif
                                <div class="custom-control custom-toggle custom-toggle-lg mb-1 ml-auto">
                                    <input type="checkbox" id="customToggle3" name="customToggle3" class="custom-control-input custom-control-lg" wire:click="ballotInToggle" {{ $ballotIn == true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customToggle3"></label>
                                    {{-- BALLOT IN --}}
                                </div>
                            </span>
                            @endif
                            
                            @endif
                            
                            @if ( $searchMode == false && Auth::user()->comelec_role == 'COMELEC DELIVERY')
                            
                            <hr class="hr_dashed">
                            
                            {{-- BALLOT OUT FOR DELIVERY MODE TOGGLE --}}
                            <span class="d-flex mb-2">
                                <strong class="mr-1"> <i class="material-icons mr-1">arrow_forward home_work</i> Ballot Out for Delivery Mode:</strong>
                                @if ( $isOutForDeliveryMode == true)
                                <strong class="text-success">ON</strong>
                                @else
                                <strong class="text-danger">OFF</strong>
                                @endif
                                <div class="custom-control custom-toggle custom-toggle-lg mb-1 ml-auto">
                                    <input type="checkbox" id="toggleOutDelivery" name="toggleOutDelivery" class="custom-control-input custom-control-lg" wire:click="isOutForDeliveryModeToggle" {{ $isOutForDeliveryMode == true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="toggleOutDelivery"></label> 
                                    {{-- SEARCH MODE --}}
                                </div>
                            </span>
                            
                            {{-- BALLOT DELIVERED MODE TOGGLE --}}
                            <span class="d-flex mb-2">
                                <strong class="mr-1">  <i class="material-icons mr-1">check home_work</i> Ballot Delivered Mode:</strong>
                                @if ( $isDeliveredMode == true)
                                <strong class="text-success">ON</strong>
                                @else
                                <strong class="text-danger">OFF</strong>
                                @endif
                                <div class="custom-control custom-toggle custom-toggle-lg mb-1 ml-auto">
                                    <input type="checkbox" id="toggleDelivered" name="toggleDelivered" class="custom-control-input custom-control-lg" wire:click="isDeliveredModeToggle" {{ $isDeliveredMode == true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="toggleDelivered"></label> 
                                    {{-- SEARCH MODE --}}
                                </div>
                            </span>
                            
                            @endif
                            
                            {{-- IF THE CURRENT USER LOGGED IN IS VERIFICATION --}}
                            
                            @if ( $searchMode == false)
                            
                            @if ( Auth::user()->comelec_role == 'VERIFICATION' && $ballotIn == false)
                            <span class="d-flex mb-2">
                                <i class="material-icons mr-1">margin</i>
                                <strong class="mr-1">Verification Mode:</strong>
                                @if($verificationBadMode == false)
                                <strong class="text-success">VERIFICATION GOOD</strong>
                                @else
                                <strong class="text-danger">VERIFICATION BAD</strong>
                                @endif
                                <div class="custom-control custom-toggle custom-toggle-lg mb-1 ml-auto">
                                    <input type="checkbox" id="customToggle2" name="customToggle2" class="custom-control-input custom-control-lg" wire:click="verificationBadModeToggle" {{ $verificationBadMode == true ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customToggle2"></label>
                                    {{-- VERIFICATION BAD --}}
                                </div>
                            </span>
                            @endif
                            
                            @endif
                        </li>
                        {{-- IF SEARCH MODE ON AND THE USER LOGGED IN IS ADMINISTRATOR --}}
                        <li class="list-group-item d-flex px-3">
                            @if ( $searchMode == true && Auth::user()->is_ballot_tracking == true && Auth::user()->is_admin == true )
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalReport">
                                <i class="material-icons">bar_chart</i> Generate Report
                            </button>
                            <div style="margin-left: 10px;"></div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <hr class="hr_dashed">
    
    {{-- BALLOT OUT MODE INFORMATION TEXT --}}
    @if ( $isDeliveredMode == false && $isOutForDeliveryMode == false)
    @if ($ballotIn == false && $searchMode == false)
    
    <div class="alert alert-accent show mb-3" role="alert">
        <i class="fa fa-info mx-2"></i>
        <strong>Ballot Out Mode | All Barcoded Items will be Released from Possession.</strong>
        
        @if ($verificationBadMode == true && Auth::user()->comelec_role == 'VERIFICATION')
        <i> The ballot will be Subjected to Re-Print </i> 
        {{-- VERFICATION BAD --}}
        @endif
        
        @if ($verificationBadMode == false && Auth::user()->comelec_role == 'VERIFICATION')
        <i> The Ballot is Correct and Valid </i>
        @endif
    </div>
    
    @endif
    @endif
    
    {{-- BALLOT IN MODE INFORMATION TEXT --}}
    @if ( $isDeliveredMode == false && $isOutForDeliveryMode == false)
    @if ($ballotIn == true && $searchMode == false)
    <div class="alert alert-accent show mb-3" role="alert">
        <i class="fa fa-info mx-2"></i>
        <strong>Ballot In Mode | All Barcoded Items will be Received to Possession.</strong>
    </div>
    @endif
    @endif
    
    @if ( $isOutForDeliveryMode == true && $searchMode == false)
    <div class="alert alert-accent show mb-3" role="alert">
        <i class="fa fa-info mx-2"></i>
        <strong>Out For Delivery Mode Enabled | All barcoded items will be Marked as Out for Delivery.</strong>
    </div>
    @endif
    
    @if ( $isDeliveredMode == true && $searchMode == false)
    <div class="alert alert-accent show mb-3" role="alert">
        <i class="fa fa-info mx-2"></i>
        <strong>Delivered Mode Enabled | All barcoded items will be Marked as Delivered.</strong>
    </div>
    @endif
    
    @if ( $isDeliveredMode == false && $isOutForDeliveryMode == false)
    
    {{-- BALLOTS RESULT TABLE --}}
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Ballot/s List</h6>
                </div>
                
                <div class="card-body pt-0 pb-3 text-center">
                    <div class="row border-bottom py-2 mb-0 bg-light">
                        {{-- IF SEARCH MODE ON SEARCH BY KEYWORD OR DATE --}}
                        <div class="col-12 col-sm-12">
                            @if ( $searchMode == true )
                            <div class="d-flex">
                                <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                                    <label class="btn btn-white {{ $keywordMode == true ? 'active' : ''}}" wire:click="$set('keywordMode', true)"><input type="radio" name="options" id="option1"> Search by Keyword </label>
                                    <label class="btn btn-white {{ $keywordMode == true ? '' : 'active'}}" wire:click="$set('keywordMode', false)"><input type="radio" name="options" id="option2"> Search by Date</label>
                                </div>
                                <div class="p-2"></div>
                                <div class="ml-auto p-2">
                                    Total of <b class="text-success" style="font-size: 120%;"> {{ $ballotListCount }} </b> Result/s Found
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        {{-- SEARCH INPUT --}}
                        <div class="col-lg-12 col-sm-12">
                            <div class="input-group mb-2">
                                @if ( $searchMode == true )
                                
                                @if ( $keywordMode == true )
                                <input type="text" class="form-control form-control-lg" placeholder="Search here..." wire:model="search" autofocus>
                                @else
                                <input type="date" class="form-control form-control-lg" placeholder="Search here..." wire:model="search" autofocus>
                                @endif
                                
                                @else
                                <input class="form-control form-control-lg mb-0" type="text" placeholder="Ballot ID | Barcode Value here..." wire:model="search" wire:keyup="updateBallotStatus" autofocus>
                                @endif
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- LOADING GIF --}}
                <p style="text-align: center">
                    <img src="{{ asset('shards_template/images/loading2.gif') }}" alt="" wire:loading wire:target="search">
                </p>   
                
                {{-- TABLE --}}
                <ul class="list-group list-group-flush" wire:loading.remove wire:target="search">
                    <li class="list-group-item p-0 pb-3 text-center">
                        @if (count($ballotList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0" style="text-align: right">Ballot ID</th>
                                    <th scope="col" class="border-0" style="text-align: right">Ballot Location</th>
                                    <th scope="col" class="border-0" style="text-align: left">Ballot Pollplace</th>
                                    <th scope="col" class="border-0" style="text-align: right">Current Status/Location</th>
                                    <th scope="col" class="border-0" style="text-align: left">Status BY</th>
                                    @if ( Auth::user()->comelec_role == "QUARANTINE")
                                    <th scope="col" class="border-0" style="text-align: left"></th>
                                    @endif
                                    
                                    <th scope="col" class="border-0" style="text-align: center"></th>
                                    <th scope="col" class="border-0" style="text-align: center"></th>
                                    <th scope="col" class="border-0" style="text-align: center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ballotList as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td align="right"><b> {{ $item->ballot_id }} </b> </td>
                                    <td align="right"><small>{{ $item->bgy_name }} - {{ $item->mun_name }} - {{ $item->prov_name }}</small> </td>
                                    <td align="left"><small> {{ $item->pollplace }}</small> </td>
                                    <td align="right">
                                        @if ($item->current_status == 'PRINTER')
                                        <span class="text-danger"><b> BALLOT NOT YET PRINTED </b></span> 
                                        @else
                                        @if ( $item->new_status_type == "OUT")
                                        FOR {{ $item->current_status }}
                                        @else
                                        {{ $item->current_status }}
                                        @endif
                                        @endif
                                    </td>
                                    <td align="left">
                                        @if ( $item->status_updated_by == Auth::user()->name )
                                        <span class="text-success"><b> YOU </b></span>
                                        @else
                                        <span class="text-primary"><b>{{ $item->status_updated_by }} </b></span>
                                        @endif
                                        
                                        @if ($item->status_updated_at == null)
                                        <span class="text-danger"><b> BALLOT NOT YET PRINTED </b></span>
                                        @else
                                        <small> {{ \Carbon\Carbon::parse($item->status_updated_at)->diffForHumans() }} </small>
                                        {{ \Carbon\Carbon::parse($item->status_updated_at)->toDayDateTimeString() }}
                                        @endif
                                    </td>
                                    @if ( $item->current_status == "QUARANTINE" && Auth::user()->comelec_role == "QUARANTINE")
                                    <td>
                                        <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#modalBadBallots" wire:click.preventDefault="setBadBallotId({{ $item->id }})"> <i class="material-icons">search</i> Encode Bad Ballots</button>
                                    </td>
                                    @endif
                                    
                                    <td>
                                        @if($item->is_delivered == true)
                                        <span class="badge badge-success">Delivered</span>
                                        @endif
                                        
                                        @if($item->is_out_for_delivery == true && $item->is_delivered == false)
                                        <span class="badge badge-success">Out for Delivery</span>
                                        @endif
                                        
                                        @if($item->is_dr_done == true)
                                        <span class="badge badge-info">D.R Created</span>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalBallotDetails" wire:click.preventDefault="getBallotDetails({{ $item->id }})" title="View Ballot Description"> <i class="material-icons">description</i></button>
                                    </td>
                                    
                                    <td>
                                        <button type="button" class="btn btn-accent btn-sm" data-toggle="modal" data-target="#modalBallotHistory" wire:click.preventDefault="getBallotHistory({{ $item->id }})"> <i class="material-icons">history</i> History</button>
                                    </td>
                                    
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <br>
                        <p style="text-align: center">No Ballot found.</p>    
                        @endif
                    </li>
                </ul> 
                
            </div>
        </div>
    </div>
    
    @else
    
    {{-- DELIVERY MODULE FOR COMELEC DELIVERY --}}
    @livewire('rr-ballot-tracking.deliver-module', ['isDeliveredMode' => $isDeliveredMode, 'isOutForDeliveryMode' => $isOutForDeliveryMode])
    
    @endif
    
    <div class="text-center" wire:loading.remove wire:target="search"> 
        {{ $ballotList->links() }}
    </div>
    
    {{-- MODAL HISTORY --}}
    <div class="modal fade" id="modalBallotHistory" tabindex="-1" role="dialog" aria-labelledby="modalBallotHistory" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ballot History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                @if(session('messageAltered'))
                <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-info mx-2"></i>
                    <strong style="font-size: 150%">  {!! Str::upper(session('messageAltered')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                </div>
                @endif
                
                <div class="modal-body">
                    @if (count($modalBallotHistoryList) > 0)
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0" style="text-align: right">Ballot ID</th>
                                <th scope="col" class="border-0" style="text-align: left">Action</th>
                                <th scope="col" class="border-0" style="text-align: left">Status/Location</th>
                                <th scope="col" class="border-0" style="text-align: right">Status BY</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modalBallotHistoryList as $history_item)
                            <tr>
                                <td>{{ $history_item->id }}</td>
                                <td align="right"><b> {{ $history_item->ballot_id }} </b></td>
                                <td>{{ $history_item->action }}</td>
                                <td align="left">
                                    <b>
                                        @if ( $history_item->old_status == 'PRINTER' )
                                        SHEETER
                                        @else
                                        {{ $history_item->old_status }}
                                        @endif
                                        @if ( $history_item->for == '')
                                        - <span class="text-info"> {{ $history_item->new_status_type }} </span>
                                        @endif
                                        
                                        @if ( $history_item->for != '')
                                        - <span class="text-danger"> {{ $history_item->new_status_type }} </span>
                                        - <span class="text-danger"> {{ $history_item->for }} </span>
                                        @endif
                                    </b>
                                </td>
                                <td align="right">
                                    {{-- {{ $history_item->status_by_name }}  --}}
                                    @if ( $history_item->status_by_name == Auth::user()->name )
                                    <span class="text-success"><b> YOU </b></span>
                                    @else
                                    <span class="text-primary"><b> {{ $history_item->status_by_name }} </b></span>
                                    @endif
                                    
                                    @if ($history_item->status_by_at == null)
                                    <span class="text-danger"><b> BALLOT NOT YET PRINTED </b></span>
                                    @else
                                    <small> {{ \Carbon\Carbon::parse($history_item->status_by_at)->diffForHumans() }} </small>
                                    {{ \Carbon\Carbon::parse($history_item->status_by_at)->toDayDateTimeString() }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    
                    @if ( Auth::user()->is_admin == true )
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">Status/Location </strong>
                                    <select id="alterBallotStatus" name="alterBallotStatus" class="form-control" wire:model="alterBallotStatus">
                                        <option disabled selected value="">Select Status here</option>
                                        @if(count($alterBallotHistoryList) > 0)
                                        @foreach($alterBallotHistoryList as $alterHistoryStatus)
                                        <option value="{{$alterHistoryStatus->old_status}} - {{$alterHistoryStatus->new_status_type}}">{{ $alterHistoryStatus->old_status }} - {{$alterHistoryStatus->new_status_type}}</option>
                                        @endforeach
                                        @else
                                        <option disabled selected>No Status available</option>
                                        @endif                
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-warning btn-block" type="button" wire:click="alterBallotStatus( {{ $exportSingleId }} )">
                                <i class="material-icons">refresh</i> Alter Ballot Status
                            </button>
                        </div>
                    </div>
                    @endif
                    
                    @else
                    <br>
                    <p style="text-align: center;">No Ballot History found.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    @if ($ballotHistoryCount > 0 && Auth::user()->is_search_mode == true && Auth::user()->is_ballot_tracking == true && Auth::user()->is_admin == true )
                    <button type="button" class="btn btn-success" wire:click.preventDefault="exportSingleBallotHistory({{ $exportSingleId }})">Export History</button>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    
    {{-- MODAL FULL BALLOT DETAILS --}}
    <div class="modal fade" id="modalBallotDetails" tabindex="-1" role="dialog" aria-labelledby="modalBallotDetails" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">View Ballot Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <strong class="text-muted d-block mb-2">Ballot ID </strong>
                                    <input type="text" class="form-control" wire:model="viewBallotParent.ballot_id" >
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <strong class="text-muted d-block mb-2">Barangay </strong>
                                    <input type="text" class="form-control" wire:model="viewBallotParent.bgy_name" >
                                </div>
                                <div class="form-group col-md-4">
                                    <strong class="text-muted d-block mb-2">Municipality </strong>
                                    <input type="text" class="form-control" wire:model="viewBallotParent.mun_name" >
                                </div>
                                <div class="form-group col-md-4">
                                    <strong class="text-muted d-block mb-2">Province </strong>
                                    <input type="text" class="form-control" wire:model="viewBallotParent.prov_name" >
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <strong class="text-muted d-block mb-2">Pollplace </strong>
                                    <input type="text" class="form-control" wire:model="viewBallotParent.pollplace" >
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <strong class="text-muted d-block mb-2">Clustered Precinct </strong>
                                    <input type="text" class="form-control" wire:model="viewBallotParent.clustered_prec" >
                                </div>
                                <div class="form-group col-md-2">
                                    <strong class="text-muted d-block mb-2">Cluster Total </strong>
                                    <input type="text" class="form-control" wire:model="viewBallotParent.cluster_total" >
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <strong class="text-muted d-block mb-2">Current Status </strong>
                                    <input type="text" class="form-control" wire:model="viewBallotParent.current_status" >
                                </div>
                                <div class="form-group col-md-4">
                                    <strong class="text-muted d-block mb-2">Status by </strong>
                                    <input type="text" class="form-control" wire:model="viewBallotParent.status_updated_by" >
                                </div>
                                <div class="form-group col-md-4">
                                    <strong class="text-muted d-block mb-2">Status at </strong>
                                    <input type="text" class="form-control" wire:model="viewBallotParent.status_updated_at" >
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="hr_dashed">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                
            </div>
        </div>
    </div>
    
    {{-- MODAL REPORT --}}
    <div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="modalReport" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Generate Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">Date From </strong>
                                    <input type="datetime-local" name="dfrom" id="dfrom"  wire:model="dateFrom" class="form-control" placeholder="Date From" value="<?php echo date('Y-m-d\TH:i'); ?>"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">Date To </strong>
                                    <input type="datetime-local" wire:model="dateTo" name="dto" id="dto" class="form-control" placeholder="Date To" value="<?php echo date('Y-m-d\TH:i'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <button type="button" class="btn btn-primary btn-block" wire:click="exportDateBallot">Generate base on Date</button>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <button type="button" class="btn btn-block btn-success" wire:click="exportAllBallotHistory">Generate All Available History</button>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">Status </strong>
                                    <select id="statusReport" name="statusReport" class="form-control" wire:model="statusSelected">
                                        <option disabled selected value="">Select Status here</option>
                                        @if(count($comelecRolesList) > 0)
                                        @foreach($comelecRolesList as $comrole)
                                        <option value="{{$comrole->comelec_role}}">{{ Str::title($comrole->comelec_role) }}</option>
                                        @endforeach
                                        @else
                                        <option disabled selected>No Status available</option>
                                        @endif                
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">Status Type </strong>
                                    <select id="statusType" name="statusType" class="form-control" wire:model="statusType">
                                        <option disabled selected value="">Select Status Type here</option>
                                        <option value="IN">IN</option>               
                                        <option value="OUT">OUT</option>               
                                        <option value="ALL">IN AND OUT</option>               
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <button type="button" class="btn btn-block btn-secondary" wire:click="exportStatusBallotHistory">Generate base on Status</button>   
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                
            </div>
        </div>
    </div>
    
    {{-- MODAL BAD BALLOTS --}}
    <div class="modal fade" id="modalBadBallots" tabindex="-1" role="dialog" aria-labelledby="modalBadBallots" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBadBallotsTitle">Encode Bad Ballots for <b> {{ $badBallotIdFor }} </b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                @if ( $updateBadBallot == true)
                <form wire:submit.prevent="updateBadBallots({{ $updateBadBallotId }})" autocomplete="off">
                    @else
                    <form wire:submit.prevent="saveBadBallots({{ $badBallotId }})" autocomplete="off">
                        @endif
                        @csrf
                        
                        @if(session('messageBadBallots'))
                        <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-info mx-2"></i>
                            <strong style="font-size: 150%">  {!! Str::upper(session('messageBadBallots')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                        </div>
                        @endif
                        
                        <div class="modal-body">
                            
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Unique Number</th>
                                        <th>Description</th>
                                        @if ( $updateBadBallot == false)
                                        <th></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($badBallotLists as $index => $bad_ballot_item)
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Unique Number" wire:model="badBallotLists.{{$index}}.unique_number" required>
                                            @if($errors->has('unique_number'))
                                            <span class="text-danger">{{ $errors->first('unique_number') }}</span>
                                            @endif
                                        </td>
                                        <td><textarea class="form-control" cols="50" rows="3" wire:model.lazy="badBallotLists.{{$index}}.description" required></textarea></td>
                                        @if ( $updateBadBallot == false)
                                        <td>
                                            <button type="button" class="btn btn-danger btn-block" wire:click="removeBadBallot({{ $loop->index }})"><i class="material-icons">delete</i></button>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <hr>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            @if ( $updateBadBallot == false)
                                            <button type="button" class="btn btn-success btn-block" wire:click="addBadBallot"><i class="material-icons">add</i> Add New Fields</button>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            @if ( $updateBadBallot == true)
                                            <button type="submit" class="btn btn-accent btn-block"><i class="material-icons">refresh</i> Update Bad Ballots</button>
                                            @else
                                            <button type="submit" class="btn btn-accent btn-block"><i class="material-icons">save</i> Save Bad Ballots</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            
                            @if (count($badBallotsFor) > 0)
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Unique Number</th>
                                        <th>Description</th>
                                        <th>Added at/by</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($badBallotsFor as $bad_ballot_for)
                                    <tr>
                                        <td>{{ $bad_ballot_for->id }}</td>
                                        <td>{{ $bad_ballot_for->unique_number }}</td>
                                        <td>{{ $bad_ballot_for->description }}</td>
                                        <td>{{ $bad_ballot_for->created_by_name }} <br> {{ \Carbon\Carbon::parse($bad_ballot_for->created_at)->toDayDateTimeString() }}</td>
                                        <td align="right">
                                            <button type="button" class="btn btn-accent" wire:click="editBadBallots({{ $bad_ballot_for->id }})"><i class="material-icons">mode_edit</i></button>
                                            <button type="button" class="btn btn-danger" wire:click="deleteBadBallots({{ $bad_ballot_for->id }})"><i class="material-icons">delete</i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p style="text-align: center">No Bad Ballots Found.</p>
                            @endif
                            
                        </div>
                    </form>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" wire:click="resetBadBallots">Reset Form</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>