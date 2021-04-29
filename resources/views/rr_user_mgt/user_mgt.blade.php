@extends('layouts.shards_app')

@section('content')

@livewire('rr-user-management.action-bar')

<hr class="hr_dashed">

@livewire('rr-user-management.user-list')

@endsection