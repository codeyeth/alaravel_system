<div>
    <div class="row">
        <style scoped>
            .requiredTag{
                color: red;
            }
            input{
                text-transform: uppercase;
            }
        </style>
        
        <div class="col-lg-8 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">User Details</h6>
                </div>
                <ul class="list-group list-group-flush">
                    {!! Form::open(['action' => ['RrUserManagementController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data' , 'id' => 'update_user_form', 'class' => '']) !!}
                    @csrf
                    
                    <li class="list-group-item p-0 px-3 pt-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <strong class="text-muted d-block mb-2">First name <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control  @if (!$errors->any() && $fname != null ) is-valid @endif @error('fname') is-invalid @enderror" id="fname" name="fname" placeholder="First name" autocomplete="off" required autofocus wire:model="fname" >
                                        <div class="valid-feedback">First name looks good</div>
                                        <div class="invalid-feedback"> @error('fname') {{ $message }} @enderror </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <strong class="text-muted d-block mb-2">Middle name</strong>
                                        <input type="text" class="form-control @if (!$errors->any() && $mname != null ) is-valid @endif @error('mname') is-invalid @enderror" id="mname" name="mname" placeholder="Middle name" autocomplete="off" wire:model="mname">
                                        <div class="valid-feedback">Middle name looks good</div>
                                        <div class="invalid-feedback"> @error('mname') {{ $message }} @enderror </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <strong class="text-muted d-block mb-2">Last name <span class="requiredTag">&bullet;</span> </strong>
                                        <input type="text" class="form-control @if (!$errors->any() && $lname != null ) is-valid @endif @error('lname') is-invalid @enderror" id="lname" name="lname" placeholder="Last name" autocomplete="off" wire:model="lname">
                                        <div class="valid-feedback">Last name looks good</div>
                                        <div class="invalid-feedback"> @error('lname') {{ $message }} @enderror </div>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">Position <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control @if (!$errors->any() && $position != null ) is-valid @endif @error('position') is-invalid @enderror" id="position" name="position" placeholder="Position" autocomplete="off" required wire:model="position"> 
                                        <div class="valid-feedback">Position looks good</div>
                                        <div class="invalid-feedback"> @error('position') {{ $message }} @enderror </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">Division <span class="requiredTag">&bullet;</span></strong>
                                        <select id="division" name="division" class="form-control" wire:change="spitMatchedSection($event.target.value)" required>
                                            @if(count($divisionsList) > 0)
                                            <option disabled selected value="">Select division</option>
                                            @foreach($divisionsList as $post0)
                                            <option value="{{$post0->id}}" {{ $post0->id == $selectedDivision ? 'selected' : ''}}>{{$post0->division}}</option>
                                            @endforeach
                                            @else
                                            <option disabled selected>No Division available</option>
                                            @endif                
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">Section <span class="requiredTag">&bullet;</span></strong>
                                        <select id="section" name="section" class="form-control" required>
                                            @if(count($sectionsList) > 0)
                                            <option disabled selected value="">Select section</option>
                                            @foreach($sectionsList as $post1)
                                            <option value="{{$post1->id}}" {{ $post1->id == $selectedSection ? 'selected' : ''}}>{{$post1->section}}</option>
                                            @endforeach
                                            @else
                                            <option disabled selected>No section available</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </li>
                    
                    <li class="list-group-item p-0 px-3 pt-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 mb-3">
                                <strong class="text-muted d-block mb-2">User Role <span class="requiredTag">&bullet;</span></strong>
                                <select id="user_role" name="user_role" class="form-control" wire:model="userRole" required>
                                    <option disabled selected value="">Select user role</option>
                                    <option value="1">Administrator</option>
                                    <option value="0">User</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    
                    <li class="list-group-item p-0 px-3 pt-3">
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-4 mb-3">
                                <strong class="text-muted d-block mb-2">Modules</strong>
                                
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="user_mgt" name="user_mgt" value="1" @if($is_user_mgt) checked @endif>
                                        <label class="custom-control-label" for="user_mgt">User Management</label>
                                    </div>
                                </fieldset>
                                
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="is_ballot_tracking" name="is_ballot_tracking" value="1" @if($is_ballot_tracking) checked @endif>
                                        <label class="custom-control-label" for="is_ballot_tracking">Comelec Ballot Tracking</label>
                                    </div>
                                </fieldset>
                                
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="is_dr" name="is_dr" value="1" @if($is_dr) checked @endif>
                                        <label class="custom-control-label" for="is_dr">SMD Delivery Receipt</label>
                                    </div>
                                </fieldset>
                                
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="is_gazette" name="is_gazette" value="1" @if($is_gazette) checked @endif>
                                        <label class="custom-control-label" for="is_gazette">Gazette Storage (Composing)</label>
                                    </div>
                                </fieldset>
                                
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="is_motorpool" name="is_motorpool" value="1" @if($is_motorpool) checked @endif>
                                        <label class="custom-control-label" for="is_motorpool">Motorpool Request System</label>
                                    </div>
                                </fieldset>
                                
                            </div>
                            
                            <div class="col-sm-12 col-md-4 mb-3">
                                <strong class="text-muted d-block mb-2">For Comelec Users <small> | Just leave it Untouched for NPO Users</small></strong>
                                <strong class="text-muted d-block mb-2"><small>Comelec Role</small></strong>
                                <select id="comelec_role" name="comelec_role" class="form-control" >
                                    @if(count($comelecRolesList) > 0)
                                    <option disabled selected value="">Select Comelec Role here</option>
                                    @foreach($comelecRolesList as $com_post)
                                    <option value="{{$com_post->comelec_role}}" {{ $com_post->comelec_role == $selectedComelecRole ? 'selected' : ''}}>{{$com_post->comelec_role}}</option>
                                    @endforeach
                                    @else
                                    <option disabled selected>No Comelec Roles available</option>
                                    @endif
                                </select>
                                
                                <strong class="text-muted d-block mb-2"><small>Barcoded Items Receiver</small></strong>
                                <select id="barcoded_receiver" name="barcoded_receiver" class="form-control" >
                                    @if(count($comelecRolesList) > 0)
                                    <option disabled selected value="">Select Receiver here</option>
                                    @foreach($comelecRolesList as $com_post1)
                                    <option value="{{$com_post1->comelec_role}}" {{ $com_post1->comelec_role == $selectedBarcodedReceiver ? 'selected' : ''}}>{{$com_post1->comelec_role}}</option>
                                    @endforeach
                                    @else
                                    <option disabled selected>No Comelec Roles available</option>
                                    @endif
                                </select>
                                
                            </div>
                            
                        </div>
                    </li>
                    
                    {{Form::hidden('_method', 'PUT')}}
                    <li class="list-group-item px-3">
                        <button type="submit" class="btn btn-accent">Update User</button>
                        <a href="{{ asset('user_mgt') }}" class="btn btn-warning"><i class="material-icons">arrow_back</i> Back</a>            
                    </li>
                    {!! Form::close() !!}
                    
                </ul>
            </div>
        </div>
    </div>
</div>