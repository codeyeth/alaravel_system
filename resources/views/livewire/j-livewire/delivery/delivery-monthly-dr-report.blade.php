<div class="row border-bottom py-2 bg-light">
<div class="col-12 col-sm-3">
<input type="date" name="input_ob_monthly_datefrom" id="id_ob_monthly_datefrom" wire:model="wire_monthly_datefrom" class="input-sm form-control" value="<?php echo date('Y-m-d\TH:i'); ?>">
  </div>
  <div class="col-12 col-sm-3">
  <input type="date" name="input_ob_monthly_dateto" id="id_ob_monthly_dateto" wire:model="wire_monthly_dateto" class="input-sm form-control" value="<?php echo date('Y-m-d\TH:i'); ?>">
  </div>
  <div class="col-12 col-sm-2">
  &nbsp;
  </div>
  <div class="col-12 col-sm-4"><label style="float:right;">
  <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalreports"">
                            Generate Reports  &rarr;
                          </button>
      </label>
  </div>
  
</div>



<ul class="list-group list-group-flush">
  <li class="list-group-item p-0 pb-3 text-center">
    @if (count($monthlydrlist) > 0)
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
          @foreach ($monthlydrlist as $item)
            <tr>
              <td>{{ $item->BALLOT_ID }}</td>
              <td>{{ $item->DR_NO }}</td>
              <td>{{ $item->CITY_MUN_PROV }}</td>
              <td>{{ $item->CLUSTERED_PREC }}</td>
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
                  {{ $monthlydrlist->links() }}
                  </li>
                </ul>