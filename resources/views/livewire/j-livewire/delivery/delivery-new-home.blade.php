
            <ul class="nav nav-pills nav-tabs justify-content-end " role="tablist">
                   <span class="form-label">{{$ready_to_dr_count}}   </span>
                    </ul>
                          
                            <div class="card-body pt-0 pb-3 text-center">
                                <div class="row border-bottom py-2 mb-0 bg-light">
                                    <div class="col-12 col-sm-12">
                                        <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by Ballot Control No. or Company Name" wire:model="new_wire_search_dr_home" >
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-0 pb-3 text-center">
                                @if (count($ready_to_dr) > 0)
                                    <table class="table table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                            <th scope="col" class="border-0">Ballot Control No.</th>
                                            <th scope="col" class="border-0">Ballot Agency/Company</th>
                                            <th scope="col" class="border-0">Ballot Delivery Location</th>
                                            <th scope="col" class="border-0">Quantity</th>
                                            <th scope="col" class="border-0">Unit of Measure</th>
                                            <th scope="col" class="border-0">Description</th>
                                            <th scope="col" class="border-0">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($ready_to_dr as $item)
                                        <tr>
                                    <td>{{ $item->ballot_id}}</td>
                                    <td>{{ $item->agency_name }}</td>
                                    <td>{{ $item->complete_address }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->unit_of_measure }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                    @if ($item->is_dr_done == 0)
                                    <span class="badge badge-secondary">NO DR</span>
                                    @else
                                    <span class="badge badge-success">DELIVERED</span> 
                                    @endif
                                   </td>
                                 
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
                                {{ $ready_to_dr->links() }}
                                </li>
                            </ul>
                    