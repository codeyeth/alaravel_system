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
            
              <input type="text" wire:model="wire_dr_reports_identifier" name="modal_input_dr_reports_identifier" hidden>
           
              <div class="modal-body">
                  <div class="row">
                      <div class="col-sm-12 col-md-12">
                           
                            <div class="form-row"  @if($wire_dr_reports_identifier == 1 || $wire_dr_reports_identifier == 2) @else style="display:none;"  @endif>  
                                <div class="form-group col-md-6">
                                    <div @if($wire_dr_reports_identifier == 1) @else style="display:none;"  @endif>
                                        <strong class="text-muted d-block mb-2">Delivery No:</strong>
                                        <input type="text" name="modal_input_search_dr_no" id="modal_id_search_dr_no" class="input-sm form-control" placeholder="Receipt No." wire:model="wire_search_dr_no">
                                    </div>
                                    <div @if($wire_dr_reports_identifier == 2) @else style="display:none;"  @endif>
                                        <strong class="text-muted d-block mb-2">Select Date:</strong>
                                        <input type="date" name="modal_input_daily_date" id="modal_id_input_daily_date" class="input-sm form-control" placeholder="DR No." wire:model="wire_search_dr_no">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">Date Generated:</strong>
                                    <input type="date" name="modal_input_dated" id="modal_input_dated"  class="input-sm form-control" value="<?php echo date('Y-m-d'); ?>" >
                                </div>
                            </div>
                            
                          <div class="form-row" @if($wire_dr_reports_identifier == 3 ) @else  style="display:none;"  @endif >
                              <div class="form-group col-md-6">
                                  <strong class="text-muted d-block mb-2">Reports datefrom:</strong>
                                  <input type="date" name="modal_input_monthly_datefrom" id="modal_id_monthly_dateto" wire:model="wire_monthly_datefrom" class="input-sm form-control" >
                              </div>
                              <div class="form-group col-md-6">
                                  <strong class="text-muted d-block mb-2">Reports date to:</strong>
                                  <input type="date" name="modal_input_monthly_dateto" id="modal_id_monthly_dateto" wire:model="wire_monthly_dateto"  class="input-sm form-control" >
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12 col-md-12">
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                  <strong class="text-muted d-block mb-2">Delivered To:</strong>
                                  <select id="modal_id_delivered" name="modal_input_delivered" class="form-control" required>
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
                              <div class="form-group col-md-12">
                                  <strong class="text-muted d-block mb-2">Description:</strong>
                                  <select id="modal_id_description" name="modal_input_description" class="form-control" required>
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