<div>
<div class="card-header border-bottom">
            <h6 class="m-0">Delivery Management <label style="float:right;">  </label></h6>
        </div>
    <div>
    
        <div class="row">
            <div class="col-lg-12 mb-4">
              
                <div class="card card-small mb-1">
                
                    <ul class="nav nav-pills nav-tabs " role="tablist">
                       
                        <li class="nav-item">
                            <a class="nav-link active" id="new-home-tab" data-toggle="tab" href="#newhome" role="tab" aria-controls="newhome" aria-selected="false" wire:ignore.self>Home</a>
                        </li>
                      
                         <!-- 
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false" wire:ignore.self>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="create_dr-tab" data-toggle="tab" href="#create_dr" role="tab" aria-controls="create_dr" aria-selected="false" wire:ignore.self>Create Delivery Receipt Number</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dr_number_report-tab" data-toggle="tab" href="#dr_number_report" role="tab" aria-controls="dr_number_report" aria-selected="false" wire:ignore.self wire:click="function_dr_reports_identifier(1)">Delivery Number Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="daily_dr_report-tab" data-toggle="tab" href="#daily_dr_report" role="tab" aria-controls="daily_dr_report" aria-selected="false" wire:ignore.self wire:click="function_dr_reports_identifier(2)">Daily Report</a>
                        </li>
                     
                          -->
                    
                      
                        <li class="nav-item">
                            <a class="nav-link" id="receipt_number-tab" data-toggle="tab" href="#receipt_number" role="tab" aria-controls="receipt_number" aria-selected="false" wire:ignore.self>Create Delivery Receipt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="receipt_list-tab" data-toggle="tab" href="#receipt_list" role="tab" aria-controls="receipt_list" aria-selected="false" wire:ignore.self>List of Delivery Receipt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="delivery_report-tab" data-toggle="tab" href="#delivery_report" role="tab" aria-controls="delivery_report" aria-selected="false" wire:ignore.self>Delivery Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dr_report_settings-tab" data-toggle="tab" href="#dr_report_settings" role="tab" aria-controls="dr_report_settings" aria-selected="false" wire:ignore.self>Delivery Report Settings</a>
                        </li>
                    </ul>
                    

                   
                    <div class="tab-content" id="myTab">
                        <input type="text" wire:model="wire_dr_reports_identifier" name="input_dr_reports_identifier" hidden >
                        @include('livewire.j-livewire.delivery.delivery-dated-reports-modal') 
                       
                        <div class="tab-pane fade show" id="home" role="tabpanel" aria-labelledby="home-tab" wire:ignore.self>   
                            @include('livewire.j-livewire.delivery.delivery-home')
                        </div>

                        <div class="tab-pane fade show" id="dr_number_report" role="tabpanel" aria-labelledby="dr_number_repor-tab" wire:ignore.self>  
                            <div class="card-header border-bottom">
                                Generate one Receipt Number Report <label style="float:right;"> {{$drlistresult}} </label><br><br>
                                @include('livewire.j-livewire.delivery.delivery-one-dr-report')
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="daily_dr_report" role="tabpanel" aria-labelledby="daily_dr_report-tab" wire:ignore.self>  
                            <div class="card-header border-bottom">
                                Generate Daily Report <label style="float:right;"> {{$drlistresult}} </label><br><br>
                                @include('livewire.j-livewire.delivery.delivery-daily-dr-reports')
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="delivery_report" role="tabpanel" aria-labelledby="delivery_report" wire:ignore.self>  
                            <div class="card-header border-bottom">
                                Generate Delivery Report <label style="float:right;">{{$report_number}}</label><br><br>
                          












                                <div class="row border-bottom py-2 bg-light">
