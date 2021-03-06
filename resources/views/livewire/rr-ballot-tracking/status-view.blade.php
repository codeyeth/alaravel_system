<div>
    <h3 style="text-align: center" class="mb-1"><strong> BALLOT POLL TRACKING STATUS MONITORING </strong></h3>
    <h5 style="text-align: center" class="mb-4"><i> REALTIME DATA </i></h5>
    
    <div class="d-flex justify-content-sm-center">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                <label class="btn btn-white {{ $chartMode == true ? '' : 'active'}}" wire:click="$set('chartMode', false)"><input type="radio" name="options" id="option1" {{ $chartMode == true ? '' : 'checked'}}> Counter </label>
                <label class="btn btn-white {{ $chartMode == true ? 'active' : ''}}" wire:click="$set('chartMode', true)"><input type="radio" name="options" id="option2" {{ $chartMode == true ? 'checked' : ''}} > Charts </label>
            </div>
        </div>
    </div>
    
    {{-- COUNTS VIEW --}}
    @if( $chartMode == false)
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            
            <style>
                .div_1 {
                    background-image: url('imgg/download1.png');
                    background-size: 100% 100%;
                    background-repeat: no-repeat;
                }
                .div_2 {
                    background-image: url('imgg/download2.png');
                    background-size: 100% 100%;
                    background-repeat: no-repeat;
                }
                .div_3 {
                    background-image: url('imgg/download3.png');
                    background-size: 100% 100%;
                    background-repeat: no-repeat;
                }
                .div_4 {
                    background-image: url('imgg/download4.png');
                    background-size: 100% 100%;
                    background-repeat: no-repeat;
                }
                .div_5 {
                    background-image: url('imgg/download5.png');
                    background-size: 100% 100%;
                    background-repeat: no-repeat;
                }
            </style>
            
            {{-- ALL BALLOTS --}}
            <div class=" col-sm-12 mb-4" >
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex div_1">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Total Ballots to be Printed</span>
                                <h6 class="stats-small__value count my-3">{{ $totalBallots }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- REMAINING BALLOTS --}}
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex div_3">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Remaining Ballots</span>
                                <h6 class="stats-small__value count my-3">{{$remainingBallots }} </h6>
                            </div>
                            <div class="stats-small__data">
                                <span class="stats-small__percentage text-warning">{{ $remainingBallots / $totalBallots * 100 }} % Remaining</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- PRINTED BALLOTS --}}
            <div class=" col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex div_2">
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
            <div class=" col-sm-12 mb-4" >
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex pt-4" style="overflow-x:auto;">
                        <table class="table table-hover table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th style="text-align: center">RE-PRINTS</th>
                                    <th style="text-align: center" class="text-success">GOOD</th>
                                    <th style="text-align: center" class="text-danger">BAD</th>
                                    <th style="text-align: center">PRINTING</th>
                                    <th style="text-align: center" class="text-warning">PENDING</th>
                                    <th style="text-align: center">TO VERIFY</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: center"> {{ $rePrints }} </td>
                                    <td style="text-align: center" class="text-success"><b> {{ $printedRePrintsSuccessful }} </b></td>
                                    <td style="text-align: center" class="text-danger"> {{ $printedRePrintsFailed }} </td>
                                    <td style="text-align: center"> {{ $printedRePrintsPrinting }} </td>
                                    <td style="text-align: center" class="text-warning"> {{ $printedRePrintsPending }} </td>
                                    <td style="text-align: center"> {{ $printedRePrintsToVerify }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            {{-- OUT FOR DELIVERY BALLOTS --}}
            <div class="col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex div_5">
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
            <div class="col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex div_2">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Delivered Ballots</span>
                                <h6 class="stats-small__value count my-3">{{ $deliveredBallots }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- HANDLERS LIST --}}
            <div class=" col-sm-12 mb-4" >
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex pt-4" style="overflow-x:auto;">
                        <table class="table table-hover table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    {{-- <th style="text-align: center">SHEETER</th>
                                    <th style="text-align: center">TEMPORARY STORAGE</th>
                                    <th style="text-align: center">VERIFICATION</th>
                                    <th style="text-align: center" class="text-danger">QUARANTINE</th>
                                    <th style="text-align: center">COMELEC DELIVERY</th>
                                    <th style="text-align: center">NPO SMD</th>
                                    <th style="text-align: center" class="text-warning">RELEASED BALLOTS PENDING TO RECEIVE</th> --}}

                                    <th style="text-align: center">PAPER CUTTER SECTION</th>
                                    <th style="text-align: center">STORAGE SECTION</th>
                                    <th style="text-align: center">VALIDITY VERIFICATION SECTION</th>
                                    <th style="text-align: center" class="text-danger">REJECTED SECTION</th>
                                    <th style="text-align: center">DELIVERY SECTION</th>
                                    <th style="text-align: center">BILLING SECTION</th>
                                    <th style="text-align: center" class="text-warning">RELEASED BALLOTS PENDING TO RECEIVE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: center"> {{ $sheeter }} </td>
                                    <td style="text-align: center"> {{ $temporaryStorage }} </td>
                                    <td style="text-align: center"> {{ $verification }} </td>
                                    <td style="text-align: center" class="text-danger"> {{ $quarantine }} </td>
                                    <td style="text-align: center"> {{ $comelecDelivery }} </td>
                                    <td style="text-align: center"> {{ $npoSmd }} </td>
                                    <td style="text-align: center" class="text-warning"> {{ $releasedNoOwner }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            {{-- REALTIME LOGS --}}
            <div class="col-sm-12 mb-4" id="logsList">
                <div class="card card-small">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Ballot Realtime Receiving and Releasing Logs</h6>
                    </div>
                    <div class="card-body p-0 overflow-auto" style="min-height: 530px; max-height: 530px;">
                        <ul class="list-group list-group-small list-group-flush">
                            @if(count($logList) > 0)
                            @foreach ($logList as $item)
                            <li class="list-group-item d-flex px-3" id="li_{{ $loop->index }}">
                                <span class="text-semibold text-fiord-blue">{{ $item['logMessage'] }}</span>
                                <span class="ml-auto text-right text-semibold text-reagent-gray"><b class="text-accent"> {{ Str::upper($item['userName']) }} </b> at {{ \Carbon\Carbon::parse($item['now'])->toDayDateTimeString() }}</span>
                            </li>
                            @endforeach
                            @else
                            <div class="mb-5"></div>
                            <li style="text-align: center">
                                <h5><i> No logs <br> being broadcasted ... </i></h5>
                            </li>
                            <hr>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @endif
    
    {{-- CHARTS VIEW --}}
    @if( $chartMode == true)
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            
            {{-- <div class="col-sm-12 mb-4">
                <div class="card card-small">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Ballots Re-Prints</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4" style="height: 32rem;">
                            <livewire:livewire-column-chart :column-chart-model="$columnChartModel" />
                        </div>
                    </div>
                </div>
            </div> --}}
            
            <div class="col-sm-12 mb-4">
                <div class="card card-small">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Ballots Possession</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4" style="height: 32rem;">
                            <livewire:livewire-pie-chart :pie-chart-model="$pieChartModel" />
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @endif
    
</div>