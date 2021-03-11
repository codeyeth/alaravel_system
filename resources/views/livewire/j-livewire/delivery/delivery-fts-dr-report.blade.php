


 {{ Form::open(['route' => 'view', 'method' => 'GET', 'autocomplete'=>'off'])}}
                <div class="card card-small">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Generate DR for FTS <label style="float:right;"> {{$drftslistresult}} </label></h6></h6>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row border-bottom py-2 bg-light">

                    <div class="col-12 col-sm-2">
                    <input type="text" class="input-sm form-control" name="search" id="search" placeholder="DR No." wire:model="search_dr_fts">
                      </div>

                      <div class="col-12 col-sm-3">
                      <input type="date" name="issued_date" id="issued_date"  class="input-sm form-control" autocomplete="off"> 
                      </div>

                      <div class="col-12 col-sm-3">
                      <select name="issued_to" id="issued_to" class="form-control">
                      <option selected>Copies</option>
                      <option>COMELEC_INSPECTORATE</option>
                      <option>COMELEC_BPG1</option>
                      <option>COMELEC_BPG2</option>
                      <option>COA_COMELEC</option>
                      <option>COMELEC_DELIVERY</option>
                      <option>NPO_DELIVERY1</option>
                      <option>NPO_DELIVERY2</option>
                      <option>NPO_MONITORING</option>
                                </select>
                      </div>
                      <div class="col-12 col-sm-2">
                    <input type="text" name="issued_by" id="issued_by" class="input-sm form-control" placeholder="Issued by..">
                      </div>
                      <div class="col-12 col-sm-2">
                      {{ Form::submit('Generate PDF &rarr;',['class'=>'btn btn-sm btn-white ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0']) }}
                      {{ Form::close() }}
                      </div>
                    </div>
                   


                   
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pb-3 text-center">
                    @if (count($drftslist) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">Ballot ID</th>
                                    <th scope="col" class="border-0">DR No.</th>
                                    <th scope="col" class="border-0">Clustered Precint</th>
                                    <th scope="col" class="border-0">City / Municipality / Province</th>
                                    <th scope="col" class="border-0">Quanitity</th>
                                    <th scope="col" class="border-0">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($drftslist as $item)
                                <tr>
                                <td>{{ $item->BALLOT_ID }}</td>
                                    <td>{{ $item->DR_NO }}</td>
                                    <td>{{ $item->PROV_NAME }} {{ $item->MUN_NAME}} {{ $item->BGY_NAME }}</td>
                                    <td>{{ $item->CLUSTERED_PREC }}</td>
                                    <td>{{ $item->CLUSTER_TOTAL }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <br>
                        <p style="text-align: center">No users found.</p>    
                        @endif
                    </li>
                    <div class="text-center"> 
     
     </div>
                </ul>
                </div>
              
                <div class="text-center"> 
        {{ $drftslist->links() }}
    </div>















    
