<div class="page-header row no-gutters py-4 ">
    {{-- mb-3 border-bottom --}}
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">{{$sidebar}}</span>
        <h3 class="page-title">{{$breadcrumb}}
            @if ($breadcrumb == 'Ballot Tracking' && Auth::user()->comelec_role != '')
            <span style="font-size: 20px;" class="text-success"> {{ Auth::user()->comelec_role }} </span>
            @endif
        </h3>
    </div>
</div>