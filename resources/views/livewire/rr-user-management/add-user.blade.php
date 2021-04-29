<div>
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
                                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Juan" autocomplete="off" required wire:model="fname" autofocus>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <strong class="text-muted d-block mb-2">Middle name</strong>
                                        <input type="text" class="form-control" id="mname" name="mname" placeholder="M" autocomplete="off" wire:model="mname">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Last name <span class="requiredTag">&bullet;</span> </strong>
                                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Dela Cruz" autocomplete="off" wire:model="lname">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Position <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="position" name="position" placeholder="Office Staff" autocomplete="off" required wire:model="position"> 
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
                                    @if (Auth::user()->is_super_admin == true)
                                    <option value="2">Super Administrator</option>
                                    @endif
                                    <option value="1">Administrator</option>
                                    <option value="0">User</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-sm-12 col-md-12 mb-3">
                                <strong class="text-muted d-block mb-2">Modules <small> | Checked modules will be Accessible </small></strong>
                                
                                @if(Auth::user()->is_user_mgt == true )
                                @if ( $userRole == 1 || $userRole == 2 || $userRole == "")
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="isUserMgt" name="isUserMgt" wire:model="isUserMgt" value="{{ $isUserMgt }}">
                                        <label class="custom-control-label" for="isUserMgt">User Management</label>
                                    </div>
                                </fieldset> 
                                @endif
                                @endif
                                
                                @if(Auth::user()->is_ballot_tracking == true )
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="isBallot" name="isBallot" wire:model="isBallot">
                                        <label class="custom-control-label" for="isBallot">Comelec Ballot Tracking</label>
                                    </div>
                                </fieldset>
                                @endif

                                @if(Auth::user()->is_dr == true )
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="isDr" name="isDr" wire:model="isDr">
                                        <label class="custom-control-label" for="isDr">SMD Delivery Receipt (For Ballot Tracking)</label>
                                    </div>
                                </fieldset>
                                @endif

                                @if(Auth::user()->is_smd_system == true )
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="isSmdSystem" name="isSmdSystem" wire:model="isSmdSystem">
                                        <label class="custom-control-label" for="isSmdSystem">SMD Internal System</label>
                                    </div>
                                </fieldset>
                                @endif

                                @if(Auth::user()->is_gazette == true )
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="isGazette" name="isGazette" wire:model="isGazette">
                                        <label class="custom-control-label" for="isGazette">Gazette Storage (Composing)</label>
                                    </div>
                                </fieldset>
                                @endif

                                @if(Auth::user()->is_motorpool == true )
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="isMotorpool" name="isMotorpool" wire:model="isMotorpool">
                                        <label class="custom-control-label" for="isMotorpool">Motorpool Request System</label>
                                    </div>
                                </fieldset>
                                @endif

                            </div>
                        </div>
                        
                        <div class="row">
                            @if ( $isBallot == true)
                            <div class="col-sm-12 col-md-12 mb-3">
                                <strong class="text-muted d-block mb-3">For Comelec Users <small> | Just leave it Untouched for NPO Users</small></strong>
                                
                                <strong class="text-muted d-block mb-2">Comelec Role</strong>
                                <select id="comelecRole" name="comelecRole" class="form-control mb-3" wire:model="comelecRole" wire:change="spitBarcodedReceiverList($event.target.value)">
                                    @if(count($comelecRolesList) > 0)
                                    <option disabled selected value="">Select Comelec Role here</option>
                                    @foreach($comelecRolesList as $post)
                                    <option value="{{$post->comelec_role}}">{{ Str::title($post->comelec_role) }}</option>
                                    @endforeach
                                    @else
                                    <option disabled selected>No Comelec Roles available</option>
                                    @endif                
                                </select>
                                
                                @if(count($barcodedReceiverList) > 0)
                                <strong class="text-muted d-block mb-2">Barcoded Items Receiver</strong>
                                <select id="barcodedReceiver" name="barcodedReceiver" class="form-control" wire:model="barcodedReceiver">
                                    @if(count($barcodedReceiverList) > 0)
                                    <option disabled selected value="">Select Receiver here</option>
                                    @foreach($barcodedReceiverList as $bar_post)
                                    <option value="{{$bar_post->comelec_role}}">{{ Str::title($bar_post->comelec_role) }}</option>
                                    @endforeach
                                    @else
                                    <option disabled selected>No Comelec Roles available</option>
                                    @endif                
                                </select>
                                @endif
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
