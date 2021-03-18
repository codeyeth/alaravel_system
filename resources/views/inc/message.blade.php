@if(session('success'))
<div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <i class="fa fa-info mx-2"></i>
    {{-- <strong>STATIC NOTIFICATION!</strong> --}}
    <strong style="font-size: 150%">  {!! Str::upper(session('success')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
</div>
@endif


@if(count($errors) > 0)
@foreach($errors->all() as $error)
<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <i class="fa fa-info mx-2"></i>
    <strong>STATIC NOTIFICATION!</strong>
    {{ $error }}
</div>
@endforeach
@endif


{{-- @if(session('success'))
<div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <i class="fa fa-info mx-2"></i>
    <strong>STATIC NOTIFICATION!</strong>
    {!!session('success')!!}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <i class="fa fa-info mx-2"></i>
    <strong>STATIC NOTIFICATION!</strong>
    {{session('error')}}
</div>
@endif --}}