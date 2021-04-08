<div>
<div>

<div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                   

                <ul class="nav nav-tabs justify-content-end" role="tablist">
                <li class="nav-item">
                    <a class="nav-link"  href="{{ asset('/delivery_ob') }}">OB</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('/delivery_fts') }}">FTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ asset('/delivery_configuration') }}">Settings</a>
                </li>
            </ul>

      
                </div>
                <div class="card-header border-bottom">
                    <h6 class="m-0">Delivery Reports Configuration <label style="float:right;">Add and Remove data to be used in Reports </label></h6> 
                  </div>
                  @if(session('messageSaveNewCopy'))
                        <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-info mx-2"></i>
                            <strong style="font-size: 150%">  {!! Str::upper(session('messageSaveNewCopy')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                        </div>
                        @endif

                        @if(session('messageDeleteCopy'))
                <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-info mx-2"></i>
                    <strong style="font-size: 150%">  {!! Str::upper(session('messageDeleteCopy')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                </div>
                @endif
           



                <div class="row">
    <div class="col-lg-8 mb-4">
                <!---start of issued by-->
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">List for Authorized Personnel</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 px-3 pt-3">
                    @if (count($copyList) > 0)
                    <div class="mynav" style="height: 400px;   overflow-y : scroll;">
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
                                    <td><button type="submit" class="btn btn-danger" wire:click="removecopy({{ $item->id }})"> <i class="material-icons">delete</i> Delete</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        @else
                        <br>
                        <p style="text-align: center">Not found.</p>    
                        @endif
                    </li>
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                        <form wire:submit.prevent="savecopy" autocomplete="off">
                            <input class="form-control col-sm-3 col-md-3 form-control-lg mb-0" type="text" placeholder="Type here to add for new Copies for" wire:model="copy">

                            <br><button type="submit" class="btn btn-success col-md-12"><i class="material-icons">add</i>ADD</button>
                       
                        </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                 <!---end of issued by-->

        















              </div>

              <div class="col-lg-4 mb-4">
                <!-- Sliders & Progress Bars -->
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">List of Positions / Title</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3">
                    @if (count($titleList) > 0)
                    <div class="mynav" style="height: 250px;   overflow-y : scroll;">
                        <table class="table table-hover mb-0">
                            <tbody>
                            @foreach ($titleList as $item)
                                <tr>
                                    <td>{{ $item->title_list}}</td>
                                    <td><button type="submit" class="btn btn-danger" wire:click="removetitlelist({{ $item->id }})"> <i class="material-icons">delete</i> Delete</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        @else
                        <br>
                        <p style="text-align: center">No Data.</p>    
                        @endif

                  
                 
                      <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                        <form wire:submit.prevent="savetitle" autocomplete="off">
                            <input class="form-control form-control-lg mb-0" type="text" placeholder="Type here to add for new Position / Title" wire:model="title">
                            <br><button type="submit" class="btn btn-success col-md-12"><i class="material-icons">add</i>ADD</button>
                        </form>
                        </div>
                      </div>
                    </li>
                    </li>
                  </ul>
                </div>
                <!-- / Sliders & Progress Bars -->
                <!-- Input & Button Groups -->
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">List of Copies For</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3">
                    @if (count($copyList) > 0)
                    <div class="mynav" style="height: 350px;   overflow-y : scroll;">
                        <table class="table table-hover mb-0">
                            <tbody>
                            @foreach ($copyList as $item)
                                <tr>
                                    <td>{{ $item->copies}}</td>
                                    <td><button type="submit" class="btn btn-danger" wire:click="removecopy({{ $item->id }})"> <i class="material-icons">delete</i> Delete</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        @else
                        <br>
                        <p style="text-align: center">Not found.</p>    
                        @endif
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                        <form wire:submit.prevent="savecopy" autocomplete="off">
                            <input class="form-control form-control-lg mb-0" type="text" placeholder="Type here to add for new Copies for" wire:model="copy">
                            <br><button type="submit" class="btn btn-success col-md-12"><i class="material-icons">add</i>ADD</button>
                        </form>
                        </div>
                      </div>
                    </li>
                    </li>
                  </ul>
                  
                </div>
                <!-- / Input & Button Groups -->
              </div>
            </div>
          </div>






            </div>
        </div>
    </div>
  



</div>
</div>