<div class="col-12 col-sm-3">
<input type="date" name="new_input_ob_monthly_datefrom" id="new_id_ob_monthly_datefrom" wire:model="new_wire_monthly_datefrom" class="input-sm form-control" value="<?php echo date('Y-m-d\TH:i'); ?>">
  </div>
  <div class="col-12 col-sm-3">
  <input type="date" name="new_input_ob_monthly_dateto" id="new_id_ob_monthly_dateto" wire:model="new_wire_monthly_dateto" class="input-sm form-control" value="<?php echo date('Y-m-d\TH:i'); ?>">
  </div>
  <div class="col-12 col-sm-2">
  &nbsp;
  </div>
  <div class="col-12 col-sm-4"><label style="float:right;">

  <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modal_delivery_report">
                            Generate Reports  &rarr;
                          </button>





















                          <div class="modal fade" id="modal_delivery_report" tabindex="-1" role="dialog" aria-labelledby="modal_delivery_report" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Generate and Download Delivery Report</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
              </div>
              {{Form::open(['route' => 'report', 'method' => 'GET', 'autocomplete'=>'off'])}} 
              <div class="modal-body">
              <div class="row">
                      <div class="col-sm-12 col-md-12">
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                  <strong class="text-muted d-block mb-2">Date From:</strong>
                                  <input type="date" name="new_input_ob_monthly_datefrom" id="new_id_ob_monthly_datefrom" wire:model="new_wire_monthly_datefrom" class="input-sm form-control" value="<?php echo date('Y-m-d\TH:i'); ?>">
                              </div>
                              <div class="form-group col-md-6">
                                  <strong class="text-muted d-block mb-2">Date To:</strong>
                                  <input type="date" name="new_input_ob_monthly_dateto" id="new_id_ob_monthly_dateto" wire:model="new_wire_monthly_dateto" class="input-sm form-control" value="<?php echo date('Y-m-d\TH:i'); ?>">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12 col-md-12">
                          <div class="form-row">
             
                        <input type="hidden" name="new_input_for_dr_no" wire:model="modalDrNo">
                              <div class="form-group col-md-12">
                                  <strong class="text-muted d-block mb-2">Copies for (can select multiple):</strong>
                                  <div class="dropdown">
                                      <button type="button" class="col-md-12 mb-2 btn btn-white mr-2 " id="sampleDropdownMenu" data-toggle="dropdown">Select Copies For:&nbsp;<i class="fas fa-arrow-down"></i></button>
                                      <div class="dropdown-menu col-md-12">
                                          @foreach((clone $config_query->where('copies','<>','')) as $copy)
                                          <a class="dropdown-item " >
                                              <input type="checkbox" id="modal_id_copies" name="modal_input_copies[]" value="{{$copy->id}}"> {{$copy->copies}}
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
                              <div class="form-group col-md-6">
                                  <strong class="text-muted d-block mb-2">Issued By:</strong>
                                  <select id="modal_id_issued" name="modal_input_issued" class="form-control" required>
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
                                  <select id="modal_id_approved" name="modal_input_approved" class="form-control" required>
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
                                  <select id="modal_id_received" name="modal_input_received" class="form-control" required>
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
                                  <select id="modal_id_inspected" name="modal_input_inspected" class="form-control" required>
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






                          











































                          

      </label>
  </div>
  
