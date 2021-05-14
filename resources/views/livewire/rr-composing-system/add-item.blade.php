<div>
    <div class="row">
        
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="refreshTrick">Close</button>
                            <button type="submit" class="btn btn-accent">Add OG Softcopy</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
        <script>
            window.addEventListener('clear-file', event => {
                document.getElementById("fileUpload").value = null;
            })
        </script>
        
    </div>
</div>