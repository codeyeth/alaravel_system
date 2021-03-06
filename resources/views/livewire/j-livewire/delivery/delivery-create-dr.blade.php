
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
    <div class="card-header">
        You are now in Delivery Number Entry</i>
        </div>
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
                    <th>Poll Location Serial Number</th>
                    <th>Ballot Delivery Location</th>
                    <th>Quantity</th>
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
                        wire:change="searchBallotId($event.target.value, {{ $index }})" required/>
                    </td>
                    <td>
                        <input type="text" name="ballotlists[{{$index}}][clustered_precint]" class="form-control" wire:model="ballotlists.{{$index}}.clustered_precint" readonly/>
                    </td>
                  
                    <td>
                        <input type="text" name="ballotlists[{{$index}}][city_mun_prov]" class="form-control" wire:model="ballotlists.{{$index}}.city_mun_prov" readonly/>
                    </td>
                    <td>
                        <input type="text" name="ballotlists[{{$index}}][quantity]" class="form-control" wire:model="ballotlists.{{$index}}.quantity" readonly/>
                    </td>
                    <td>
                        <input type="text" name="ballotlists[{{$index}}][curr_stat]" class="form-control" wire:model="ballotlists.{{$index}}.curr_stat" hidden/>
                    </td>
                    <td>
                        <a href="#" wire:click.prevent="removeBallot({{$index}})" class="text-danger">Remove</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-10">
                <button class="btn btn-sm btn-secondary" wire:click.prevent="addBallot">+ Add Another Row</button>
            </div>  
           
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary"  @if($showSaveBtn == true) @else disabled @endif><i class="material-icons">save</i> Save </button>
            </div>
        
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


