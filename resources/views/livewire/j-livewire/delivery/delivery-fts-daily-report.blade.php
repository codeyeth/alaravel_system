{{ Form::open(['route' => 'look', 'method' => 'GET', 'autocomplete'=>'off'])}}
  <div class="card-header border-bottom">
    <h6 class="m-0">Generate Daily Report for FTS <label style="float:right;"> {{$dailyftslistresult}} </label></h6>
  </div>

      
  <nav class="navbar navbar-expand navbar-dark bg-primary rounded">
  <ul class="navbar-nav mr-auto">
  <div class="col-12 col-sm-4">
    <li class="nav-item active">
    <input type="datetime-local" name="datefromdaily" id="dfrom" wire:model="datefrom" class="input-sm form-control" placeholder="Date From" value="<?php echo date('Y-m-d\TH:i'); ?>">
    </li>
    </div>
    <div class="col-12 col-sm-4">
    <li class="nav-item">
    <input type="datetime-local" name="datetodaily" id="dto" wire:model="dateto" class="input-sm form-control" placeholder="Date To" value="<?php echo date('Y-m-d\TH:i'); ?>">
    </li>
    </div>
    <div class="col-12 col-sm-4">
    <li class="nav-item">
    <input type="text" name="issued_by" id="issued_by" class=" form-control" placeholder="Issued by..">   
    </li>
    </div>
    <div class="col-12 col-sm-4">
    <li class="nav-item">
    <div class="dropdown">
  
        <button type="button" class="btn btn-white mr-1 " id="sampleDropdownMenu" data-toggle="dropdown">Select Copies For:&nbsp;<i class="fas fa-arrow-down"></i></button>
          <div class="dropdown-menu">
          @foreach($copyList as $copy)
          <a class="dropdown-item" >
              <input type="checkbox" name="copies[]" value="{{$copy->id}}"> {{$copy->copies}}
            </a>
          @endforeach
          </div>
          </div>
  
    </li>
    </div>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
    {{ Form::submit('Generate PDF &rarr;',['class'=>'btn btn-sm btn-white ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0']) }}
      {{ Form::close() }}
    </li>
  </ul>
</nav>
  <ul class="list-group list-group-flush">
    <li class="list-group-item p-0 pb-3 text-center">
      @if (count($dailyftslist) > 0)
        <table class="table table-hover mb-0">
          <thead class="bg-light">
            <tr>
              <th scope="col" class="border-0">DR No.</th>
              <th scope="col" class="border-0">Ballot ID</th>
              <th scope="col" class="border-0">Clustered Precint</th>
              <th scope="col" class="border-0">City / Municipality / Province</th>
              <th scope="col" class="border-0">Quanitity</th>
              <th scope="col" class="border-0">Timestamp</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dailyftslist as $item)
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
        <p style="text-align: center">No users found.</p>    
        @endif
    </li>
    <li class="list-group-item px-3">
                    {{ $dailyftslist->links() }}
                    </li>
                  </ul>
















    
