

<div>
<h3 class="user-profile__username">Old Requests ({{ count($requestList) }})</h3>

<br>

@if (session()->has('message'))
<div class="alert alert-success">
{{ session('message') }}
</div>
@endif
<div class="row">
<div class="col-sm-7">
<input type="text" class="form-control" id="search" name="search" required wire:model="search"  placeholder="Search" />
</div>



<div class="col-sm-3">
<select id="probCat" name="probCat" class="form-control" required="">
<option value="">Select Searchable</option>
<option value="request_id"> Request ID </option>
<option value="emp_name"> Supervised By </option>
<option value="destination"> Destination </option>
<option value="date"> Date </option>
<option value="time"> Time </option>
<option value="purpose"> Purpose </option>
<option value="created_at"> Requested at </option>
</select>
</div>

<div class="col-sm-2">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">ADD REQUEST</button>
</div>

</div>



<br>

@if (count($requestList) > 0)
<table class="table table-hover table-bordered">
<thead style="background-color: white;">
<tr>
<th>REQUEST ID</th>
<th><small>SUPERVISED BY</small> <br> REQUESTED BY</th>
<th>DESTINATION</th>
<th>DATE - TIME</th>
<th>PURPOSE</th>
<th>REQUESTED AT</th>
<th>ACTION</th>
</tr>
</thead>
<tbody>
@foreach ($requestList as $item)
<tr>
<td>
@if ($item->is_approved == 1)
<small style="color: green;"><b>&bullet; APPROVED</b></small>
@elseif($item->is_approved == 0)
<small style="color: orange;"><b>&bullet;PENDING</b></small>
@elseif($item->is_approved == 2)
<small style="color: red;"><b>&bullet; DISAPPROVED</b></small>
@endif <br>
{{ $item->request_id}}
</td>
<td><small>{{ $item->division_chief}}</small> <br>
<b>{{ $item->emp_name}}</b>
</td>
<td>{{ $item->destination}}</td>
<td>{{ $item->date}} - {{ $item->time}}</td>
<td>{{ $item->purpose}}</td>
<td>
<small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </small> <br>
{{ \Carbon\Carbon::parse($item->created_at)->toDayDateTimeString() }}
</td>
@if ($item->is_approved == 1)
<td><small style="color: green;"><b> APPROVED</b></small><br>
Reason/Notes: {{ $item->reason}}<br>
{!! Form::open(['route' => 'set', 'method' => 'GET', 'autocomplete'=>'off', 'target' => '_blank'])!!}
<input type="text"  name="pdfid" value = "{{$item->id}}" hidden>
{{ Form::submit('Print to PDF',['class'=>'btn btn-success']) }}{{ Form::close() }}
</td>
@elseif($item->is_approved == 0)
<td><button data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $item->id }})" class="btn btn-primary btn-sm">Edit</button></td>
@elseif($item->is_approved == 2)
<td><small style="color: red;"><b> Disapproved</b></small><br>Reason/Notes: {{ $item->reason}}</td>
@else
@endif

</tr>
@endforeach
</tbody>
</table>

@else
<h1 style="text-align: center;">NO REQUEST FOUND!</h1>
@endif

{{ $requestList->links() }}

@include('livewire.j-livewire.motorpool.update-request')
</div>


<style scoped>
.twoot-item {
    padding: 20px;
    background-color: white;
    border-radius: 5px;
    border: 1px solid #dfe3e8;
    box-sizing: border-box;
    cursor: pointer;
    transition: all 0.25s ease;
}

.item_new {
    padding: 5px 20px;
    font-weight: bold;
    background-color: red;
    color: white;
}

.item_done {
    padding: 5px 20px;
    font-weight: bold;
    background-color: #06a40b;
    color: white;
}

.tsNo {
    padding: 5px 20px;
    font-weight: bold;
    background-color: #4682b4;
    color: white;
}

.item_old {
    display: none;
}
.twoot-item:hover {
    transform: scale(1.1, 1.1);
}

.twoot-item__content {
    /* display: grid;
    grid-gap: 50px;
    grid-template-columns: 3fr 1fr; */
    padding: 10px 5%;
}
</style>
