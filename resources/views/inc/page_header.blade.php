<div class="page-header row no-gutters py-4 ">
    {{-- mb-3 border-bottom --}}
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">
            @if($sidebar == 'Ballot Tracking')
            Ballot Tracking
            @else
            {{$sidebar}}
            @endif
        </span>
        <h3 class="page-title">
            @if($breadcrumb == 'Ballot Tracking')
            Ballot Tracking
            @else
            {{$breadcrumb}}
            @endif
            @if ($breadcrumb == 'Ballot Tracking' && Auth::user()->comelec_role != '')
            <span style="font-size: 20px;" class="text-success"> 
                {{-- {{ Auth::user()->comelec_role }} --}}
                
                @if( Auth::user()->comelec_role == 'SHEETER')    
                PAPER CUTTER SECTION
                @endif
                
                @if( Auth::user()->comelec_role == 'TEMPORARY STORAGE')    
                STORAGE SECTION
                @endif
                
                @if( Auth::user()->comelec_role == 'VERIFICATION')    
                VALIDITY VERIFICATION SECTION
                @endif
                
                @if( Auth::user()->comelec_role == 'QUARANTINE')    
                REJECTED SECTION
                @endif
                
                @if( Auth::user()->comelec_role == 'COMELEC DELIVERY')    
                {{-- DELIVERY SECTION --}}
                OUTGOING DELIVERY SECTION
                @endif
                
                @if( Auth::user()->comelec_role == 'NPO SMD')    
                {{-- BILLING SECTION --}}
                DELIVERY MANAGEMNET SECTION
                @endif
                
            </span>
            @endif
        </h3>
    </div>
</div>