<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">User Details</h6>
                </div>
                <div class="card-body pt-0 pb-3 text-center">
                    <div class="row border-bottom py-2 mb-0 bg-light">
                        <div class="col-12 col-sm-12">
                            <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by ID, Name, User Role, Position, Assignment" wire:model="search">
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
                                    <th scope="col" class="border-0">User Role</th>
                                    <th scope="col" class="border-0">Assignment</th>
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
                                    <td>{{ Str::upper($item->user_role) }}</td>
                                    <td><small> {{ Str::upper($item->division) }} - {{ Str::upper($item->section) }}</small> </td>
                                    <td>{{ Str::upper($item->position) }}</td>
                                    <td><button type="button" class="btn btn-accent"> <i class="material-icons">search</i> View</button></td>
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
                    <li class="list-group-item px-3">
                        {{ $userList->links() }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>