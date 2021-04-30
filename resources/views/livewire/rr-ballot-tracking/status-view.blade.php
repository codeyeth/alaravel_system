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
        <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
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
        <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
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
        
        {{-- RE-PRINTS --}}
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase text-danger">Actual Ballots Re-Prints</span>
                            <h6 class="stats-small__value count my-3 text-danger">{{ $rePrints }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- OUT FOR DELIVERY BALLOTS --}}
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase">Out for Delivery</span>
                            <h6 class="stats-small__value count my-3">{{ $outForDeliveryBallots }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- TO BE DELIVERED BALLOTS --}}
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
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
        
        <div class="col-lg-5 col-md-12 col-sm-12 mb-4">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Ballot Count in Every Handler Possession</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>LOCATION</th>
                                <th>BALLOT COUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><h5>SHEETER</h5></td>
                                <td><h5>{{ $sheeter }}</h5></td>
                            </tr>
                            <tr>
                                <td><h5>TEMPORARY STORAGE</h5></td>
                                <td><h5>{{ $temporaryStorage }}</h5></td>
                            </tr>
                            <tr>
                                <td><h5>VERIFICATION</h5></td>
                                <td><h5>{{ $verification }}</h5></td>
                            </tr>
                            <tr>
                                <td><h5 class="text-danger">QUARANTINE</h5></td>
                                <td><h5 class="text-danger">{{ $quarantine }}</h5></td>
                            </tr>
                            <tr>
                                <td><h5>COMELEC DELIVERY</h5></td>
                                <td><h5>{{ $comelecDelivery }}</h5></td>
                            </tr>
                            <tr>
                                <td><h5>NPO SMD</h5></td>
                                <td><h5>{{ $npoSmd }}</h5></td>
                            </tr>
                            <tr>
                                <td><h5 class="text-warning">RELEASED BALLOTS <br> PENDING TO RECEIVE</b></h5></td>
                                <td><h5 class="text-warning">{{ $releasedNoOwner }}</h5></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-lg-7 col-md-12 col-sm-12 mb-4" id="logsList">
            <div class="card card-small">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Ballot Realtime Receiving and Releasing Logs</h6>
                </div>
                <div class="card-body p-0 overflow-auto" style="min-height: inherit; max-height: 499px;">
                    <ul class="list-group list-group-small list-group-flush">
                        @if(count($logList) > 0)
                        @foreach ($logList as $item)
                        <li class="list-group-item d-flex px-3" id="li_{{ $loop->index }}">
                            <span class="text-semibold text-fiord-blue">{{ $item['logDetails'] }}</span>
                            <span class="ml-auto text-right text-semibold text-reagent-gray"><b class="text-accent"> {{ Str::upper($item['userName']) }} </b> at {{ \Carbon\Carbon::parse($item['now'])->toDayDateTimeString() }}</span>
                        </li>
                        @endforeach
                        @else
                        <br>
                        <li style="text-align: center">
                            <h5><i> No Logs being Broadcasted ... </i></h5>
                        </li>
                        <hr>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</div>