</div>


        
<ul class="list-group list-group-flush">
  <li class="list-group-item p-0 pb-3 text-center">
    @if (count($report_list) > 0)
      <table class="table table-hover mb-0">
        <thead class="bg-light">
          <tr>
          <th scope="col" class="border-0">Receipt No.</th>
          <th scope="col" class="border-0">Company Name</th>
          <th scope="col" class="border-0">Ballot Delivery Location</th>
          <th scope="col" class="border-0">Contact Details</th>
          <th scope="col" class="border-0">Date and Time Created</th>
          <th scope="col" class="border-0">View Items</th> 

          </tr>
        </thead>
        <tbody>
          @foreach ($report_list as $item)
            <tr>
              <td>{{ $item->DR_NO }}</td>
              <td>{{ $item->agency_name }}</td>
              <td>{{ $item->CITY_MUN_PROV }}</td>
              <td>{{ $item->contact_no }}</td>
              <td>{{ $item->created_at }}</td>
              <td>
              <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modal_view_receipt" wire:click="ViewDrNo({{ $item->id }})" >
              <i class="material-icons">search</i>
                          </button>
              </td>
              
         
            </tr>
          @endforeach
         </tbody>
        </table>
      @else<br>
      <p style="text-align: center">No Data found.</p>    
      @endif
  </li>
  <li class="list-group-item px-3">
                  {{ $report_list->links() }}
                  </li>
                </ul>
































                            </div>
                        </div>

                        <div class="tab-pane fade show" id="dr_report_settings" role="tabpanel" aria-labelledby="dr_report_settings-tab" wire:ignore.self>   
                            @include('livewire.j-livewire.delivery.delivery-management-config')
                        </div>

                        <div class="tab-pane fade show active" id="newhome" role="tabpanel" aria-labelledby="new-home-tab" wire:ignore.self>   
                            @include('livewire.j-livewire.delivery.delivery-new-home')
                        </div>

                        <div class="tab-pane fade show" id="receipt_number" role="tabpanel" aria-labelledby="receipt_number-tab" wire:ignore.self>   
                            <!--start content of new create dr tab-->
     
                            <div class="card-body pt-0 pb-3">
                                <div class="row border-bottom py-2 mb-0 bg-light">&nbsp;&nbsp;&nbsp;Create Delivery Receipt. Please select company you wish to deliver items to. </div>
                            </div>
                            <div class="row">
                            <div class="col-lg-6">
                            <div class="card-body pt-0 pb-3 text-center">
                                <div class="row border-bottom py-2 mb-0 bg-light">
                                    <div class="col-12 col-sm-12">
                                    <label style="float:left;"> Company to Deliver </label>
                                    <input type="text" class="form-control" id="DRagencyName" name="DRagencyName" placeholder="Company Name" autocomplete="off" required autofocus wire:model="companyName" wire:keyup="searchdrClientDatabase">
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        @if ($showdrClientDatabaseTable == true)
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    @if (count($clientdrDatabase) > 0)
                                                    <hr>
                                                    <table class="table table-hover mb-0">
                                                        <thead class="bg-light">
                                                            <tr>
                                                        
                                                                <th scope="col" class="border-0">AGENCY NAME</th>
                                                                <th scope="col" class="border-0">AGENCY ADDRESS</th>
                                                                <th scope="col" class="border-0">AGENCY CONTACT</th>
                                                                <th scope="col" class="border-0"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($clientdrDatabase as $client_database)
                                                            <tr>
                                                                <td>{{ $client_database->agency_name }}</td>
                                                                <td>{{ $client_database->complete_address }}</td>
                                                                <td>{{ $client_database->contact_no }}</td>
                                                                <td><button class="btn btn-accent btn-sm" id="getClientDatabase{{ $client_database->id }}" name="getClientDatabase{{ $client_database->id }}" wire:click="getClientDatabase({{ $client_database->id }})">Get Client Data</button></td>
                                                            </tr>
                                                            @endforeach
                                                            
                                                        </tbody>
                                                    </table>
                                                    <hr>
                                                    @else
                                                    <p style="text-align: center">No Client Details found.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                
                              
                                    <div class="col-12 col-sm-6">
                                    <label style="float:left;">Address to Deliver </label>
                                        <input class="form-control mb-0" type="text" placeholder="Company Address" wire:model="companyAddress" >
                                    </div>  
                                    <div class="col-12 col-sm-6">
                                    <label style="float:left;">Contact to Details</label>
                                        <input class="form-control mb-0" type="text" placeholder="Company Contact Details" wire:model="companyContact" >
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-6">
                         


                            <div class="card-body pt-0 pb-3">
                                <div class="row border-bottom py-2 mb-0 bg-light">&nbsp;&nbsp;&nbsp;List of Products Ready to DR </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-0 pb-3 text-center">
                                @if (count($ready_to_dr_add) > 0)
                                    <table class="table table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                            <th scope="col" class="border-0">Ballot Control No.</th>
                                            <th scope="col" class="border-0">Ballot Agency/Company</th>
                                            <th scope="col" class="border-0">Ballot Delivery Location</th>
                                            <th scope="col" class="border-0">Quantity</th>
                                            <th scope="col" class="border-0">Unit of Measure</th>
                                            <th scope="col" class="border-0">Description</th>
                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($ready_to_dr_add as $item)
                                        <tr>
                                    <td>{{ $item->ballot_id}}</td>
                                    <td>{{ $item->agency_name }}</td>
                                    <td>{{ $item->complete_address }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->unit_of_measure }}</td>
                                    <td>{{ $item->description }}</td>
                                
                                 
                                </tr>
                                @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <br>
                                    <p style="text-align: center">No Data.</p>
                                    @endif
                                </li>
                                <li class="list-group-item px-3">
                                {{ $ready_to_dr_add->links() }}
                                </li>
                            </ul>

































































                            </div>
                            </div>
                        
                          

                            @if (session()->has('message'))
    <div class="alert alert-success">
    {{ session('message') }}
    </div>
    @endif


    @if(count($errors) > 0)
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-info mx-2"></i>
        <strong style="font-size: 150%">{{  $msg_first = substr($error, 0, -72) }} {{  $line = substr($error, 17, -59) + 1 }}  {{  $msg_end = substr($error, 29) }}</strong>
    </div>
    @endforeach
