
   
   
   
   
    <div class="row border-bottom py-2 bg-light">
<div class="col-12 col-sm-3">
<input type="text" name="input_ob_dr_no" id="id_ob_dr_no" class="input-sm form-control" placeholder="Receipt No." wire:model="wire_search_dr_no">
  </div>
  <div class="col-12 col-sm-3">
  &nbsp;
  </div>
  <div class="col-12 col-sm-2">
  &nbsp;
  </div>
  <div class="col-12 col-sm-4"><label style="float:right;">
  <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalreports">
                            Generate Reports  &rarr;
                          </button>
      </label>
  </div>
</div>
<ul class="list-group list-group-flush">
  <li class="list-group-item p-0 pb-3 text-center">
    @if (count($drlist) > 0)
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
          @foreach ($drlist as $item)
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
      @else<br>
      <p style="text-align: center">No Data found.</p>    
      @endif
  </li>
  <li class="list-group-item px-3">
                  {{ $drlist->links() }}
                  </li>
                </ul>