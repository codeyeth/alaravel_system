@extends('layouts.blank_app')

@section('content')

@livewire('rr-smd-system.courier-view', ['courierId' => $courierId])

@endsection