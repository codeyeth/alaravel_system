<div>
    <div class="row">
        <div class="col-lg-3 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Actions</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3">
                            <span class="d-flex mb-2">
                                <i class="material-icons mr-1">face</i>
                                <strong class="mr-1">Total User Count:</strong>
                                <strong class="text-success">{{ $allUserCount }}</strong>
                            </span>
                            <span class="d-flex mb-2">
                                <i class="material-icons mr-1">sentiment_satisfied_alt</i>
                                <strong class="mr-1">Total Active Users:</strong>
                                <strong class="text-success">{{ $allUserCount }}</strong>
                            </span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalAddUser">
                                <i class="material-icons">add</i> Add New User
                            </button>
                            <div style="margin-left: 10px;"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        {{-- MDOAL ADD USER --}}
        <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="modalAddUser" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="saveNewUser" autocomplete="off">
                        @csrf
                        
                        @if(session('messageSaveNewUser'))
                        <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-info mx-2"></i>
                            <strong style="font-size: 150%">  {!! Str::upper(session('messageSaveNewUser')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                        </div>
                        @endif
                        
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-7">
                                            <strong class="text-muted d-block mb-2">First name <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control  @if (!$errors->any() && $fname != null ) is-valid @endif @error('fname') is-invalid @enderror" id="fname" name="fname" placeholder="First name" autocomplete="off" required autofocus wire:model="fname" >
                                            <div class="valid-feedback">First name looks good</div>
                                            <div class="invalid-feedback"> @error('fname') {{ $message }} @enderror </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <strong class="text-muted d-block mb-2">Middle name</strong>
                                            <input type="text" class="form-control @if (!$errors->any() && $mname != null ) is-valid @endif @error('mname') is-invalid @enderror" id="mname" name="mname" placeholder="Middle name" autocomplete="off" wire:model="mname">
                                            <div class="valid-feedback">Middle name looks good</div>
                                            <div class="invalid-feedback"> @error('mname') {{ $message }} @enderror </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <strong class="text-muted d-block mb-2">Last name <span class="requiredTag">&bullet;</span> </strong>
                                            <input type="text" class="form-control @if (!$errors->any() && $lname != null ) is-valid @endif @error('lname') is-invalid @enderror" id="lname" name="lname" placeholder="Last name" autocomplete="off" wire:model="lname">
                                            <div class="valid-feedback">Last name looks good</div>
                                            <div class="invalid-feedback"> @error('lname') {{ $message }} @enderror </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <strong class="text-muted d-block mb-2">Position <span class="requiredTag">&bullet;</span></strong>
                                            <input type="text" class="form-control @if (!$errors->any() && $position != null ) is-valid @endif @error('position') is-invalid @enderror" id="position" name="position" placeholder="Position" autocomplete="off" required wire:model="position"> 
                                            <div class="valid-feedback">Position looks good</div>
                                            <div class="invalid-feedback"> @error('position') {{ $message }} @enderror </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Division <span class="requiredTag">&bullet;</span></strong>
                                            <select id="division" name="division" class="form-control" wire:change="spitMatchedSection($event.target.value)" wire:model="division" required>
                                                <option disabled selected value="">Select division</option>
                                                @if(count($divisionsList) > 0)
                                                @foreach($divisionsList as $post)
                                                <option value="{{$post->id}}">{{$post->division}}</option>
                                                @endforeach
                                                @else
                                                <option disabled selected>No Division available</option>
                                                @endif                
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Section <span class="requiredTag">&bullet;</span></strong>
                                            <select id="section" name="section" class="form-control" required wire:model="section">
                                                <option disabled selected value="">Select section</option>
                                                @if(count($sectionsList) > 0)
                                                @foreach($sectionsList as $post)
                                                <option value="{{$post->id}}">{{$post->section}}</option>
                                                @endforeach
                                                @else
                                                <option disabled selected>No section available</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <strong class="text-muted d-block mb-2">User Role <span class="requiredTag">&bullet;</span></strong>
                                    <select id="user_role" name="user_role" class="form-control" wire:model="userRole" required>
                                        <option disabled selected value="">Select user role</option>
                                        <option value="1">Administrator</option>
                                        <option value="0">User</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <strong class="text-muted d-block mb-2">Modules <small> | Checked modules will be Accessible for </small> {{ $fname }} {{ $mname }} {{ $lname }}</strong>
                                    
                                    @if ( $userRole == 1 || $userRole == "")
                                    <fieldset>
                                        <div class="custom-control custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input" id="isUserMgt" name="isUserMgt" wire:model="isUserMgt" value="{{ $isUserMgt }}">
                                            <label class="custom-control-label" for="isUserMgt">User Management</label>
                                        </div>
                                    </fieldset> 
                                    @endif
                                    
                                    <fieldset>
                                        <div class="custom-control custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input" id="isBallot" name="isBallot" wire:model="isBallot">
                                            <label class="custom-control-label" for="isBallot">Comelec Ballot Tracking</label>
                                        </div>
                                    </fieldset>
                                    
                                    <fieldset>
                                        <div class="custom-control custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input" id="isDr" name="isDr" wire:model="isDr" wire:click="checkAlsoBallot">
                                            <label class="custom-control-label" for="isDr">SMD Delivery Receipt</label>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="custom-control custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input" id="isSmdSystem" name="isSmdSystem" wire:model="isSmdSystem">
                                            <label class="custom-control-label" for="isSmdSystem">SMD Internal System</label>
                                        </div>
                                    </fieldset>
                                    
                                    <fieldset>
                                        <div class="custom-control custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input" id="isGazette" name="isGazette" wire:model="isGazette">
                                            <label class="custom-control-label" for="isGazette">Gazette Storage (Composing)</label>
                                        </div>
                                    </fieldset>
                                    
                                    <fieldset>
                                        <div class="custom-control custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input" id="isMotorpool" name="isMotorpool" wire:model="isMotorpool">
                                            <label class="custom-control-label" for="isMotorpool">Motorpool Request System</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            
                            <div class="row">
                                @if ( $isBallot == true)
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <strong class="text-muted d-block mb-2">For Comelec Users <small> | Just leave it Untouched for NPO Users</small></strong>
                                    <strong class="text-muted d-block mb-2"><small>Comelec Role</small></strong>
                                    <select id="comelecRole" name="comelecRole" class="form-control" wire:model="comelecRole">
                                        @if(count($comelecRolesList) > 0)
                                        <option disabled selected value="">Select Comelec Role here</option>
                                        @foreach($comelecRolesList as $post)
                                        <option value="{{$post->comelec_role}}">{{ Str::title($post->comelec_role) }}</option>
                                        @endforeach
                                        @else
                                        <option disabled selected>No Comelec Roles available</option>
                                        @endif                
                                    </select>
                                    
                                    <strong class="text-muted d-block mb-2"><small>Barcoded Items Receiver</small></strong>
                                    <select id="barcodedReceiver" name="barcodedReceiver" class="form-control" wire:model="barcodedReceiver">
                                        @if(count($comelecRolesList) > 0)
                                        <option disabled selected value="">Select Receiver here</option>
                                        @foreach($comelecRolesList as $post)
                                        <option value="{{$post->comelec_role}}">{{ Str::title($post->comelec_role) }}</option>
                                        @endforeach
                                        @else
                                        <option disabled selected>No Comelec Roles available</option>
                                        @endif                
                                    </select>
                                </div>
                                @endif
                            </div>
                            
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="refreshTrick">Close</button>
                            <button type="submit" class="btn btn-accent">Save New User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    
</div>