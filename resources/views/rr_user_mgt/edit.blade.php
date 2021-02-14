@extends('layouts.shards_app')

@section('content')

@livewire('rr-user-management.edit-user', ['post' => $post])

@endsection