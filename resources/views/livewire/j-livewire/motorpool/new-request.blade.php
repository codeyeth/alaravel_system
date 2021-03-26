
<div class="col-lg-8 justify-content-center">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Create Request</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col">
                        {!! Form::open(['action' => 'MotorpoolRequestjController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ,
    'autocomplete' => 'off', 'class' => 'create-twoot-panel' ]) !!}
    @csrf
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="feRequestEmp">Requesting Employee (Please include your Full Name):</label>
                                <input type="text" name="empName" class="form-control" id="feFirstName" placeholder="" >
                              </div>
                              <div class="form-group col-md-12">
                                <label for="feRequestDiv">Division:</label>
                                <select id="division" name="division" class="form-control" wire:change="spitMatchedSection($event.target.value)" required>
                                            @if(count($divisionsList) > 0)
                                            <option disabled selected value="">Select division</option>
                                            @foreach($divisionsList as $post)
                                            <option value="{{$post->id}}">{{$post->division}}</option>
                                            @endforeach
                                            @else
                                            <option disabled selected>No Division available</option>
                                            @endif                
                                        </select>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="feRequestSec">Section:</label>
                                <select id="section" name="section" class="form-control" required>
                                            @if(count($sectionsList) > 0)
                                            <option disabled selected value="">Select section</option>
                                            @foreach($sectionsList as $post)
                                            <option value="{{$post->id}}">{{$post->section}}</option>
                                            @endforeach
                                            @else
                                            <option disabled selected>No section available</option>
                                            @endif
                                        </select>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="feRequestSup">Authorizing Supervisor/Division Chief:</label>
                                <input type="text" id="chiefName" name="chiefName" class="form-control" id="feRequestSup" placeholder="" >
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="feRequestDes">Destination:</label>
                                <input type="text" id="destination" name="destination" class="form-control" id="feRequestDes" placeholder="">
                              </div>
                              <div class="form-group col-md-12">
                                <label for="feRequestDate">Date and Time of Use: </label>
                                <input type="datetime-local" id="datetime" name="datetime" class="form-control" id="feRequestDate" placeholder="" value="<?php echo date('Y-m-d\TH:i'); ?>"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="feRequestPur">Purpose:</label>
                              <input type="text" id="purpose" name="purpose" class="form-control" id="feRequestPur" placeholder="">
                            </div>
                            <div class="form-row">
                             
                              
                            <button type="submit" class="btn btn-accent">Submit</button>
                            {!! Form::close() !!}
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
    </div>