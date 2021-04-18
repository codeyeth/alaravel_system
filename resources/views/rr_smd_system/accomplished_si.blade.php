@extends('layouts.blank_app')

@section('content')

@livewire('rr-smd-system.sales-invoice-accomplished-view', ['monthSelected' => $monthSelected, 'preparedBy' => $preparedBy, 'prepPosition' => $prepPosition, 'submittedBy' => $submittedBy, 'subPosition' => $subPosition])

@endsection