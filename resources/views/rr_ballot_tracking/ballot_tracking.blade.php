@extends('layouts.shards_app')

@section('content')

{{-- FOR WEBSOCKETS --}}
<script src="{{ asset ('js/app.js') }}" defer></script>

@livewire('rr-ballot-tracking.barcode-function')

@endsection