
<div>
<ul class="nav nav-tabs justify-content-end" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" wire:ignore.self>Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="create-tab" data-toggle="tab" href="#create" role="tab" aria-controls="create" aria-selected="false" wire:ignore.self>Create Request</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" wire:ignore.self>
        <div class="row">
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Total Number of Requests</span>
                                <h6 class="stats-small__value count my-3">{{$select_all_motorpool_query->count()}}</h6>
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
            </div>
        </div>
        <div class="row">
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Total Number of Pending Requests</span>
                                <h6 class="stats-small__value count my-3">{{(clone $select_all_motorpool_query)->where('is_approved',0)->count()}}</h6>
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
            </div>
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Total Number of Requests Waiting</span>
                                <h6 class="stats-small__value count my-3">{{(clone $select_all_motorpool_query)->where('is_approved',1)->count()}}</h6>
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
            </div>
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Total Number Requests Approved</span>
                                <h6 class="stats-small__value count my-3">{{(clone $select_all_motorpool_query)->where('is_approved',2)->count()}}</h6>
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
            </div>
            
            <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                    <div class="card-body p-0 d-flex">
                        <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Total Number of Requests Declined</span>
                                <h6 class="stats-small__value count my-3">{{(clone $select_all_motorpool_query)->where('is_approved',3)->count()}}</h6>
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
            </div>
        </div>
 @if (session()->has('message'))
<div class="alert alert-success">
{{ session('message') }}
</div>
@endif

        <div class="card-header border-bottom">
            <h6 class="m-0">Requests Lists <label style="float:right;"> {{$requestthis}} </label></h6>
        </div>
        <div class="row border-bottom py-2 mb-0 ">
            <div class="col-4 col-sm-4">
                <input class="form-control form-control-lg mb-0" type="text" placeholder="Search Here.." wire:model="search">
            </div>
            <div class="col-4 col-sm-4">
                <select id="statusfilter" wire:model="statusfilter" name="statusfilter" class="form-control form-control-lg" required>
                     <option disabled selected value="">Select Status</option>
                        <option value="0"> Pending </option>
                        <option value="1"> Waiting </option>
                        <option value="2"> Approved </option>
                        <option value="3"> Disapproved </option>
                    </select>
                    </div>
                    <div class="col-4 col-sm-4">
                    <input type="date" id="datefilter" wire:model="datefilter" name="datefilter" class="form-control form-control-lg" id="feRequestDate" />
                    </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item p-0 pb-3 text-center">
                @if (count($requestList) > 0)
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">Request ID</th>
                                <th scope="col" class="border-0"><small>Supervised by</small><br> REQUESTED BY</th>
                                <th scope="col" class="border-0"><small>Division</small><br> Section</th>
                                <th scope="col" class="border-0">Destination</th>
                                <th scope="col" class="border-0">Datetime of Use</th>
                                <th scope="col" class="border-0">Purpose</th>
                                <th scope="col" class="border-0">Requested at</th>
                                <th scope="col" class="border-0">Status / Notes / Reason</th>
                                <th scope="col" class="border-0">Signed Copy</th>
                                <th scope="col" class="border-0">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($requestList as $item)
                            <tr>
                                <td>
                                @if ($item->is_approved == 0)
                                    <small style="color: orange;"><b>&bullet; {{ $item->status }}</b></small>
                                    @elseif($item->is_approved == 1)
                                    <small style="color: blue;"><b>&bullet;{{ $item->status }}</b></small>
                                    @elseif($item->is_approved == 2)
                                    <small style="color: green;"><b>&bullet; {{ $item->status }}</b></small>
                                    @elseif($item->is_approved == 3)
                                    <small style="color: red;"><b>&bullet; {{ $item->status }}</b></small>
                                    @endif <br>
                                    {{ $item->request_id}}
                                </td>
                                <td>
                                <small>{{ $item->division_chief}}</small> <br>
                                <b>{{ $item->emp_name}}</b>
                                </td>
                                <td>
                                <small>{{ $item->division}}</small> <br>
                                <b>{{ $item->section}}</b>
                                </td>
                                <td>{{ $item->destination}}</td>
                                <td>{{$item->date}} {{$item->time}}</td>
                                <td>{{ $item->purpose}}</td>
                                <td>
                                <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </small> <br>
                                {{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString() }}
                                </td>
                                <td> 
                                     @if ($item->is_approved == 0)
                                    <small style="color: orange;"><b>&bullet; {{ $item->status }}</b></small>
                                    @elseif($item->is_approved == 1)
                                    <small style="color: blue;"><b>&bullet;{{ $item->status }}</b></small>
                                    @elseif($item->is_approved == 2)
                                    <small style="color: green;"><b>&bullet; {{ $item->status }}</b></small>
                                    @elseif($item->is_approved == 3)
                                    <small style="color: red;"><b>&bullet; {{ $item->status }}</b></small>
                                    @endif <br>
                                {{ $item->reason }}
                                </td>
                            <td>
                            @if ($item->is_approved == 0)
                            <h5>No File</h5>
                            @else
                            <a href="{{asset('storage/motorpool_letter/'.$item->signature_file.'')}}">{{$item->signature_file}}</a>
                            @endif
                            </td>
                            <td>  

@if ($item->is_approved == 0 && Auth::user()->is_motorpool == 1 )
{!! Form::open(['route' => 'brought', 'method' => 'GET', 'autocomplete'=>'off'])!!}
<input type="text"  name="pdfid" value = "{{$item->id}}" hidden>
{{ Form::submit('Print to PDF',['class'=>'btn btn-success']) }}{{ Form::close() }}<br>
<button data-toggle="modal" data-target="#updateLetter" wire:click="editletter({{ $item->id }})" class="btn btn-info btn-sm">Upload Signed Letter</button>
@elseif($item->is_approved == 1 && Auth::user()->is_motorpool == 1)
{!! Form::open(['route' => 'brought', 'method' => 'GET', 'autocomplete'=>'off'])!!}
<input type="text"  name="pdfid" value = "{{$item->id}}" hidden>
{{ Form::submit('Print to PDF',['class'=>'btn btn-success']) }}{{ Form::close() }}<br>
<button data-toggle="modal" data-target="#updateLetter" wire:click="editletter({{ $item->id }})" class="btn btn-info btn-sm">Reupload Signed Letter</button>
@elseif(Auth::user()->is_motorpool == 2)
<button data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $item->id }})" class="btn btn-primary btn-sm">Edit</button>
@endif

</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        @else<br>
                    <p style="text-align: center">Not found.</p>    
                @endif
            </li>
            <li class="list-group-item px-3">
                {{ $requestList->links() }} 
            </li>
        </ul>
    </div>
    @include('livewire.j-livewire.motorpool.update-request')
    <div class="tab-pane fade show" id="create" role="tabpanel" aria-labelledby="create-tab" wire:ignore.self>
    @include('livewire.j-livewire.motorpool.new-request')
    </div>
</div>














































            </div>
        </div>
    </div>
   

</div>
</div>
