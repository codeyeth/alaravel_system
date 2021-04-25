<div>
    <h3 style="text-align: center" class="mb-1"><strong> BALLOT TRACKING STATUS MONITORING </strong></h3>
    <h5 style="text-align: center"><i> REALTIME DATA </i></h5>
    <br>
    
    <div class="row">
        
        {{-- TO BE PRINTED BALLOTS --}}
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Total Ballots to be Printed</span>
                            <h6 class="stats-small__value count my-3">{{ $totalBallots }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- PRINTED BALLOTS --}}
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Remaining Ballots</span>
                            <h6 class="stats-small__value count my-3">{{$remainingBallots }}</h6>
                        </div>
                        <div class="stats-small__data">
                            <span class="stats-small__percentage text-warning">{{ $remainingBallots / $totalBallots * 100 }} % Remaining</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- PRINTED BALLOTS --}}
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Printed Ballots</span>
                            <h6 class="stats-small__value count my-3">{{$printedBallots }}</h6>
                        </div>
                        <div class="stats-small__data">
                            <span class="stats-small__percentage text-success">{{ $printedBallots / $totalBallots * 100 }} % Done</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- OUT FOR DELIVERY BALLOTS --}}
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Ballots Out for Delivery</span>
                            <h6 class="stats-small__value count my-3">{{ $outForDeliveryBallots }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- TO BE DELIVERED BALLOTS --}}
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Delivered Ballots</span>
                            <h6 class="stats-small__value count my-3">{{ $deliveredBallots }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Ballot Count in Every Handler Possession</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">SHEETER</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray"><b class="text-success" style="font-size: 150%">{{ $sheeter }}</b></span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">TEMPORARY STORAGE</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray"><b class="text-success" style="font-size: 150%">{{ $temporaryStorage }}</b></span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">VERIFICATION</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray"><b class="text-success" style="font-size: 150%">{{ $verification }}</b></span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">QUARANTINE</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray"><b class="text-success" style="font-size: 150%">{{ $quarantine }}</b></span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">COMELEC DELIVERY</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray"><b class="text-success" style="font-size: 150%">{{ $comelecDelivery }}</b></span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue">NPO SMD</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray"><b class="text-success" style="font-size: 150%">{{ $npoSmd }}</b></span>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <span class="text-semibold text-fiord-blue"><b class="text-warning">RELEASED BALLOTS PENDING TO RECEIVE</b></span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray"><b class="text-warning" style="font-size: 150%">{{ $releasedNoOwner }}</b></span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer border-top">
                    
                </div>
            </div>
        </div>
        
        {{-- <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
            <div class="card card-small h-100">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Users by device</h6>
                </div>
                <div class="card-body d-flex py-0">
                    <canvas height="220" class="blog-users-by-device m-auto"></canvas>
                </div>
                <div class="card-footer border-top">
                    <div class="row">
                        <div class="col">
                            <select class="custom-select custom-select-sm" style="max-width: 130px;">
                                <option selected>Last Week</option>
                                <option value="1">Today</option>
                                <option value="2">Last Month</option>
                                <option value="3">Last Year</option>
                            </select>
                        </div>
                        <div class="col text-right view-report">
                            <a href="#">Full report &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4" id="logsList">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Ballot Realtime Receiving and Releasing Logs</h6>
                </div>
                <div class="card-body p-0 overflow-auto" style="max-height: 200px;">
                    <ul class="list-group list-group-small list-group-flush">
                        @foreach ($logList as $item)
                        <li class="list-group-item d-flex px-3" id="li_{{ $loop->index }}">
                            <span class="text-semibold text-fiord-blue">{{ $item['logDetails'] }}</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray"><b class="text-accent"> {{ Str::upper($item['userName']) }} </b> at {{ \Carbon\Carbon::parse($item['now'])->toDayDateTimeString() }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</div>