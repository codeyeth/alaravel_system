<div>
    <div class="row">
        <div class="modal fade" id="modalPublication" tabindex="-1" role="dialog" aria-labelledby="modalPublication" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Publication Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    @if ($pubAddMode == true)
                    <form wire:submit.prevent="savePublication" autocomplete="off">
                        @else
                        <form wire:submit.prevent="updatePublication({{ $editPubId }})" autocomplete="off">
                            @endif
                            
                            @csrf
                            
                            @if(session('messagePublication'))
                            <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <i class="fa fa-info mx-2"></i>
                                <strong style="font-size: 150%">  {!! Str::upper(session('messagePublication')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                            </div>
                            @endif
                            
                            <div class="modal-body" style="overflow-x:auto;">
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <strong class="text-muted d-block mb-2">Publication Type <span class="requiredTag">&bullet;</span></strong>
                                                <input type="text" class="form-control" id="publication_type" name="publication_type" placeholder="Publication Type" autocomplete="off" required autofocus wire:model="publication_type" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <strong class="text-muted d-block mb-2">Publication Type</strong>
                                @if ($pubAddMode == true)
                                <a href="#" wire:click.prevent="addSubType()" class="btn btn-accent btn-block">Add Sub Type</a>
                                @else
                                <a href="#" wire:click.prevent="addUpdateSubType()" class="btn btn-accent btn-block">Add Sub Type</a>
                                @endif
                                
                                <br>
                                
                                @if (count($publicationSub) > 0)
                                <table class="table table-bordered" id="pub_tbl">
                                    <thead>
                                        <tr>
                                            <th>Publication Sub Type</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($publicationSub as $index => $publication)
                                        <tr>
                                            <td>
                                                {{-- <input type="text" name="publicationSub[{{$index}}][publication_type_sub_id]" class="form-control" wire:model="publicationSub.{{$index}}.publication_type_sub_id" required /> --}}
                                                <input type="text" name="publicationSub[{{$index}}][publication_type_sub]" class="form-control" wire:model="publicationSub.{{$index}}.publication_type_sub" required />
                                            </td>
                                            <td>
                                                <a href="#" wire:click.prevent="removeSubType({{$index}})" class="btn btn-danger btn-block">Remove</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                @endif
                                
                                <hr>
                                @if (count($pubList) > 0)
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col" class="border-0">#</th>
                                            <th style="text-align: right" scope="col" class="border-0" >Publication Type <br>
                                                <i class="material-icons text-danger">info</i> <small class="text-danger"> Deleting a Publication Type <br> will also Delete its Sub Types. </small>
                                                
                                            </th>
                                            <th style="text-align: left" scope="col" class="border-0" >Sub Type</th>
                                            <th style="text-align: right" scope="col" class="border-0" ></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pubList as $publist)
                                        <tr>
                                            <td width="5%">{{ $publist->id }}</td>
                                            <td align="right" width="40%">
                                                <a href="#" class="text-danger" wire:click="deleteParentPubType({{ $publist->id }})"> <i class="material-icons">delete</i>Delete</a>
                                                {{ $publist->publication_type }}
                                            </td>
                                            <td align="left" width="50%">
                                                @foreach ($pubSubList as $pubsublist)
                                                @if ($publist->id == $pubsublist->publication_parent_id)
                                                <li>{{ $pubsublist->publication_type_child }} 
                                                    <a href="#" class="text-danger" wire:click="deleteChildrenPubType({{ $pubsublist->id }})"> <i class="material-icons">delete</i>Delete</a>
                                                </li>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td width="5%">
                                                <button type="button" class="btn btn-accent btn-block btn-sm" wire:click="editPubType({{ $publist->id }}, {{ $loop->index }})">  <i class="material-icons">mode_edit</i> Edit</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <h6 style="text-align: center">No Publication Type/s Found!</h6>
                                @endif
                            </div>
                            <div class="modal-footer" style="overflow-x:auto;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="refreshTrick">Close</button>
                                <button type="button" class="btn btn-warning" wire:click="refreshTrick">Reset Form</button>
                                
                                @if ($pubAddMode == true)
                                <button type="submit" class="btn btn-accent">Add Publication Type</button>
                                @else
                                <button type="submit" class="btn btn-accent">Update Publication Type</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>