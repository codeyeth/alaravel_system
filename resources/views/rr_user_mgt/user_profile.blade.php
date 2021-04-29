@extends('layouts.shards_app')

@section('content')

@livewire('rr-user-management.user-profile',  ['user_id' => $user_id])

@endsection