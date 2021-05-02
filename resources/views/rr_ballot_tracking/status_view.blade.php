@extends('layouts.blank_app')

@section('content')

{{-- FOR WEBSOCKETS --}}
<script src="{{ asset ('js/app.js') }}" defer></script>

{{-- <div class="container"> --}}
@livewire('rr-ballot-tracking.status-view')
{{-- </div> --}}
@endsection