<div>
    <div class="modal fade" id="modalRePrint" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalRePrint" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBadBallotsTitle">Ballot Re-Prints</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form wire:submit.prevent="saveRePrint" autocomplete="off">
                    @csrf
                    
                    @if(session('messageReprint'))
                    <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-info mx-2"></i>
                        <strong style="font-size: 150%">  {!! Str::upper(session('messageReprint')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                    </div>
                    @endif
                    
                    <div class="modal-body">
                        
                        <button class="btn btn-primary mb-3" type="button" wire:click="$set('batchMode', true)"><i class="material-icons">print</i> Create Re-Print Batch</button>
                        
                        @if($batchMode == true)
                        <h5><i class="material-icons">info</i> <i> All Items below will be Added to the RE-PRINT batch </i> <i class="text-accent">No. {{ $batchCount }}</i> </h5>
                        
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>Ballot ID</th>
                                    <th>Unique Number</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batchList as $index => $batch_list)
                                <tr>
                                    <td>{{ $batch_list['id'] }}</td>
                                    <td>{{ $batch_list['ballot_id'] }}</td>
                                    <td>{{ $batch_list['unique_number'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-block" wire:click="removeFromBatchList({{ $index }}, {{ $batch_list['id'] }})"><i class="material-icons">delete</i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-accent btn-block"><i class="material-icons">save</i> Save Re-Print Batch</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <hr class="hr_dashed">
                        {{-- SEARCH INPUT --}}
                        @if($batchMode == false)
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
                        @endif
                        
                        <p>Total of <b class="text-info" style="font-size: 130%;"> {{ $reprintBallotListCount }} </b> Result/s found.</p>
                        
                        @if (count($reprintBallotList) > 0)
                        
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>From Ballot ID</th>
                                    <th>Unique Number</th>
                                    <th>Description</th>
                                    <th>Added at/by</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reprintBallotList as $reprint_list)
                                <tr>
                                    <td>{{ $reprint_list->id }}</td>
                                    <td>{{ $reprint_list->ballot_id }}</td>
                                    <td>{{ $reprint_list->unique_number }}</td>
                                    <td>{{ $reprint_list->description }}</td>
                                    <td>{{ $reprint_list->created_by_name }} <br> {{ \Carbon\Carbon::parse($reprint_list->created_at)->toDayDateTimeString() }}</td>
                                    
                                    <td >
                                        @if( $batchMode == true )
                                        <button class="btn btn-primary btn-sm" wire:ignore type="button" id="addToBatchBtn_{{ $reprint_list->id }}" wire:click="addToBatchList({{ $reprint_list->id }})"><i class="material-icons">add</i></button>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if( $reprint_list->reprint_batch == null)
                                        <span class="badge badge-danger">No Re-Print Batch Assigned</span>
                                        @else
                                        <span class="badge badge-accent">Re-Print to Batch {{ $reprint_list->reprint_batch }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $reprint_list->reprint_batch != null)
                                        @if( $reprint_list->is_reprint_batch_start == true)
                                        <span class="badge badge-accent">Re-Print initiated at {{ $reprint_list->is_reprint_batch_start_at }}</span>
                                        @else
                                        <span class="badge badge-danger">Re-Print Pending</span>
                                        @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if( $reprint_list->reprint_batch != null)
                                        @if($reprint_list->is_reprint_done_successful_by_id != null)
                                        @if( $reprint_list->is_reprint_done_successful == true)
                                        <span class="badge badge-success">Re-Print Successful at {{ $reprint_list->is_reprint_done_successful_at }}</span>
                                        @else
                                        <span class="badge badge-danger">Re-Print Failed</span>
                                        @endif
                                        @endif
                                        @endif
                                    </td>
                                    {{-- <td align="right">
                                        @if( $reprint_list->created_by_id == Auth::user()->id )
                                        <button type="button" class="btn btn-accent" wire:click="editBadBallots({{ $reprint_list->id }})"><i class="material-icons">mode_edit</i></button>
                                        @endif
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p style="text-align: center">No Ballots Re-Prints Found.</p>
                        @endif
                        
                        <br>
                        @if($batchMode == false)
                        <div class="text-center"> 
                            {{ $reprintBallotList->links() }}
                        </div>
                        @endif
                        
                    </div>
                </form>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" wire:click="resetRePrints">Reset Form</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetRePrints">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>