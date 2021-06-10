
            <ul class="nav nav-pills nav-tabs justify-content-end " role="tablist">
                    <span class="form-label">{{$ballotListCountTitle}} {{$ballotListCount}}  &nbsp;</span>
                    </ul>
                          
                            <div class="card-body pt-0 pb-3 text-center">
                                <div class="row border-bottom py-2 mb-0 bg-light">
                                    <div class="col-12 col-sm-12">
                                        <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by Ballot Control No. or Receipt No." wire:model="wire_search_dr_home" >
                                    </div>
                                </div>
                            </div>
                            <ul class="l    ist-group list-group-flush">
                                <li class="list-group-item p-0 pb-3 text-center">
                                @if (count($ballotList) > 0)
                                    <table class="table table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                            <th scope="col" class="border-0">Ballot Control No.</th>
                                            <th scope="col" class="border-0">Receipt No.</th>
                                            <th scope="col" class="border-0">Poll Location Serial Number</th>
                                            <th scope="col" class="border-0">Ballot Delivery Location</th>
                                            <th scope="col" class="border-0">Quantity</th>
                                            <th scope="col" class="border-0">Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($ballotList as $item)
                                        <tr>
                                    <td>{{ $item->BALLOT_ID }}</td>
                                    <td>{{ $item->DR_NO }}</td>
                                    <td>{{ $item->CLUSTERED_PREC }}</td>
                                    <td>{{ $item->CITY_MUN_PROV }}</td>
                                    <td>{{ $item->CLUSTER_TOTAL }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <br>
                                    <p style="text-align: center">Not found.</p>
                                    @endif
                                </li>
                                <li class="list-group-item px-3">
                                {{ $ballotList->links() }}
                                </li>
                            </ul>
                    