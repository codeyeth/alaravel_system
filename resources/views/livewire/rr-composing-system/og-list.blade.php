<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">User Lists</h6>
                </div>
                <div class="card-body pt-0 pb-3 text-center">
                    <div class="row border-bottom py-2 mb-0 bg-light">
                        {{-- <div class="col-12 col-sm-10">
                            <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by ID, Name, User Role, Position, Division, Section" wire:model="search">
                        </div>
                        <div class="col-12 col-sm-2">
                            <button type="button" class="btn btn-success btn-block">Export All Users</button>
                        </div> --}}
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-3">
                                <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by ID, Name, User Role, Position, Division, Section" wire:model="search">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" wire:click="exportAllUser">Export All Users</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pb-3 text-center">
                        @if (count($ogList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">Article Title</th>
                                    <th scope="col" class="border-0">Publication Type</th>
                                    <th scope="col" class="border-0">Date Published</th>
                                    {{-- <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ogList as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->article_title }}</td>
                                    <td>{{ $item->publication_type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date_published)->toFormattedDateString() }} </td>
                                    {{-- <td><small> {{ Str::upper($item->division) }} - {{ Str::upper($item->section) }}</small> </td>
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
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <br>
                        <p style="text-align: center">No OG Softcopy found.</p>    
                        @endif
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center"> 
        {{ $ogList->links() }}
    </div>
</div>
