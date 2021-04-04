<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">User List/s - {{ count($userList) }}</h6>
                </div>
                @if(session('messageDeleteUser'))
                <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-info mx-2"></i>
                    <strong style="font-size: 150%">  {!! Str::upper(session('messageDeleteUser')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                </div>
                @endif
                <div class="card-body pt-0 pb-3 text-center">
                    <div class="row border-bottom py-2 mb-0 bg-light">
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-3">
                                <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by ID, Name, User Role, EditPosition, Division, Section" wire:model="search">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" wire:click="exportAllUser">Export All Users</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pb-3 text-center">
                        @if (count($userList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Full Name</th>
                                    <th scope="col" class="border-0">Division - Section</th>
                                    <th scope="col" class="border-0">Position</th>
                                    <th scope="col" class="border-0">Added at</th>
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userList as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ Str::upper($item->name) }}</td>
                                    <td>
                                        
                                        {{-- <small> {{ Str::upper($item->division) }} - {{ Str::upper($item->section) }}</small>  --}}
                                        
                                        @foreach ($this->divisionListLoop as $division_list_loop)
                                        @if ( $division_list_loop->id ==  $item->division)
                                        {{ Str::upper($division_list_loop->division) }}
                                        @endif
                                        @endforeach
                                        -
                                        @foreach ($this->sectionListLoop as $section_list_loop)
                                        @if ( $section_list_loop->id ==  $item->section)
                                        {{ Str::upper($section_list_loop->section) }}
                                        @endif
                                        @endforeach
                                        
                                        
                                    </td>
                                    <td>{{ Str::upper($item->position) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString() }}</td>
                                    <td><button type="button" class="btn btn-accent" data-toggle="modal" data-target="#modalViewUser" wire:click.preventDefault="viewUser({{ $item->id }})"> <i class="material-icons">search</i> View</button></td>
                                    <td>
                                        <a href="#" class="btn btn-accent btn-flat" data-toggle="modal" data-target="#modalEditUser" wire:click="modalEdit({{ $item->id }})"> <i class="material-icons">mode_edit</i> Edit </a>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-danger" wire:click="deleteUser({{ $item->id }})"> <i class="material-icons">delete</i> Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <br>
                        <p style="text-align: center">No users found.</p>    
                        @endif
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center"> 
        {{ $userList->links() }}
    </div>
    
    {{-- MDOAL VIEW USER --}}
    <div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-labelledby="modalViewUser" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">View User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <strong class="text-muted d-block mb-2">Email </strong>
                                    <input type="text" class="form-control" id="viewEmail" name="viewEmail" autocomplete="off" required autofocus wire:model="viewUserParent.viewEmail" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <strong class="text-muted d-block mb-2">First name </strong>
                                    <input type="text" class="form-control" id="viewFname" name="viewFname" autocomplete="off" required autofocus wire:model="viewUserParent.viewFname" >
                                </div>
                                <div class="form-group col-md-5">
                                    <strong class="text-muted d-block mb-2">Middle name</strong>
                                    <input type="text" class="form-control" id="viewMname" name="viewMname" autocomplete="off" wire:model="viewUserParent.viewMname">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <strong class="text-muted d-block mb-2">Last name </strong>
                                    <input type="text" class="form-control" id="viewLname" name="viewLname" autocomplete="off" wire:model="viewUserParent.viewLname">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <strong class="text-muted d-block mb-2">Position</strong>
                                    <input type="text" class="form-control" id="viewPosition" name="viewPosition" autocomplete="off" required wire:model="viewUserParent.viewPosition"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">Division </strong>
                                    
                                    <input type="text" class="form-control" id="viewDivision" name="viewDivision" autocomplete="off" required wire:model="viewUserParent.viewDivision"> 
                                </div>
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">Section </strong>
                                    <input type="text" class="form-control" id="viewSection" name="viewSection" autocomplete="off" required wire:model="viewUserParent.viewSection"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mb-3">
                            <strong class="text-muted d-block mb-2">User Role </strong>
                            <input type="text" class="form-control" id="viewUserRole" name="viewUserRole" autocomplete="off" required wire:model="viewUserParent.viewUserRole"> 
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mb-3">
                            <strong class="text-muted d-block mb-2">Modules <small> | Checked modules will be Accessible for </small> {{ $Editfname }} {{ $Editmname }} {{ $Editlname }}</strong>
                            
                            @if ( $EdituserRole == 1 || $EdituserRole == "")
                            <fieldset>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="viewIsUserMgt" name="viewIsUserMgt" wire:model="viewUserParent.viewIsUserMgt" value="1">
                                    <label class="custom-control-label" for="viewIsUserMgt">User Management</label>
                                </div>
                            </fieldset> 
                            @endif
                            
                            <fieldset>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="viewIsBallot" name="viewIsBallot" value="1" wire:model="viewUserParent.viewIsBallot">
                                    <label class="custom-control-label" for="viewIsBallot">Comelec Ballot Tracking</label>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="viewIsDr" name="viewIsDr" value="1" wire:model="viewUserParent.viewIsDr">
                                    <label class="custom-control-label" for="viewIsDr">SMD Deliver Receipt</label>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="viewIsGazette" name="viewIsGazette" value="1" wire:model="viewUserParent.viewIsGazette">
                                    <label class="custom-control-label" for="viewIsGazette">Gazette Storage (Composing)</label>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="viewIsMotorpool" name="viewIsMotorpool" value="1" wire:model="viewUserParent.viewIsMotorpool">
                                    <label class="custom-control-label" for="viewIsMotorpool">Motorpool Request System</label>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mb-3">
                            <strong class="text-muted d-block mb-2">For Comelec Users <small> | Just leave it Untouched for NPO Users</small></strong>
                            <strong class="text-muted d-block mb-2"><small>Comelec Role</small></strong>
                            <input type="text" class="form-control" id="viewComelecRole" name="viewComelecRole" autocomplete="off" required wire:model="viewUserParent.viewComelecRole"> 
                            
                            <strong class="text-muted d-block mb-2"><small>Barcoded Items Receiver</small></strong>
                            <input type="text" class="form-control" id="viewBarcodedReceiver" name="viewBarcodedReceiver" autocomplete="off" required wire:model="viewUserParent.viewBarcodedReceiver"> 
                        </div>
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- MDOAL EDIT USER --}}
    <div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="modalEditUser" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="updateUser({{ $editId }})" autocomplete="off">
                    @csrf
                    
                    @if(session('messageEditUser'))
                    <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-info mx-2"></i>
                        <strong style="font-size: 150%">  {!! Str::upper(session('messageEditUser')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                    </div>
                    @endif
                    
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <strong class="text-muted d-block mb-2">First name <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control  @if (!$errors->any() && $Editfname != null ) is-valid @endif @error('Editfname') is-invalid @enderror" id="Editfname" name="Editfname" placeholder="First name" autocomplete="off" required autofocus wire:model="Editfname" >
                                        <div class="valid-feedback">First name looks good</div>
                                        <div class="invalid-feedback"> @error('Editfname') {{ $message }} @enderror </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <strong class="text-muted d-block mb-2">Middle name</strong>
                                        <input type="text" class="form-control @if (!$errors->any() && $Editmname != null ) is-valid @endif @error('Editmname') is-invalid @enderror" id="Editmname" name="Editmname" placeholder="Middle name" autocomplete="off" wire:model="Editmname">
                                        <div class="valid-feedback">Middle name looks good</div>
                                        <div class="invalid-feedback"> @error('Editmname') {{ $message }} @enderror </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Last name <span class="requiredTag">&bullet;</span> </strong>
                                        <input type="text" class="form-control @if (!$errors->any() && $Editlname != null ) is-valid @endif @error('Editlname') is-invalid @enderror" id="Editlname" name="Editlname" placeholder="Last name" autocomplete="off" wire:model="Editlname">
                                        <div class="valid-feedback">Last name looks good</div>
                                        <div class="invalid-feedback"> @error('Editlname') {{ $message }} @enderror </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Position <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control @if (!$errors->any() && $Editposition != null ) is-valid @endif @error('Editposition') is-invalid @enderror" id="Editposition" name="Editposition" placeholder="EditPosition" autocomplete="off" required wire:model="Editposition"> 
                                        <div class="valid-feedback">Position looks good</div>
                                        <div class="invalid-feedback"> @error('Editposition') {{ $message }} @enderror </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <strong class="text-muted d-block mb-2">Division <span class="requiredTag">&bullet;</span></strong>
                                        <select id="Editdivision" name="Editdivision" class="form-control" wire:change="spitMatchedSection($event.target.value)" wire:model="Editdivision" required>
                                            <option disabled selected value="">Select division</option>
                                            @if(count($EditdivisionsList) > 0)
                                            @foreach($EditdivisionsList as $post)
                                            <option value="{{$post->id}}">{{$post->division}}</option>
                                            @endforeach
                                            @else
                                            <option disabled selected>No Division available</option>
                                            @endif                
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <strong class="text-muted d-block mb-2">Section <span class="requiredTag">&bullet;</span></strong>
                                        <select id="Editsection" name="Editsection" class="form-control" required wire:model="Editsection">
                                            <option disabled selected value="">Select section</option>
                                            @if(count($EditsectionsList) > 0)
                                            @foreach($EditsectionsList as $post)
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
                                <select id="EdituserRole" name="EdituserRole" class="form-control" wire:model="EdituserRole" required>
                                    <option disabled selected value="">Select user role</option>
                                    <option value="1">Administrator</option>
                                    <option value="0">User</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12 mb-3">
                                <strong class="text-muted d-block mb-2">Modules <small> | Checked modules will be Accessible for </small> {{ $Editfname }} {{ $Editmname }} {{ $Editlname }}</strong>
                                
                                @if ( $EdituserRole == 1 || $EdituserRole == "")
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="EditisUserMgt" name="EditisUserMgt" wire:model="EditisUserMgt" value="1">
                                        <label class="custom-control-label" for="EditisUserMgt">User Management</label>
                                    </div>
                                </fieldset> 
                                @endif
                                
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="EditisBallot" name="EditisBallot" value="1" wire:model="EditisBallot">
                                        <label class="custom-control-label" for="EditisBallot">Comelec Ballot Tracking</label>
                                    </div>
                                </fieldset>
                                
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="EditisDr" name="EditisDr" value="1" wire:model="EditisDr" wire:click="checkAlsoBallot">
                                        <label class="custom-control-label" for="EditisDr">SMD Deliver Receipt</label>
                                    </div>
                                </fieldset>
                                
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="EditisGazette" name="EditisGazette" value="1" wire:model="EditisGazette">
                                        <label class="custom-control-label" for="EditisGazette">Gazette Storage (Composing)</label>
                                    </div>
                                </fieldset>
                                
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="EditisMotorpool" name="EditisMotorpool" value="1" wire:model="EditisMotorpool">
                                        <label class="custom-control-label" for="EditisMotorpool">Motorpool Request System</label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        
                        <div class="row">
                            @if ( $EditisBallot == true)
                            <div class="col-sm-12 col-md-12 mb-3">
                                <strong class="text-muted d-block mb-2">For Comelec Users <small> | Just leave it Untouched for NPO Users</small></strong>
                                <strong class="text-muted d-block mb-2"><small>Comelec Role</small></strong>
                                <select id="EditcomelecRole" name="EditcomelecRole" class="form-control" wire:model="EditcomelecRole">
                                    @if(count($EditcomelecRolesList) > 0)
                                    <option disabled selected value="">Select Comelec Role here</option>
                                    @foreach($EditcomelecRolesList as $post)
                                    <option value="{{$post->comelec_role}}">{{ Str::title($post->comelec_role) }}</option>
                                    @endforeach
                                    @else
                                    <option disabled selected>No Comelec Roles available</option>
                                    @endif                
                                </select>
                                
                                <strong class="text-muted d-block mb-2"><small>Barcoded Items Receiver</small></strong>
                                <select id="EditbarcodedReceiver" name="EditbarcodedReceiver" class="form-control" wire:model="EditbarcodedReceiver">
                                    @if(count($EditcomelecRolesList) > 0)
                                    <option disabled selected value="">Select Receiver here</option>
                                    @foreach($EditcomelecRolesList as $post)
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
                        <button type="submit" class="btn btn-accent">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>