<div>
    {{-- @include('inc.message') --}}
    
    <br>
    
    @if ($ballotIn == false && $searchMode == false)
    <h5 class="text-primary"> BALLOT OUT MODE 
        @if ($verificationBadMode == true && Auth::user()->comelec_role == 'VERIFICATION')
        <small class="text-danger"> VERIFICATION BAD MODE </small>
        @endif
    </h5> 
    
    @endif
    
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <div class="input-group mb-3">
                @if ( $searchMode == true )
                <input type="text" class="form-control form-control-lg" placeholder="Search here..." wire:model="search" autofocus>
                @else
                <input class="form-control form-control-lg mb-0" type="text" placeholder="Ballot ID | Barcode Value here..." wire:model="search" wire:keyup="updateBallotStatus" autofocus>
                @endif
                
                <div class="input-group-append">
                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear</button>
                </div>
            </div>
        </div>
        
        <div class="col-lg-1 col-sm-12">
            <div class="custom-control custom-toggle custom-toggle-lg mb-1">
                <input type="checkbox" id="customToggle1" name="customToggle1" class="custom-control-input custom-control-lg" wire:click="searchModeToggle" {{ $searchMode == true ? 'checked' : '' }}>
                <label class="custom-control-label" for="customToggle1">SEARCH MODE</label>
            </div>
        </div>
        
        <div class="col-lg-1 col-sm-12">
            <div class="custom-control custom-toggle custom-toggle-lg mb-1">
                <input type="checkbox" id="customToggle3" name="customToggle3" class="custom-control-input custom-control-lg" wire:click="ballotInToggle" {{ $ballotIn == true ? 'checked' : '' }}>
                <label class="custom-control-label" for="customToggle3">BALLOT IN</label>
            </div>
        </div>
        
        @if ( Auth::user()->comelec_role == 'VERIFICATION' && $ballotIn == false)
        <div class="col-lg-1 col-sm-12">
            <div class="custom-control custom-toggle custom-toggle-lg mb-1">
                <input type="checkbox" id="customToggle2" name="customToggle2" class="custom-control-input custom-control-lg" wire:click="verificationBadModeToggle" {{ $verificationBadMode == true ? 'checked' : '' }}>
                <label class="custom-control-label" for="customToggle2">VERIFICATION BAD</label>
            </div>
        </div>
        @endif
        
    </div>
    
    <hr>
    <p style="text-align: center">
        <img src="{{ asset('shards_template/images/loading2.gif') }}" alt="" wire:loading wire:target="search">
    </p>    
    
    <div class="row" wire:loading.remove wire:target="search">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Ballot/s Results - <b> {{ $userListCount }} </b></h6>
                </div>
                @if ( $searchMode == true && Auth::user()->is_ballot_tracking == true && Auth::user()->is_admin == true )
                <div class="card-body pt-0 pb-1">
                    <div class="row border-bottom py-2 bg-light">
                        <div class="col-12 col-sm-5">
                            <div id="" class="input-daterange input-group my-auto ml-auto mr-auto ml-sm-auto mr-sm-0" >
                                {{-- <input type="text" class="form-control" id="dateFrom" name="dateFrom" placeholder="Date From" wire:model="dateFrom" onchange="this.dispatchEvent(new InputEvent('input'))" required/> --}}
                                
                                <input type="datetime-local" name="dfrom" id="dfrom"  wire:model="dateFrom" class="input-sm form-control" placeholder="Date From" value="<?php echo date('Y-m-d\TH:i'); ?>"/>
                                
                                {{-- <input type="text" class="form-control" id="dateTo" name="dateTo" placeholder="Date To" wire:model="dateTo" onchange="this.dispatchEvent(new InputEvent('input'))" required/> --}}
                                <input type="datetime-local" wire:model="dateTo" name="dto" id="dto" class="input-sm form-control" placeholder="Date To" value="<?php echo date('Y-m-d\TH:i'); ?>">
                                
                                &ThickSpace;
                                <button type="button" class="btn btn-primary ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" wire:click="exportDateBallot">Generate base on Date</button>
                            </div>
                        </div>
                        
                        {{-- <div class="col-12 col-sm-3">
                            <select id="statusReport" name="statusReport" class="form-control ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" wire:model="statusSelected">
                                @if(count($comelecRolesList) > 0)
                                <option disabled selected value="">Select Status here</option>
                                @foreach($comelecRolesList as $post)
                                <option value="{{$post->comelec_role}}">{{ Str::title($post->comelec_role) }}</option>
                                @endforeach
                                @else
                                <option disabled selected>No Status available</option>
                                @endif                
                            </select>
                        </div>
                        
                        <div class="col-12 col-sm-2">
                            <button type="button" class="btn btn-block btn-secondary ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" wire:click="exportStatusBallotHistory">Generate base on Status</button>
                        </div> --}}
                        
                        <div class="col-12 col-sm-2">
                            <button type="button" class="btn btn-block btn-success ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" wire:click="exportAllBallotHistory">Generate All Available History</button>
                        </div>
                    </div>
                </div>
                @endif
                
                {{-- TABLE --}}
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pb-3 text-center">
                        @if (count($userList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0" style="text-align: right">Ballot ID</th>
                                    <th scope="col" class="border-0" style="text-align: right">Ballot Location</th>
                                    <th scope="col" class="border-0" style="text-align: left">Ballot Pollplace</th>
                                    <th scope="col" class="border-0" style="text-align: right">Current Status/Location</th>
                                    <th scope="col" class="border-0" style="text-align: left">Status BY</th>
                                    <th scope="col" class="border-0" style="text-align: left">History</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userList as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td align="right"><b> {{ $item->ballot_id }} </b></td>
                                    <td align="right"><small>{{ $item->bgy_name }} {{ $item->mun_name }} {{ $item->prov_name }}</small> </td>
                                    <td align="left"><small> {{ $item->pollplace }}</small> </td>
                                    <td align="right">
                                        @if ($item->current_status == 'PRINTER')
                                        <span class="text-danger"><b> BALLOT NOT YET PRINTED </b></span> 
                                        @else
                                        {{ $item->current_status }}
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
                                    <td>
                                        <button type="button" class="btn btn-accent" data-toggle="modal" data-target="#modalBallotHistory" wire:click.preventDefault="getBallotHistory({{ $item->id }})"> <i class="material-icons">search</i> View</button>
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
    <div class="text-center" wire:loading.remove wire:target="search"> 
        {{ $userList->links() }}
    </div>
    
    {{-- MODAL HISTORY --}}
    <div class="modal fade" id="modalBallotHistory" tabindex="-1" role="dialog" aria-labelledby="modalUserDetail" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ballot History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="blog-comments__item d-flex p-1">
                        @if (count($modalBallotHistoryList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0" style="text-align: right">Ballot ID</th>
                                    {{-- <th scope="col" class="border-0" style="text-align: right">Action</th> --}}
                                    {{-- <th scope="col" class="border-0" style="text-align: right">Old Status/Location</th> --}}
                                    <th scope="col" class="border-0" style="text-align: left">Status/Location</th>
                                    <th scope="col" class="border-0" style="text-align: right">Status BY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modalBallotHistoryList as $history_item)
                                <tr>
                                    <td>{{ $history_item->id }}</td>
                                    <td align="right"><b> {{ $history_item->ballot_id }} </b></td>
                                    {{-- <td align="right"><b> {{ $history_item->action }} </b></td> --}}
                                    {{-- <td align="right"><b> {{ $history_item->old_status }} - <span class="text-primary"> {{ $history_item->old_status_type }} </span></b></td> --}}
                                    <td align="left"><b>
                                        @if ( $history_item->old_status == 'PRINTER' )
                                        SHEETER
                                        @else
                                        {{ $history_item->old_status }}
                                        @endif
                                        
                                        - <span class="text-info"> {{ $history_item->new_status_type }} </span></b></td>
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
                            @else
                            <br>
                            <p style="text-align: center">No Ballot History found.</p>
                            @endif
                        </div>
                        
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
        
        <script type="text/javascript">
            $('#dateFrom').datetimepicker({
                format: 'yyyy-mm-dd',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
            $('#dateTo').datetimepicker({
                format: 'yyyy-mm-dd',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
        </script>
        
    </div>