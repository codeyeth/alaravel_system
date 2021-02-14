@extends('layouts.shards_app')

@section('content')

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
                    {!! Form::open(['action' => ['RrChangePasswordController@update', $user_edit->id], 'method' => 'POST', 'enctype' => 'multipart/form-data' , 'id' => 'change_password', 'class' => '']) !!}
                    @csrf
                    
                    <li class="list-group-item p-0 px-3 pt-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <strong class="text-muted d-block mb-2">Password <span class="requiredTag">&bullet;</span></strong>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required autofocus >
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <strong class="text-muted d-block mb-2">Confirm Password <span class="requiredTag">&bullet;</span> </strong>
                                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Confirm Password" autocomplete="off">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </li>
                    
                    {{Form::hidden('_method', 'PUT')}}
                    <li class="list-group-item px-3">
                        
                        <button type="submit" class="btn btn-accent">Update Password</button>
                    </li>
                    {!! Form::close() !!}
                    
                </ul>
            </div>
        </div>
    </div>
@endsection