@endif



@if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
@endif

@if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
@endif
    @if(session('messageDR'))
    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-info mx-2"></i>
        <strong style="font-size: 150%">  {!! Str::upper(session('messageDR')) !!} </strong>
    </div>
    @endif  
    <form wire:submit.prevent="store" autocomplete="off" id="myform">
        @csrf
        <table class="table" id="ballots_table">
            <thead>
                <tr>
                    <th></th>
                    <th>Ballot Control No.</th>
                    <th>Details</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ballotlists as $index => $ballotlist)
                <tr>
                <td>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">{{$index+1}}</span>
                </button>
                </td>
                    <td>
                        <input type="text" id="focusBallot{{$index}}" name="ballotlists[{{$index}}][ballot_id]" class="form-control" wire:model="ballotlists.{{$index}}.ballot_id" 
                        wire:change="searchBallotId($event.target.value, {{ $index }} )" required/>
                    </td>
                    <td>
                    <a href="#" class="card-post__category badge badge-pill badge-info">{{ $ballotlist['quantity'] }} {{ $ballotlist['clustered_precint'] }} {{ $ballotlist['description'] }} {{ $ballotlist['city_mun_prov'] }} </a>
                        <input type="text" name="ballotlists[{{$index}}][clustered_precint]" class="form-control" wire:model="ballotlists.{{$index}}.clustered_precint" hidden/>
                    </td>
                    <td>
                        <a href="#" wire:click.prevent="removeBallot({{$index}})" class="text-danger">Remove</a>
                    </td>
                    
                    <td>
                        <input type="text" name="ballotlists[{{$index}}][city_mun_prov]" class="form-control" wire:model="ballotlists.{{$index}}.city_mun_prov" hidden/>
                    </td>
                    <td>
                        <input type="text" name="ballotlists[{{$index}}][quantity]" class="form-control" wire:model="ballotlists.{{$index}}.quantity" hidden/>
                    </td>
                    <td>
                        <input type="text" name="ballotlists[{{$index}}][curr_stat]" class="form-control" wire:model="ballotlists.{{$index}}.curr_stat" hidden/>
                    </td>
                    <td>
                        <input type="text" name="ballotlists[{{$index}}][description]" class="form-control" wire:model="ballotlists.{{$index}}.description" hidden/>
                    </td>
                    <td>
                        <input type="text" name="ballotlists[{{$index}}][agency_name]" class="form-control" wire:model="ballotlists.{{$index}}.agency_name" hidden/>
                    </td>
                    <td>
                        <input type="text" name="ballotlists[{{$index}}][contact_no]" class="form-control" wire:model="ballotlists.{{$index}}.contact_no" hidden/>
                    </td>
                    <td>
                        <input type="text" name="ballotlists[{{$index}}][complete_address]" class="form-control" wire:model="ballotlists.{{$index}}.complete_address" hidden/>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table>
        <thead>
        <tr>
                <th><button class="btn btn-sm btn-secondary" wire:click.prevent="addBallot">+ Add Another Row</button></th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th><button type="submit" class="btn btn-primary"  @if($showSaveBtn == true) @else disabled @endif><i class="material-icons">save</i> Save </button></th>
            </tr>
            </thead>
        </table>
        <div class="row">
            <script>
                window.addEventListener('searchSucceed', event => {
                    $("focusBallot1").focus();
                    var readonlyId = event.detail.idFocus - 1;
                    $("#focusBallot" + readonlyId).attr('readonly', 'readonly');
                    document.getElementById("focusBallot" + event.detail.idFocus).focus();
                })
                window.onload = function() {
                    document.getElementById("focusBallot0").focus();
                };
            </script>
        </div>
    </form>

                             <!--end content of new create dr tab-->
                        </div>

                        <div class="tab-pane fade show" id="receipt_list" role="tabpanel" aria-labelledby="receipt_list-tab" wire:ignore.self>   
                            <!--start content list of receipt-->

   
                            <div class="card-body pt-0 pb-3">
                                <div class="row border-bottom py-2 mb-0 bg-light">&nbsp;&nbsp;&nbsp;List of Delivery Receipt Created </div>
                            </div>
                            <div class="card-body pt-0 pb-3 text-center">
                                <div class="row border-bottom py-2 mb-0 bg-light">
                                    <div class="col-12 col-sm-12">
                                        <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by Ballot Control No. or Receipt No. or Company Name" wire:model="wire_search_receipt_list" >
                                    </div>
                                </div>
                            </div>
                            
