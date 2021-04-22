@extends('layouts.shards_app')

@section('content')

@livewire('rr-home-dashboard.home-dashboard')

<a href="{{ asset('#')}}" class="btn btn-accent">Must Echo ROYETH</a>

@endsection