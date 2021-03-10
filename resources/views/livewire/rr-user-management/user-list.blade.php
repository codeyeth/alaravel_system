<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">User Lists</h6>
                </div>
                <div class="card-body pt-0 pb-3 text-center">
                    <div class="row border-bottom py-2 mb-0 bg-light">
                        <div class="col-12 col-sm-12">
                            <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by ID, Name, User Role, Position, Division, Section" wire:model="search">
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
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userList as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><small> {{ Str::upper($item->division) }} - {{ Str::upper($item->section) }}</small> </td>
                                    <td>{{ Str::upper($item->position) }}</td>
                                    <td><button type="button" class="btn btn-accent" data-toggle="modal" data-target="#modalUserDetail" wire:click.preventDefault="modalUserDetail({{ $item->id }})"> <i class="material-icons">search</i> View</button></td>
                                    <td>
                                        <a href="{{ asset ('/add_user')}}/{{$item->id}}/edit" class="btn btn-accent btn-flat"> <i class="material-icons">mode_edit</i> Edit </a>
                                    </td>
                                    
                                    <td>
                                        {!!Form::open(['action' => ['RrUserManagementController@destroy', $item->id],'method' => 'POST', 'class' => ''])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        <button type="submit" class="btn btn-danger"> <i class="material-icons">delete</i> Delete</button>
                                        {!!Form::close()!!}
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
    
    <div class="modal fade" id="modalUserDetail" tabindex="-1" role="dialog" aria-labelledby="modalUserDetail" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="blog-comments__item d-flex p-1">
                        <div class="blog-comments__avatar mr-3">
                            <img src="{{ asset('shards_template/images/avatars/locked-user.png') }}" alt="User avatar"> 
                        </div>
                        <div class="blog-comments__content">
                            <div class="blog-comments__meta text-muted">
                                <a class="text-secondary" href="#">{{ $name }}</a>
                                an <br>
                                <a class="text-secondary" href="#">{{ $position }}</a><br> at
                                <span class="text-muted">{{ $division }} – {{ $section }}</span>
                            </div>
                            <p class="m-0 my-1 mb-2 text-muted"></p>
                            <div class="blog-comments__actions">
                                <small><b>Accessible Modules</b></small>
                                <div class="mb-1">
                                    <span class="{{ $is_user_mgt == true ? 'text-success' : 'text-danger'}}">
                                        <i class="material-icons">{{ $is_user_mgt == true ? 'check' : 'clear'}}</i>
                                    </span> <small>User Management</small>
                                </div>
                                
                                <div class="mb-1">
                                    <span class="{{ $is_ballot_tracking == true ? 'text-success' : 'text-danger'}}">
                                        <i class="material-icons">{{ $is_ballot_tracking == true ? 'check' : 'clear'}}</i>
                                    </span> <small>Comelec Ballot Tracking</small>
                                </div>
                                
                                <div class="mb-1">
                                    <span class="{{ $is_dr == true ? 'text-success' : 'text-danger'}}">
                                        <i class="material-icons">{{ $is_dr == true ? 'check' : 'clear'}}</i>
                                    </span> <small>SMD Deliver Receipt</small>
                                </div>
                                
                                <div class="mb-1">
                                    <span class="{{ $is_gazette == true ? 'text-success' : 'text-danger'}}">
                                        <i class="material-icons">{{ $is_gazette == true ? 'check' : 'clear'}}</i>
                                    </span> <small>Gazette Storage (Composing)</small>
                                </div>
                                
                                <div class="mb-1">
                                    <span class="{{ $is_motorpool == true ? 'text-success' : 'text-danger'}}">
                                        <i class="material-icons">{{ $is_motorpool == true ? 'check' : 'clear'}}</i>
                                    </span> <small>Motorpool Request System</small>
                                </div>                                
                            </div>

                            <hr>

                            <div class="blog-comments__meta text-muted">
                                <small><b>Comelec Role </b></small>
                                <a class="text-secondary" href="#">{{ $comelec_role }}</a>
                                ->
                                <small><b>Barcoded Receiver </b></small>
                                <a class="text-secondary" href="#">{{ $barcoded_receiver }}</a>
                            </div>

                        </div>

                        
                    </div>

                 
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    
</div>