<ul class="list-group list-group-flush">
  <li class="list-group-item p-0 pb-3 text-center">
    @if (count($receipt_list) > 0)
      <table class="table table-hover mb-0">
        <thead class="bg-light">
          <tr>
          <th scope="col" class="border-0">Receipt No.</th>
          <th scope="col" class="border-0">Company Name</th>
          <th scope="col" class="border-0">Ballot Delivery Location</th>
          <th scope="col" class="border-0">Contact Details</th>
          <th scope="col" class="border-0">Date and Time Created</th>
          <th scope="col" class="border-0">View Items</th> 
          <th scope="col" class="border-0">Print Delivery Receipt</th> 

          </tr>
        </thead>
        <tbody>
          @foreach ($receipt_list as $item)
            <tr>
              <td>{{ $item->DR_NO }}</td>
              <td>{{ $item->agency_name }}</td>
              <td>{{ $item->CITY_MUN_PROV }}</td>
              <td>{{ $item->contact_no }}</td>
              <td>{{ $item->created_at }}</td>
              <td>
              <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modal_view_receipt" wire:click="ViewDrNo({{ $item->id }})" >
              <i class="material-icons">search</i>
                          </button>
              </td>
              
              <td>
              <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modal_receipt" wire:click="modalGetDrNo({{ $item->id }})" >
                            Generate Delivery Receipt  &rarr;
                          </button>
                          
              </td>
















              
            </tr>
          @endforeach
         </tbody>
        </table>
      @else<br>
      <p style="text-align: center">No Data found.</p>    
      @endif
  </li>
  <li class="list-group-item px-3">
                  {{ $receipt_list->links() }}
                  </li>
                </ul>
                            <!--end content list of receipt-->
                         </div>
       











                         <div class="modal fade" id="modal_receipt" tabindex="-1" role="dialog" aria-labelledby="modal_receipt" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Generate and Download Delivery Receipt</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
              </div>
              {{Form::open(['route' => 'receipt', 'method' => 'GET', 'autocomplete'=>'off'])}} 
              <div class="modal-body">
                  <div class="row">
                      <div class="col-sm-12 col-md-12">
                          <div class="form-row">
             
                        <input type="hidden" name="new_input_for_dr_no" wire:model="modalDrNo">
                              <div class="form-group col-md-12">
                                  <strong class="text-muted d-block mb-2">Copies for (select multiple):</strong>
                                  <div class="dropdown">
                                      <button type="button" class="col-md-12 mb-2 btn btn-white mr-2 " id="sampleDropdownMenu" data-toggle="dropdown">Select Copies For:&nbsp;<i class="fas fa-arrow-down"></i></button>
                                      <div class="dropdown-menu col-md-12">
                                          @foreach((clone $config_query->where('copies','<>','')) as $copy)
                                          <a class="dropdown-item " >
                                              <input type="checkbox" id="modal_id_copies" name="modal_input_copies[]" value="{{$copy->id}}"> {{$copy->copies}}
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
                              <div class="form-group col-md-6">
                                  <strong class="text-muted d-block mb-2">Issued By:</strong>
                                  <select id="modal_id_issued" name="modal_input_issued" class="form-control" required>
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
                                  <select id="modal_id_approved" name="modal_input_approved" class="form-control" required>
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
                                  <select id="modal_id_received" name="modal_input_received" class="form-control" required>
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
                                  <select id="modal_id_inspected" name="modal_input_inspected" class="form-control" required>
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







































  <div class="modal fade" id="modal_view_receipt" tabindex="-1" role="dialog" aria-labelledby="modal_receipt" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Receipt Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
              </div>
             
              <div class="modal-body">
                  <div class="row">
                      <div class="col-sm-12 col-md-12">
                      <input type="hidden" name="view_input_for_dr_no" wire:model="modalViewDrNo">
                          <div class="form-row">
                          <div class="form-group col-md-12">
                          <table style="page-break-inside:auto">

