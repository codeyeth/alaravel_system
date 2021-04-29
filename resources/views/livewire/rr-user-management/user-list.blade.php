<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">User List/s </h6>
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
                            <div class="d-flex">
                                <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                                    <label class="btn btn-white {{ $keywordMode == true ? 'active' : ''}}" wire:click="$set('keywordMode', true)"><input type="radio" name="options" id="option1"> Search by Keyword </label>
                                    <label class="btn btn-white {{ $keywordMode == true ? '' : 'active'}}" wire:click="$set('keywordMode', false)"><input type="radio" name="options" id="option2"> Search by Dates</label>
                                </div>
                                <div class="p-2"></div>
                                <div class="ml-auto p-2">
                                    Total of <b class="text-success" style="font-size: 120%;"> {{ $userListCount }} </b> Result/s Found
                                </div>
                            </div>
                        </div>
                        
                        @if ($keywordMode == true)
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg mb-0" type="text" placeholder="Full Name, Position" wire:model="search" value="{{ $keywordMode }}">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg mb-0" type="date" placeholder="Search" wire:model="search">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                {{-- TABLE --}}
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pb-3 text-center">
                        @if (count($userList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0" style="text-align: right">Full Name</th>
                                    <th scope="col" class="border-0" style="text-align: left">Position</th>
                                    <th scope="col" class="border-0" style="text-align: right">User Role</th>
                                    <th scope="col" class="border-0" style="text-align: left">Modules</th>
                                    <th scope="col" class="border-0" style="text-align: right">Created by</th>
                                    <th scope="col" class="border-0" width="2%"></th>
                                    <th scope="col" class="border-0" width="2%"></th>
                                    <th scope="col" class="border-0" width="2%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userList as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td style="text-align: right">{{ Str::upper($item->name) }}</td>
                                    <td style="text-align: left">
                                        {{ Str::upper($item->position) }} <br> at 
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
                                    <td style="text-align: right">
                                        @if ( $item->is_super_admin == true )
                                        <span class="badge badge-accent">SUPER ADMINISTRATOR</span>
                                        @else
                                        @if ( $item->is_admin == true )
                                        <span class="badge badge-info">ADMINISTRATOR</span>
                                        @else
                                        <span class="badge badge-success">USER</span>
                                        @endif
                                        @endif
                                    </td>
                                    <td style="text-align: left">
                                        @if ( $item->is_super_admin == true )
                                        <span class="badge badge-secondary">ALL MODULES</span>
                                        @else
                                        
                                        @if ( $item->is_user_mgt == true )
                                        <span class="badge badge-secondary">USER MANAGEMENT</span>
                                        @endif
                                        
                                        @if ( $item->is_ballot_tracking == true )
                                        <span class="badge badge-secondary">BALLOT TRACKING</span>
                                        @endif
                                        
                                        @if ( $item->is_dr == true )
                                        <span class="badge badge-secondary">DR SYSTEM ( B.T )</span>
                                        @endif
                                        
                                        @if ( $item->is_gazette == true )
                                        <span class="badge badge-secondary">COMPOSING SYSTEM</span>
                                        @endif
                                        
                                        @if ( $item->is_motorpool == true )
                                        <span class="badge badge-secondary">MOTORPOOL SYSTEM</span>
                                        @endif
                                        
                                        @if ( $item->is_smd_system == true )
                                        <span class="badge badge-secondary">SMD SYSTEM</span>
                                        @endif
                                        
                                        @endif
                                    </td>
                                    <td style="text-align: right">{{ $item->created_by_name }} <br> at {{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString() }}</td>

                                    @if( $item->created_by_id == Auth::user()->id || Auth::user()->is_super_admin == true)
                                    <td width="2%" >
                                        <button type="button" class="btn btn-accent" data-toggle="modal" data-target="#modalViewUser" wire:click.preventDefault="viewUser({{ $item->id }})" title="View"> <i class="material-icons">search</i></button>
                                    </td>
                                    <td width="2%" >
                                        <button type="button" class="btn btn-accent btn-flat" data-toggle="modal" data-target="#modalEditUser" wire:click="modalEdit({{ $item->id }})" title="Edit"> <i class="material-icons">mode_edit</i></a>
                                    </td>
                                    <td width="2%" >
                                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmDelete" wire:click="confirmDeleteUser({{ $item->id }})" title="Delete"> <i class="material-icons">delete</i></button>
                                    </td>
                                    @else
                                    <td width="2%" >
                                        <button type="button" class="btn btn-accent" title="View" disabled> <i class="material-icons">search</i></button>
                                    </td>
                                    <td width="2%" >
                                        <button type="button" class="btn btn-accent btn-flat" title="Edit" disabled> <i class="material-icons">mode_edit</i></a>
                                    </td>
                                    <td width="2%" >
                                        <button type="submit" class="btn btn-danger" title="Delete" disabled> <i class="material-icons">delete</i></button>
                                    </td>
                                    @endif
                                    
                                    
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
    
    {{-- USER DELETION CONFIRMATION DIALOG --}}
    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDelete" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm User Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($isDeleteSuccess == false)
                    <h4 style="text-align: center" class="text-default mb-2">User <b class="text-secondary">  {{ Str::upper($deleteName) }} </b> will be Deleted Permanently.</h4>
                    <h5 style="text-align: center" class="text-default mb-3">This action is <b class="text-danger"> irreversible </b>do you want to Proceed?</h5>
                    
                    <div style="text-align: center">
                        <button class="btn btn-accent" type="button"wire:click="deleteUser({{ $deleteId }})"><i class="material-icons">check</i> Proceed</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="material-icons">cancel</i> Cancel</button>
                    </div>
                    @endif
                    
                    @if ($isDeleteSuccess == true)
                    <h4 style="text-align: center" class="text-accent mb-2"><b> User Deleted Successfully.</b></h4>
                    @endif
                    
                </div>
                <div class="modal-footer">
                    @if ($isDeleteSuccess == true)
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    {{-- MDOAL EDIT USER --}}
    <div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="modalEditUser" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit User </h5>
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
                                        <input type="text" class="form-control" id="Editfname" name="Editfname" placeholder="First name" autocomplete="off" required autofocus wire:model="Editfname" >
                                    </div>
                                    <div class="form-group col-md-5">
                                        <strong class="text-muted d-block mb-2">Middle name</strong>
                                        <input type="text" class="form-control" id="Editmname" name="Editmname" placeholder="Middle name" autocomplete="off" wire:model="Editmname">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Last name <span class="requiredTag">&bullet;</span> </strong>
                                        <input type="text" class="form-control" id="Editlname" name="Editlname" placeholder="Last name" autocomplete="off" wire:model="Editlname">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <strong class="text-muted d-block mb-2">Position <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="Editposition" name="Editposition" placeholder="EditPosition" autocomplete="off" required wire:model="Editposition"> 
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
                                            @foreach($EditsectionsList as $post_section)
                                            <option value="{{$post_section->id}}">{{$post_section->section}}</option>
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
                                @if ( $EdituserRole == 1 || $EdituserRole == 2 || $EdituserRole == "")
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="EditisUserMgt" name="EditisUserMgt" wire:model="EditisUserMgt" value="1">
                                        <label class="custom-control-label" for="EditisUserMgt">User Management</label>
                                    </div>
                                </fieldset> 
                                @endif
                                @endif
                                
                                @if(Auth::user()->is_ballot_tracking == true )
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="EditisBallot" name="EditisBallot" value="1" wire:model="EditisBallot">
                                        <label class="custom-control-label" for="EditisBallot">Comelec Ballot Tracking</label>
                                    </div>
                                </fieldset>
                                @endif
                                
                                @if(Auth::user()->is_dr == true )
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="EditisDr" name="EditisDr" value="1" wire:model="EditisDr">
                                        <label class="custom-control-label" for="EditisDr">SMD Delivery Receipt</label>
                                    </div>
                                </fieldset>
                                @endif
                        
                                @if(Auth::user()->is_smd_system == true )
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="EditisSmdSystem" name="EditisSmdSystem" value="1" wire:model="EditisSmdSystem">
                                        <label class="custom-control-label" for="EditisSmdSystem">SMD Internal System</label>
                                    </div>
                                </fieldset>
                                @endif

                                @if(Auth::user()->is_gazette == true )
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="EditisGazette" name="EditisGazette" value="1" wire:model="EditisGazette">
                                        <label class="custom-control-label" for="EditisGazette">Gazette Storage (Composing)</label>
                                    </div>
                                </fieldset>
                                @endif

                                @if(Auth::user()->is_motorpool == true )
                                <fieldset>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="EditisMotorpool" name="EditisMotorpool" value="1" wire:model="EditisMotorpool">
                                        <label class="custom-control-label" for="EditisMotorpool">Motorpool Request System</label>
                                    </div>
                                </fieldset>
                                @endif

                            </div>
                        </div>
                        
                        <div class="row">
                            @if ( $EditisBallot == true)
                            <div class="col-sm-12 col-md-12 mb-3">
                                <strong class="text-muted d-block mb-3">For Comelec Users <small> | Just leave it Untouched for NPO Users</small></strong>
                                
                                <strong class="text-muted d-block mb-2">Comelec Role</strong>
                                <select id="EditcomelecRole" name="EditcomelecRole" class="form-control" wire:model="EditcomelecRole" wire:change="spitBarcodedReceiverList($event.target.value)">
                                    @if(count($EditcomelecRolesList) > 0)
                                    <option disabled selected value="">Select Comelec Role here</option>
                                    @foreach($EditcomelecRolesList as $post)
                                    <option value="{{$post->comelec_role}}">{{ Str::title($post->comelec_role) }}</option>
                                    @endforeach
                                    @else
                                    <option disabled selected>No Comelec Roles available</option>
                                    @endif                
                                </select>
                                
                                @if(count($EditbarcodedReceiverList) > 0)
                                <strong class="text-muted d-block mb-2">Barcoded Items Receiver</strong>
                                <select id="EditbarcodedReceiver" name="EditbarcodedReceiver" class="form-control" wire:model="EditbarcodedReceiver">
                                    @if(count($EditbarcodedReceiverList) > 0)
                                    <option disabled selected value="">Select Receiver here</option>
                                    @foreach($EditbarcodedReceiverList as $post)
                                    <option value="{{$post->comelec_role}}">{{ Str::title($post->comelec_role) }}</option>
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
                        <button type="submit" class="btn btn-accent">Update User</button>
                    </div>
                </form>
            </div>
        </div>
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
                                    <input type="text" class="form-control" id="viewEmail" name="viewEmail" autocomplete="off" required autofocus wire:model="viewEmail" >
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <strong class="text-muted d-block mb-2">First name </strong>
                                    <input type="text" class="form-control" id="viewFname" name="viewFname" autocomplete="off" required autofocus wire:model="viewFname" >
                                </div>
                                <div class="form-group col-md-5">
                                    <strong class="text-muted d-block mb-2">Middle name</strong>
                                    <input type="text" class="form-control" id="viewMname" name="viewMname" autocomplete="off" wire:model="viewMname">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <strong class="text-muted d-block mb-2">Last name </strong>
                                    <input type="text" class="form-control" id="viewLname" name="viewLname" autocomplete="off" wire:model="viewLname">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <strong class="text-muted d-block mb-2">Position</strong>
                                    <input type="text" class="form-control" id="viewPosition" name="viewPosition" autocomplete="off" required wire:model="viewPosition"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">Division </strong>
                                    
                                    <input type="text" class="form-control" id="viewDivision" name="viewDivision" autocomplete="off" required wire:model="viewDivision"> 
                                </div>
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">Section </strong>
                                    <input type="text" class="form-control" id="viewSection" name="viewSection" autocomplete="off" required wire:model="viewSection"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mb-3">
                            <strong class="text-muted d-block mb-2">User Role </strong>
                            <input type="text" class="form-control" id="viewUserRole" name="viewUserRole" autocomplete="off" required wire:model="viewUserRole"> 
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mb-3">
                            <strong class="text-muted d-block mb-2">Modules <small> | Checked modules will be Accessible for </small></strong>
                            @if( $viewIsUserMgt == true)
                            <fieldset>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="viewIsUserMgt" name="viewIsUserMgt" wire:model="viewIsUserMgt" value="1">
                                    <label class="custom-control-label" for="viewIsUserMgt">User Management</label>
                                </div>
                            </fieldset> 
                            @endif
                            
                            @if( $viewIsBallot == true)
                            <fieldset>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="viewIsBallot" name="viewIsBallot" value="1" wire:model="viewIsBallot">
                                    <label class="custom-control-label" for="viewIsBallot">Comelec Ballot Tracking</label>
                                </div>
                            </fieldset>
                            @endif
                            
                            @if( $viewIsDr == true)
                            <fieldset>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="viewIsDr" name="viewIsDr" value="1" wire:model="viewIsDr">
                                    <label class="custom-control-label" for="viewIsDr">SMD Delivery Receipt</label>
                                </div>
                            </fieldset>
                            @endif
                            
                            @if( $viewIsSmdSystem == true)
                            <fieldset>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="viewIsSmdSystem" name="viewIsSmdSystem" value="1" wire:model="viewIsSmdSystem">
                                    <label class="custom-control-label" for="viewIsSmdSystem">SMD Internal System</label>
                                </div>
                            </fieldset>
                            @endif
                            
                            @if( $viewIsGazette == true)
                            <fieldset>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="viewIsGazette" name="viewIsGazette" value="1" wire:model="viewIsGazette">
                                    <label class="custom-control-label" for="viewIsGazette">Gazette Storage (Composing)</label>
                                </div>
                            </fieldset>
                            @endif
                            
                            @if( $viewIsMotorpool == true)
                            <fieldset>
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="viewIsMotorpool" name="viewIsMotorpool" value="1" wire:model="viewIsMotorpool">
                                    <label class="custom-control-label" for="viewIsMotorpool">Motorpool Request System</label>
                                </div>
                            </fieldset>
                            @endif
                            
                        </div>
                    </div>
                    
                    @if( $viewIsBallot == true)
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mb-3">
                            <strong class="text-muted d-block mb-2">For Comelec Users <small> | Just leave it Untouched for NPO Users</small></strong>
                            <strong class="text-muted d-block mb-2"><small>Comelec Role</small></strong>
                            <input type="text" class="form-control" id="viewComelecRole" name="viewComelecRole" autocomplete="off" required wire:model="viewComelecRole"> 
                            
                            <strong class="text-muted d-block mb-2"><small>Barcoded Items Receiver</small></strong>
                            <input type="text" class="form-control" id="viewBarcodedReceiver" name="viewBarcodedReceiver" autocomplete="off" required wire:model="viewBarcodedReceiver"> 
                        </div>
                    </div>
                    @endif
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    
    
</div>