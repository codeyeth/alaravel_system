<div>
    <div class="modal fade" id="modalRePrint" tabindex="-1" role="dialog" aria-labelledby="modalRePrint" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBadBallotsTitle">Ballot Re-Prints</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form wire:submit.prevent="updateBadBallots" autocomplete="off">
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
                        
                        {{-- <table class="table table-hover mb-0">
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
                        </div> --}}
                        
                        <hr>
                        
                        @if (count($reprintBallotList) > 0)
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
                                @foreach ($reprintBallotList as $reprint_list)
                                <tr>
                                    <td>{{ $reprint_list->id }}</td>
                                    <td>{{ $reprint_list->unique_number }}</td>
                                    <td>{{ $reprint_list->description }}</td>
                                    <td>{{ $reprint_list->created_by_name }} <br> {{ \Carbon\Carbon::parse($reprint_list->created_at)->toDayDateTimeString() }}</td>
                                    <td align="right">
                                        @if( $reprint_list->created_by_id == Auth::user()->id )
                                        <button type="button" class="btn btn-accent" wire:click="editBadBallots({{ $reprint_list->id }})"><i class="material-icons">mode_edit</i></button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p style="text-align: center">No Ballots Re-Prints Found.</p>
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