<tr>
<br>
    <th width="100%" style="font-size:10px; text-align:right;">
      <b></b>
      </th>
    </tr>


    <tr style="page-break-inside:avoid; page-break-after:auto">
      <th width="20%" style="font-size:17px; text-align:left;">
        DR No.:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$modalViewDrNo}}<br>
        COMPANY:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$viewAgency}}<br>
        DELIVERY ADDRESS:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$viewAddress}}<br>
        CONTACT:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$viewContact}}<br>
      </th>
      <th width="80%" style="text-align:left; font-size:17px">
        <u></u><br>
        <u></u><br>
        <u></u><br>
 
      </th> 
    </tr>

</table>

                          </div>
                              <div class="form-group col-md-12">
                

                              <ul class="list-group list-group-flush">
  <li class="list-group-item p-0 pb-3 text-center">
    @if (count($viewReceiptDetails) > 0)
      <table class="table table-hover mb-0">
        <thead class="bg-light">
          <tr>
     
          <th scope="col" class="border-0">Ballot Control No.</th>
          <th scope="col" class="border-0">Quantity</th>
          <th scope="col" class="border-0">Unit</th>
          <th scope="col" class="border-0">Description</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($viewReceiptDetails as $item)
            <tr>
              <td>{{ $item->BALLOT_ID }}</td>
              <td>{{ $item->CLUSTER_TOTAL }}</td>
              <td>{{ $item->CLUSTERED_PREC }}</td>
              <td>{{ $item->description }}</td>
            </tr>
          @endforeach
         </tbody>
        </table>
      @else<br>
      <p style="text-align: center">No Data found.</p>    
      @endif
  </li>
  <li class="list-group-item px-3">

                  </li>
                </ul>













                                
                              </div>
                          </div>
                      </div>
                  </div>
                
                  <div class="row">
                      <div class="col-sm-12 col-md-12">
                          <div class="form-row">

                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12 col-md-12">
                          <div class="form-row">
                         
                           
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
               
              </div>
          </div>
      </div>
  </div>











































                        </div>
                    </div>
    </div>
</div>


















































































































</div>
</div> 
</div>