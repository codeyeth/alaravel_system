
        
            
                    <div class="card-header border-bottom">
                        <h6 class="m-0">Delivery Reports Configuration <label style="float:right;">Add and Remove data to be used in Reports </label></h6> 
                    </div>  
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <!---start of issued by-->
                                <div class="card card-small mb-4">
                                    <div class="card-header border-bottom">
                                        <h6 class="m-0">List for Authorized Personnel <label style="float:right;">{{$nameList->count()}}</label></h6>
                                    </div>
                                    @if(session('messageSavePerson'))
                                    <div class="alert alert-success">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {!! Str::upper(session('messageSavePerson')) !!} 
                                    </div>
                                    @endif
                                    @if(session('messageDeletePerson'))
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {!! Str::upper(session('messageDeletePerson')) !!}
                                    </div>
                                    @endif
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item p-0 px-3 pt-3">
                                            @if (count($nameList) > 0)
                                            <div class="mynav" style="height: 275px;   overflow-y : scroll;">
                                                <table class="table table-hover mb-0">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th scope="col" class="border-0">Name</th>
                                                            <th scope="col" class="border-0">Position / Title</th>
                                                            <th scope="col" class="border-0">Authorized for</th>
                                                            <th scope="col" class="border-0">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($nameList as $item)
                                                        <tr>
                                                            <td>{{ $item->personnel}}</td>
                                                            <td>{{ $item->title}}</td>
                                                            <td>{{ $item->authorization}}</td>
                                                            <td><button class="btn btn-danger" wire:click="remove({{ $item->id }}, '1')"> <i class="material-icons">delete</i> Delete</button></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            @else<br>
                                                <p style="text-align: center">No Data.</p>    
                                            @endif
                                        </li>
                                        <li class="list-group-item p-3">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <input type="text" class="form-control  @error('person_name') is-invalid  @enderror" placeholder="Type Name of Personnel Here" wire:model="person_name">
                                                            @error('person_name')  <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <select id="person_title" name="person_title" class="form-control" wire:model="person_title">
                                                                <option selected disabled value="">Choose title / position</option>
                                                                <option value="N/A">N/A</option>
                                                                @if(count($titleList) > 0)
                                                                @foreach($titleList as $post)
                                                                <option value="{{$post->title_list}}">{{$post->title_list}}</option>
                                                                @endforeach
                                                                @else
                                                                <option selected disabled value="">No Title available</option>
                                                                @endif
                                                            </select>
                                                            @error('person_title') <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{ $message }}</div>@enderror
                                                        </div>         
                                                        <div class="form-group col-md-4">
                                                            <select id="person_auth" name="person_auth" class="form-control" wire:model="person_auth" required>
                                                                <option selected disabled value="">This Person is Authorized for:</option>
                                                                <option value="Received by">Received by</option>
                                                                <option value="Approved by">Approved by</option>
                                                                <option value="Issued by">Issued by</option>
                                                                <option value="Inspected by">Inspected by</option>
                                                            </select> 
                                                            @error('person_auth') <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{ $message }}</div>@enderror
                                                        </div>
                                                    </div> 
                                                    <button wire:click="saveconfig(1)" class="btn btn-success col-md-12"><i class="material-icons">add</i>ADD</button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!---end of issued by-->
                               <!-- <div class="form-row">
                                    <div class="col-lg-6 mb-4">
                                        <div class="card card-small mb-4">
                                            <div class="card-header border-bottom">
                                                <h6 class="m-0">List for Reports Delivered to: <label style="float:right;">{{$deliveredList->count()}}</label></h6>
                                            </div>
                                            @if(session('messageSaveDelivered'))
                                            <div class="alert alert-success">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                {!! Str::upper(session('messageSaveDelivered')) !!} 
                                            </div>
                                            @endif
                                            @if(session('messageDeleteDelivered'))
                                            <div class="alert alert-danger">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                {!! Str::upper(session('messageDeleteDelivered')) !!}
                                            </div>
                                            @endif
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item p-0 px-3 pt-3">
                                                @if (count($deliveredList) > 0)
                                                <div class="mynav" style="height: 375px;   overflow-y : scroll;">
                                                    <table class="table table-hover mb-0">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th scope="col" class="border-0">Delivered to:</th>
                                                                <th scope="col" class="border-0"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($deliveredList as $item)
                                                            <tr>
                                                                <td>{{ $item->delivered_to}}</td>
                                                                <td><button class="btn btn-danger" wire:click="remove({{ $item->id }}, '2')"> <i class="material-icons">delete</i> Delete</button></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @else<br>
                                                <p style="text-align: center">No Data.</p>    
                                                @endif
                                                </li>
                                                <li class="list-group-item p-3">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <input type="text" class="form-control @error('delivered_to') is-invalid  @enderror" placeholder="Type Data here for Delivered to:" wire:model="delivered_to">
                                                                    @error('delivered_to')<div class="invalid-feedback"> {{ $message }} </div> @enderror
                                                                </div>
                                                            </div>
                                                            <button wire:click="saveconfig(2)" class="btn btn-success col-md-12"><i class="material-icons">add</i>ADD</button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card card-small mb-4">
                                            <div class="card-header border-bottom">
                                                <h6 class="m-0">List for Reports Description <label style="float:right;">{{$descriptionList->count()}}</label></h6>
                                            </div>
                                            @if(session('messageSaveDescription'))
                                            <div class="alert alert-success">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                {!! Str::upper(session('messageSaveDescription')) !!} 
                                            </div>
                                            @endif
                                            @if(session('messageDeleteDescription'))
                                            <div class="alert alert-danger">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            {!! Str::upper(session('messageDeleteDescription')) !!}
                                            </div>
                                            @endif
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item p-0 px-3 pt-3">
                                                    @if (count($nameList) > 0)
                                                    <div class="mynav" style="height: 375px;   overflow-y : scroll;">
                                                        <table class="table table-hover mb-0">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th scope="col" class="border-0">Description</th>
                                                                    <th scope="col" class="border-0"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($descriptionList as $item)
                                                            <tr>
                                                                <td>{{$item->description}}</td>
                                                                <td><button class="btn btn-danger" wire:click="remove({{ $item->id }}, '3')"> <i class="material-icons">delete</i> Delete</button></td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @else<br>
                                                    <p style="text-align: center">No Data.</p>    
                                                    @endif
                                                </li>
                                                <li class="list-group-item p-3">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <input type="text" class="form-control @error('description') is-invalid  @enderror" placeholder="Type Another Description Here" wire:model="description">
                                                                        @error('description')  <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                                                </div>
                                                            </div>
                                                            <button wire:click="saveconfig(3)" class="btn btn-success col-md-12"><i class="material-icons">add</i>ADD</button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                -->
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card card-small mb-4">
                                    <div class="card-header border-bottom">
                                        <h6 class="m-0">List of Positions / Title  <label style="float:right;">{{$titleList->count()}} </label></h6>
                                    </div>
                                    @if(session('messageSaveTitle'))
                                    <div class="alert alert-success">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {!! Str::upper(session('messageSaveTitle')) !!} 
                                    </div>
                                    @endif
                                    @if(session('messageDeleteTitle'))
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {!! Str::upper(session('messageDeleteTitle')) !!}
                                    </div>
                                    @endif
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-3">
                                            @if (count($titleList) > 0)
                                            <div class="mynav" style="height: 250px;   overflow-y : scroll;">
                                                <table class="table table-hover mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="col" class="border-0">Position / Title</th>
                                                            <th scope="col" class="border-0"></th>
                                                        </tr>
                                                        @foreach ($titleList as $item)
                                                        <tr>
                                                            <td>{{ $item->title_list}}</td>
                                                            <td><button class="btn btn-danger" wire:click="remove({{ $item->id }}, '4')"> <i class="material-icons">delete</i> Delete</button></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else<br>
                                        <p style="text-align: center">No Data.</p>    
                                        @endif
                                        </li>
                                        <li class="list-group-item p-3">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <input class="form-control form-control-lg mb-0 @error('title') is-invalid  @enderror" type="text" placeholder="Type here to add for new Position / Title" required wire:model="title" >
                                                            @error('title')  <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                                        </div>
                                                    </div>
                                                    <button wire:click="saveconfig(4)"  class="btn btn-success col-md-12"><i class="material-icons">add</i>ADD</button>                       
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                <div class="card card-small mb-6">
                                    <div class="card-header border-bottom">
                                        <h6 class="m-0">List of Copies For <label style="float:right;">{{$copyList->count()}} </label></h6>
                                    </div>
                                    @if(session('messageSaveCopies'))
                                    <div class="alert alert-success">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {!! Str::upper(session('messageSaveCopies')) !!} 
                                    </div>
                                    @endif
                                    @if(session('messageDeleteCopies'))
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {!! Str::upper(session('messageDeleteCopies')) !!}
                                  </div>
                                  @endif
                                  <ul class="list-group list-group-flush">
                                      <li class="list-group-item px-3">
                                      @if (count($copyList) > 0)
                                          <div class="mynav" style="height: 350px;   overflow-y : scroll;">
                                              <table class="table table-hover mb-0">
                                                  <tbody>
                                                      <tr>
                                                          <th scope="col" class="border-0">Copies</th>
                                                          <th scope="col" class="border-0"></th>
                                                      </tr>
                                                      @foreach ($copyList as $item)
                                                      <tr>
                                                          <td>{{ $item->copies}}</td>
                                                          <td><button class="btn btn-danger" wire:click="remove({{ $item->id }}, '5')"> <i class="material-icons">delete</i> Delete</button></td>
                                                      </tr>
                                                      @endforeach
                                                  </tbody>
                                              </table>
                                          </div>
                                           @else<br>
                                          <p style="text-align: center">No Data.</p>    
                                          @endif
                                      </li>
                                      <li class="list-group-item p-3">
                                          <div class="row">
                                              <div class="col-sm-12 col-md-12">
                                                  <div class="form-row">         
                                                      <div class="form-group col-md-12">
                                                          <input class="form-control form-control-lg mb-0 @error('copies') is-invalid  @enderror" type="text" placeholder="Type here to add for new Copies for" wire:model="copies">
                                                          @error('copies')  <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                                      </div>
                                                  </div>
                                                  <button wire:click="saveconfig(5)" class="btn btn-success col-md-12"><i class="material-icons">add</i>ADD</button>
                                              </div>
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>

            
        
 
