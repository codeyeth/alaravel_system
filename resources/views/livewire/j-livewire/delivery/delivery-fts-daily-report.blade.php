<div class="card-header border-bottom">
    <h6 class="m-0">Generate Daily Report for FTS <label style="float:right;"> {{$dailyftslistresult}} </label></h6>
  </div>
  <div class="row border-bottom py-2 bg-light">

  <div class="col-12 col-sm-3">
  <input type="datetime-local" name="datefromdaily" id="dfrom" wire:model="datefrom" class="input-sm form-control" placeholder="Date From" value="<?php echo date('Y-m-d\TH:i'); ?>">
    </div>
    <div class="col-12 col-sm-3">
    <input type="datetime-local" name="datetodaily" id="dto" wire:model="dateto" class="input-sm form-control" placeholder="Date To" value="<?php echo date('Y-m-d\TH:i'); ?>">
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

<!--modal for generate reports-->
  <div class="modal fade" id="modalreports" tabindex="-1" role="dialog" aria-labelledby="modalreports" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Generate and Download Reports</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   {{Form::open(['route' => 'look', 'method' => 'GET', 'autocomplete'=>'off'])}} 
                        <div class="modal-body">
                        <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Reports datetime from:</strong>
                                            <input type="datetime-local" name="datefromdaily" id="dfrom" wire:model="datefrom" class="input-sm form-control" placeholder="Date From" >
                                            </div>
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Reports datetime to:</strong>
                                            <input type="datetime-local" name="datetodaily" id="dto" wire:model="dateto"  class="input-sm form-control" placeholder="Date To" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Delivered To:</strong>
                                            <select id="delivered" name="delivered" class="form-control" required>
                                @if(count((clone $config_query->where('delivered_to','<>',''))) > 0)
                                <option selected disabled value="">Choose . .</option>
                                @foreach((clone $config_query->where('delivered_to','<>','')) as $post)
                              <option value="{{$post->delivered_to}}">{{$post->delivered_to}}</option>
                                @endforeach
                              @else
                                <option selected disabled value="">No Data Available for Delivered to:</option>
                              @endif
                              </select>
                                            </div>
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Copies for (select multiple):</strong>
                                            
                                            <div class="dropdown">
                                         
                                              <button type="button" class="col-md-12 mb-2 btn btn-white mr-2 " id="sampleDropdownMenu" data-toggle="dropdown">Select Copies For:&nbsp;<i class="fas fa-arrow-down"></i></button>
                                                <div class="dropdown-menu col-md-12">
                                                @foreach((clone $config_query->where('copies','<>','')) as $copy)
                                                <a class="dropdown-item " >
                                                    <input type="checkbox" name="copies[]" value="{{$copy->id}}"> {{$copy->copies}}
                                                  </a>
                                                @endforeach
                                                </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <strong class="text-muted d-block mb-2">Description:</strong>
                                            <select id="description" name="description" class="form-control" required>
                                @if(count((clone $config_query->where('description','<>',''))) > 0)
                                <option selected disabled value="">Choose Description</option>
                                @foreach((clone $config_query->where('description','<>','')) as $post)
                              <option value="{{$post->description}}">{{$post->description}}</option>
                                @endforeach
                              @else
                                <option selected disabled value="">No Description Available:</option>
                              @endif
                              </select>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Issued By:</strong>
                                            <select id="issued" name="issued" class="form-control" required>
                                @if(count((clone $config_query->where('personnel','<>','')->where('authorization','Issued by'))) > 0)
                                <option selected disabled value="">Choose Personnel</option>
                                @foreach((clone $config_query->where('personnel','<>','')->where('authorization','Issued by')) as $post)
                              <option value="{{$post->id}}">{{$post->personnel}}</option>
                                @endforeach
                              @else
                                <option selected disabled value="">No Person Authorized for Inspected by:</option>
                              @endif
                              </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Approved by:</strong>
                                            <select id="approved" name="approved" class="form-control" required>
                                @if(count((clone $config_query->where('personnel','<>','')->where('authorization','Approved by'))) > 0)
                                <option selected disabled value="">Choose Personnel</option>
                                @foreach((clone $config_query->where('personnel','<>','')->where('authorization','Approved by')) as $post)
                              <option value="{{$post->id}}">{{$post->personnel}}</option>
                                @endforeach
                              @else
                                <option selected disabled value="">No Person Authorized for Inspected by:</option>
                              @endif
                              </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Received by:</strong>
                                            <select id="received" name="received" class="form-control" required>
                                @if(count((clone $config_query->where('personnel','<>','')->where('authorization','Received by'))) > 0)
                                <option selected disabled value="">Choose Personnel</option>
                                @foreach((clone $config_query->where('personnel','<>','')->where('authorization','Received by')) as $post)
                              <option value="{{$post->id}}">{{$post->personnel}}</option>
                                @endforeach
                              @else
                                <option selected disabled value="">No Person Authorized for Inspected by:</option>
                              @endif
                              </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Inspected by:</strong>
                                              <select id="inspected" name="inspected" class="form-control" required>
                                @if(count((clone $config_query->where('personnel','<>','')->where('authorization','Inspected by'))) > 0)
                                <option selected disabled value="">Choose Personnel</option>
                                @foreach((clone $config_query->where('personnel','<>','')->where('authorization','Inspected by')) as $post)
                              <option value="{{$post->id}}">{{$post->personnel}}</option>
                                @endforeach
                              @else
                                <option selected disabled value="">No Person Authorized for Inspected by:</option>
                              @endif
                              </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                           {{ Form::button('<i class="material-icons">download</i> Download',['type' => 'submit','class'=>'btn btn-success']) }}
                           {{ Form::close() }}
                        </div>
                </div>
            </div>
        </div>
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