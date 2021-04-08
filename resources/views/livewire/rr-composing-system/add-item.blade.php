<div>
    <div class="row">
        <style scoped>
            .requiredTag{
                color: red;
            }
        </style>
        
        {{-- MODAL ADD SOFTCOPY --}}
        <div class="modal fade" id="modalAddOg" tabindex="-1" role="dialog" aria-labelledby="modalAddOg" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add OG Softcopy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="saveSoftcopy" autocomplete="off">
                        @csrf
                        
                        {{-- @include('inc.message') --}}
                        
                        @if(session('messageSaveSoftcopy'))
                        <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-info mx-2"></i>
                            <strong style="font-size: 150%">  {!! Str::upper(session('messageSaveSoftcopy')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                        </div>
                        @endif
                        
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <strong class="text-muted d-block mb-2">Article Title <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control" id="articleTitle" name="articleTitle" placeholder="Article Title" autocomplete="off" required autofocus wire:model="articleTitle" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Publication Type <span class="requiredTag">&bullet;</span></strong>
                                            <select name="publicationType" id="publicationType" class="form-control" required wire:model="publicationType" wire:change="spitMatchedSubPublicType($event.target.value)">
                                                <option disabled selected value="">Select here</option>
                                                @if (count($pubList) > 0)
                                                @foreach ($pubList as $publicationSelectType)
                                                <option value="{{ $publicationSelectType->id }}">{{ $publicationSelectType->publication_type }}</option>
                                                @endforeach
                                                @else
                                                <option disabled selected value="">No Available Type</option>
                                                @endif
                                            </select>
                                        </div>
                                        
                                        @if (count($pubSelectSubList) > 0)
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Publication Sub Type</strong>
                                            <select name="publicationSubType" id="publicationSubType" class="form-control" required wire:model="publicationSubType">
                                                <option disabled selected value="">Select here</option>
                                                @foreach ($pubSelectSubList as $publicationselectsublist)
                                                <option value="{{ $publicationselectsublist->id }}">{{ $publicationselectsublist->publication_type_child }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Date Published <span class="requiredTag">&bullet;</span> </strong>
                                            <input type="date" class="form-control" id="datePublished" name="datePublished" placeholder="Date Published" wire:model="datePublished" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Publication Status </strong>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox mb-1">
                                                    <input type="checkbox" class="custom-control-input" id="isDownloadable" name="isDownloadable" value="{{ $isDownloadable }}" wire:model="isDownloadable">
                                                    <label class="custom-control-label" for="isDownloadable">IS DOWNLOADABLE</label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-1">
                                                    <input type="checkbox" class="custom-control-input" id="isSearchable" name="isSearchable" value="{{ $isSearchable }}" wire:model="isSearchable">
                                                    <label class="custom-control-label" for="isSearchable">IS SEARCHABLE</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-8 mb-3">
                                    <strong class="text-muted d-block mb-2">Upload File <small>File Max size 50mb | Single File only | File Type PDF</small> <span class="requiredTag">&bullet;</span></strong> 
                                    <input type="file" class="form-control @if (!$errors->any() && $fileUpload != null ) is-valid @endif @error('fileUpload') is-invalid @enderror" name="fileUpload" id="fileUpload" wire:model="fileUpload" required>
                                    <div class="invalid-feedback"> @error('fileUpload') {{ $message }} @enderror </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-accent">Add OG Softcopy</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
        {{-- MDOAL ADD PUBLICATION TYPE --}}
        <div class="modal fade" id="modalPublication" tabindex="-1" role="dialog" aria-labelledby="modalPublication" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                            
                            <div class="modal-body">
                                
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
                            <div class="modal-footer">
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

            <div class="col-lg-6 col-md-12">
                <div class="card card-small mb-3">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Actions</h6>
                    </div>
                    @if(session('messageUpdateSearchEngine'))
                    <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-info mx-2"></i>
                        <strong style="font-size: 150%">  {!! Str::upper(session('messageUpdateSearchEngine')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                    </div>
                    @endif
                    
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-3">
                                <span class="d-flex mb-2">
                                    <i class="material-icons mr-1">search</i>
                                    <strong class="mr-1">Search Engine Status:</strong> 
                                    @if ($isOn == true)
                                    <strong class="text-success">Online</strong>
                                    @else
                                    <strong class="text-danger">Offline</strong>
                                    @endif
                                    <a class="ml-auto" href="{{ asset('/search_engine_composing') }}" target="_blank">View</a>
                                </span>
                                <span class="d-flex mb-2">
                                    <i class="material-icons mr-1">visibility</i>
                                    <strong class="mr-1">Visible Publications:</strong>
                                    <strong class="text-success">{{ $visiblePublications }}</strong>
                                    {{-- <a class="ml-auto" href="#">Edit</a> --}}
                                </span>
                                <span class="d-flex mb-2">
                                    <i class="material-icons mr-1">download</i>
                                    <strong class="mr-1">Downloadable Publications:</strong>
                                    <strong class="text-success">{{ $visiblePublications }}</strong>
                                    {{-- <a class="ml-auto" href="#">Edit</a> --}}
                                </span>
                                <span class="d-flex mb-2">
                                    <i class="material-icons mr-1">list</i>
                                    <strong class="mr-1">Total Publications:</strong>
                                    <strong class="text-success">{{ $allPublications }}</strong>
                                    {{-- <a class="ml-auto" href="#">Edit</a> --}}
                                </span>
                            </li>
                            <li class="list-group-item d-flex px-3">
                                <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalAddOg">
                                    <i class="material-icons">add</i> Add New Softcopy
                                </button>
                                <div style="margin-left: 10px;"></div>
                                <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalPublication">
                                    <i class="material-icons">add</i> Manage Publication Type
                                </button>
                                <div style="margin-left: 10px;"></div>
                                @if ($isOn == true)
                                <button class="btn btn-sm btn-danger ml-auto" wire:click="updateSearchEngine(false)">
                                    <i class="material-icons">power</i> Turn Off Search Engine
                                </button>
                                @else
                                <button class="btn btn-sm btn-success ml-auto" wire:click="updateSearchEngine(true)">
                                    <i class="material-icons">power</i> Turn On Search Engine
                                </button>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
        
        <script>
            window.addEventListener('clear-file', event => {
                document.getElementById("fileUpload").value = null;
            })
        </script>
    </div>