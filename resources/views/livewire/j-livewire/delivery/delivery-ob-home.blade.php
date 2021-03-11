<div class="stats-small stats-small--1 card card-small">
    <div class="card-body p-0 d-flex">
      <div class="d-flex flex-column m-auto">
        <div class="stats-small__data text-center">
      <span class="stats-small__label text-uppercase">{{$ballotListCountTitle}}</span>
          <h6 class="stats-small__value count my-3">{{$ballotListCount}}</h6>
        </div>
        <div class="stats-small__data">
         <!--if you want to add percentage od increase
              <span class="stats-small__percentage stats-small__percentage--increase">4.7%</span>
          -->
        </div>
      </div>
      <canvas height="120" class="blog-overview-stats-small-1"></canvas>
    </div>
  </div>
 
                    <div class="row border-bottom py-2 mb-0 bg-light">
                        <div class="col-12 col-sm-12">
                            <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by Ballot ID or DR No." wire:model="search">
                        </div>
                    </div>
                   <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pb-3 text-center">
                    @if (count($ballotList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">Ballot ID</th>
                                    <th scope="col" class="border-0">DR NO.</th>
                                    <th scope="col" class="border-0">City / Municipality / Province</th>
                                    <th scope="col" class="border-0">Clustered Precint</th>
                                    <th scope="col" class="border-0">Quantity</th>
                                    <th scope="col" class="border-0">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($ballotList as $item)
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
                        <p style="text-align: center">Not found.</p>    
                        @endif
                    </li>
                    <li class="list-group-item px-3">
                      
                    </li>
                </ul>
                <div class="text-center"> 
        {{ $ballotList->links() }}
    </div>