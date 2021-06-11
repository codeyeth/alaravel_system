<div>
    {{-- BALLOTS RESULT TABLE --}}
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Ballot/s List</h6>
                </div>
                
                <div class="card-body pt-0 pb-3 text-center">
                    <div class="row border-bottom py-2 mb-0 bg-light">
                        
                        {{-- SEARCH INPUT --}}
                        <div class="col-lg-12 col-sm-12">
                            <div class="input-group mb-2">
                                <input class="form-control form-control-lg mb-0" type="text" placeholder="Ballot ID | Barcode Value here..." id="search_input" wire:model="search" wire:keyup="updateBallotDeliveryStatus" autofocus>
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
                                    
                                    
                                    <th scope="col" class="border-0" style="text-align: center"></th>
                                    {{-- <th scope="col" class="border-0" style="text-align: center"></th>
                                    <th scope="col" class="border-0" style="text-align: center"></th> --}}
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
                                        {{ $item->current_status }}
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
                                    
                                    {{-- <td>
                                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalBallotDetails" wire:click.preventDefault="getBallotDetails({{ $item->id }})" title="View Ballot Description"> <i class="material-icons">description</i></button>
                                    </td>
                                    
                                    <td>
                                        <button type="button" class="btn btn-accent btn-sm" data-toggle="modal" data-target="#modalBallotHistory" wire:click.preventDefault="getBallotHistory({{ $item->id }})"> <i class="material-icons">history</i> History</button>
                                    </td> --}}
                                    
                                    
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
    
</div>