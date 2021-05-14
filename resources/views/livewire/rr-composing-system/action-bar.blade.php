<div>
    <style>
        input { 
            text-transform: uppercase;
        }
        ::-webkit-input-placeholder { /* WebKit browsers */
            text-transform: none;
        }
    </style>
    
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card card-small mb-3">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Actions</h6>
                </div>
                
                @if(session('messageUpdateSearchEngine'))
                <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-info mx-2"></i>
                    <strong style="font-size: 150%">  {!! Str::upper(session('messageUpdateSearchEngine')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                </div>
                @endif
                
                <div class="card-body p-0" style="overflow-x:auto;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3">
                            <span class="d-flex mb-2">
                                <strong class="mr-1"><i class="material-icons mr-1">search</i> Search Engine Status:</strong> 
                                @if ($isOn == true)
                                <strong class="text-success">Online</strong>
                                @else
                                <strong class="text-danger">Offline</strong>
                                @endif
                                <a class="ml-auto" href="{{ asset('/search_engine_composing') }}" target="_blank">View</a>
                            </span>
                            <span class="d-flex mb-2">
                                <strong class="mr-1"><i class="material-icons mr-1">visibility</i> Visible Publications:</strong>
                                <strong class="text-success">{{ $visiblePublications }}</strong>
                            </span>
                            <span class="d-flex mb-2">
                                <strong class="mr-1"> <i class="material-icons mr-1">download</i> Downloadable Publications:</strong>
                                <strong class="text-success">{{ $visiblePublications }}</strong>
                            </span>
                            <span class="d-flex mb-2">
                                <strong class="mr-1"><i class="material-icons mr-1">list</i> Total Publications:</strong>
                                <strong class="text-success">{{ $allPublications }}</strong>
                            </span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalAddOg">
                                <i class="material-icons">add</i> Add New Softcopy
                            </button>
                            <div style="margin-left: 10px;"></div>
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalPublication">
                                <i class="material-icons">add</i> Manage Publication Type
                            </button>
                            <div style="margin-left: 10px;"></div>
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalReports">
                                <i class="material-icons">text_snippet</i> Generate Reports
                            </button>
                            <div style="margin-left: 10px;"></div>
                            @if ($isOn == true)
                            <button class="btn btn-sm btn-danger ml-auto" wire:click="updateSearchEngine(false)">
                                <i class="material-icons">power</i> Turn Off Search Engine
                            </button>
                            @else
                            <button class="btn btn-sm btn-success ml-auto" wire:click="updateSearchEngine(true)">
                                <i class="material-icons">power</i> Turn On Search Engine
                            </button>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    {{-- ADD OG SOFTCOPY --}}
    @livewire('rr-composing-system.add-item')

    {{-- PUBLICATION TYPE --}}
    @livewire('rr-composing-system.publication-module')

      {{-- REPORT MODULE --}}
      @livewire('rr-composing-system.report-module')
    
</div>