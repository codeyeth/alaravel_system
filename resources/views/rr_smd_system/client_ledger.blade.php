@extends('layouts.blank_app')

@section('content')

@livewire('rr-smd-system.client-ledger-view', ['client_id' => $client_id])

@endsection