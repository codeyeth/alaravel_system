<div>
    <div class="modal fade" id="modalRePrint" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalRePrint" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBadBallotsTitle">Ballot Re-Prints</h5>
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
                    
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-info mx-2"></i>
                        <strong style="font-size: 150%">  {!! Str::upper(session('error')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                    </div>
                    @endif
                    
                    <div class="modal-body">
                        @if($batchListMode == false)
                        {{-- RE-PRINT BATCHING --}}
                        <button class="btn btn-primary btn-block mb-3" type="button" wire:click="$set('batchMode', true)"><i class="material-icons">print</i> Create Re-Print Batch</button>
                        
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
                        @endif
                        
                        <hr class="hr_dashed">
                        
                        <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                            <label class="btn btn-white {{ $batchListMode == true ? '' : 'active'}}" wire:click="$set('batchListMode', false)"><input type="radio" name="options" id="option1" {{ $batchListMode == true ? '' : 'checked'}}> Bad Ballots for Re-Print </label>
                            <label class="btn btn-white {{ $batchListMode == true ? 'active' : ''}}" wire:click="$set('batchListMode', true)"><input type="radio" name="options" id="option2" {{ $batchListMode == true ? 'checked' : ''}}> Re-Print Batch View</label>
                        </div>
                        
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
                        
                        {{-- BAD BALLOT FOR RE-PRINTS --}}
                        @if($batchListMode == false)
                        <p>Total of <b class="text-info" style="font-size: 130%;"> {{ $reprintBallotListCount }} </b> Result/s found.</p>
                        @if (count($reprintBallotList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>From Ballot ID</th>
                                    {{-- <th>Unique Number</th> --}}
                                    <th width="15%">Description</th>
                                    <th width="15%">Added at/by</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reprintBallotList as $reprint_list)
                                <tr>
                                    <td>{{ $reprint_list->id }}</td>
                                    <td>
                                        <i>{{ $reprint_list->ballot_id }}</i>
                                        <br>
                                        <b class="text-accent">{{ $reprint_list->unique_number }} 
                                            @if( $reprint_list->re_encoded_count != null)
                                            - {{ $reprint_list->re_encoded_count }}
                                            @endif
                                        </b>
                                        {{-- @if( $reprint_list->reprint_batch != null)
                                            <span class="badge badge-accent">{{ $reprint_list->reprint_batch }} </span>
                                            @endif --}}
                                        </td>
                                        {{-- <td>  
                                            
                                        </td> --}}
                                        <td width="15%">{{ $reprint_list->description }}</td>
                                        <td width="15%">{{ $reprint_list->created_by_name }} <br> {{ \Carbon\Carbon::parse($reprint_list->created_at)->toDayDateTimeString() }}</td>
                                        
                                        <td>
                                            @if( $batchMode == true )
                                            <button class="btn btn-primary btn-sm" wire:ignore type="button" id="addToBatchBtn_{{ $reprint_list->id }}" wire:click="addToBatchList({{ $reprint_list->id }})"><i class="material-icons">add</i></button>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if( $reprint_list->reprint_batch == null)
                                            <span class="badge badge-danger">NO BATCH ASSIGNED</span>
                                            @else
                                            <span class="badge badge-accent">RE-PRINT TO BATCH - {{ $reprint_list->reprint_batch }} </span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if( $reprint_list->reprint_batch != null)
                                            @if( $reprint_list->is_reprint_batch_start == true)
                                            <span class="badge badge-info mb-1">INITIATED - {{ \Carbon\Carbon::parse($reprint_list->is_reprint_batch_start_at)->toDayDateTimeString() }}</span>
                                            @else
                                            <span class="badge badge-danger">RE-PRINT PENDING</span>
                                            @endif
                                            @endif
                                            
                                            @if( $reprint_list->is_reprint_done == true)
                                            <span class="badge badge-success mb-1">DONE - {{ \Carbon\Carbon::parse($reprint_list->is_reprint_done_at)->toDayDateTimeString() }}</span>
                                            @endif
                                            
                                            @if( $reprint_list->is_reprint_done_successful == true)
                                            <span class="badge badge-success">REPRINT SUCCESS AT - {{ \Carbon\Carbon::parse($reprint_list->is_reprint_done_successful_at)->toDayDateTimeString() }}</span>
                                            @endif
                                            
                                            @if( $reprint_list->is_reprint_done_successful == false && $reprint_list->is_reprint_done_successful_by_id != null )
                                            <span class="badge badge-danger">REPRINT FAILED AT - {{ \Carbon\Carbon::parse($reprint_list->is_reprint_done_successful_at)->toDayDateTimeString() }}</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if( $reprint_list->is_reprint_done == true && $reprint_list->is_reprint_done_successful == false && $reprint_list->is_reprint_done_successful_by_id == null)
                                            <button class="btn btn-success btn-sm mb-1" type="button" id="successfulRePrint_{{ $reprint_list->id }}" wire:click="successfulRePrint({{ $reprint_list->id }})"><i class="material-icons">check</i> Re-Print Successful </button>
                                            <button class="btn btn-danger btn-sm mb-1" type="button" id="unsuccessfulRePrint_{{ $reprint_list->id }}" wire:click="unsuccessfulRePrint({{ $reprint_list->id }})"><i class="material-icons">dangerous</i> Re-Print Un-Successful </button>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if( $reprint_list->is_reprint_done_successful == false && $reprint_list->is_reprint_done_successful_by_id != null && $reprint_list->is_re_encoded == false)
                                            <button type="button" class="btn btn-accent" id="reEncode" name="reEncode" wire:click="reEncode( {{ $reprint_list->id }} )"><i class="material-icons">text_snippet</i> Re-Encode</button>
                                            @endif
                                        </td>
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
                            @endif
                            
                            
                            {{-- RE PRINT BATCH VIEW --}}
                            @if($batchListMode == true)
                            <p>Total of <b class="text-info" style="font-size: 130%;"> {{ $reprintBatchListCount }} </b> Result/s found.</p>
                            @if (count($reprintBatchList) > 0)
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Batch ID</th>
                                        <th>Batch Content</th>
                                        <th>Batch Created at/by</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reprintBatchList as $batch_list)
                                    <tr>
                                        <td>{{ $batch_list->id }}</td>
                                        <td>{{ $batch_list->batch_count }}</td>
                                        <td>{{ $batch_list->batch_content }}</td>
                                        <td>{{ $batch_list->created_by_name }} <br> {{ \Carbon\Carbon::parse($batch_list->created_at)->toDayDateTimeString() }}</td>
                                        
                                        <td>
                                            @if( $batch_list->is_reprint_batch_start == false )
                                            <button class="btn btn-primary btn-sm" type="button" id="startRePrint_{{ $batch_list->id }}" wire:click="startRePrint({{ $batch_list->id }})"><i class="material-icons">play_arrow</i> Start Re-Print</button>
                                            @endif
                                            
                                            @if( $batch_list->is_reprint_batch_start == true )
                                            <span class="badge badge-accent"> RE-PRINT INITIATED AT - {{ \Carbon\Carbon::parse($batch_list->is_reprint_batch_start_at)->toDayDateTimeString() }} </span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if( $batch_list->is_reprint_batch_start == true && $batch_list->is_reprint_done == false )
                                            <button class="btn btn-success btn-sm" type="button" id="doneRePrint_{{ $batch_list->id }}" wire:click="doneRePrint({{ $batch_list->id }})"><i class="material-icons">check</i> Set Re-Print Done </button>
                                            @endif
                                            
                                            @if( $batch_list->is_reprint_batch_start == true && $batch_list->is_reprint_done == true )
                                            <span class="badge badge-success"> RE-PRINT DONE AT - {{ \Carbon\Carbon::parse($batch_list->is_reprint_done_at)->toDayDateTimeString() }} </span>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p style="text-align: center">No Re-Prints Batch Found.</p>
                            @endif
                            
                            <br>
                            <div class="text-center"> 
                                {{ $reprintBatchList->links() }}
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