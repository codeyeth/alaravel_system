<!--create ob dr-->
<div @if($wire_dr_types_identifier == 1) @else style="display:none" @endif> 
    @if (session()->has('message'))
    <div class="alert alert-success">
    {{ session('message') }}
    </div>
    @endif
    <div class="card-header">
        You are now in DR Entry for <b><i>OB </b></i>
    </div>
    @if(session('messageOB'))
    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-info mx-2"></i>
        <strong style="font-size: 150%">  {!! Str::upper(session('messageOB')) !!} </strong>
    </div>
    @endif  
    <form wire:submit.prevent="store" autocomplete="off">
        @csrf
        <table class="table" id="ballots_table">
            <thead>
                <tr>
                    <th>Ballot ID</th>
                    <th>Clustered Precint</th>
                    <th>Province / Municipality / Barangay</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obballotlists as $index => $ballotlist)
                <tr>
                    <td>
                        <input type="text" id="obfocusBallot{{$index}}" name="obballotlists[{{$index}}][ballot_id]" class="form-control" wire:model="obballotlists.{{$index}}.ballot_id" 
                        wire:change="searchBallotId($event.target.value, {{ $index }})" required/>
                    </td>
                    <td>
                        <input type="text" name="obballotlists[{{$index}}][clustered_precint]" class="form-control" wire:model="obballotlists.{{$index}}.clustered_precint" readonly/>
                    </td>
                    <td>
                        <input type="text" name="obballotlists[{{$index}}][city_mun_prov]" class="form-control" wire:model="obballotlists.{{$index}}.city_mun_prov" readonly/>
                    </td>
                    <td>
                        <input type="text" name="obballotlists[{{$index}}][quantity]" class="form-control" wire:model="obballotlists.{{$index}}.quantity" readonly/>
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
            @if($obshowSaveBtn == true)
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary"><i class="material-icons">save</i> Save </button>
            </div>
            @endif
            <script>
                window.addEventListener('obsearchSucceed', event => {
                    $("obfocusBallot1").focus();
                    var readonlyId = event.detail.idFocus - 1;
                    $("#obfocusBallot" + readonlyId).attr('readonly', 'readonly');
                    document.getElementById("obfocusBallot" + event.detail.idFocus).focus();
                })
                window.onload = function() {
                    document.getElementById("obfocusBallot0").focus();
                };
            </script>
        </div>
    </form>
</div>

<!--end create ob dr-->


<!--create fts dr-->
<div @if($wire_dr_types_identifier == 2) @else style="display:none" @endif> 
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <div class="card-header">
        You are now in DR Entry for <b><i>FTS </b></i>
    </div>
    @if(session('messageFTS'))
    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-info mx-2"></i>
        <strong style="font-size: 150%">  {!! Str::upper(session('messageFTS')) !!} </strong>
    </div>
    @endif
    <form wire:submit.prevent="store" autocomplete="off">
        @csrf
        <table class="table" id="ballots_table">
            <thead>
                <tr>
                    <th>Ballot ID</th>
                    <th>Clustered Precint</th>
                    <th>Province / Municipality / Barangay</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ftsballotlists as $index => $ballotlist)
                <tr>
                    <td>
                        <input type="text" id="ftsfocusBallot{{$index}}" name="ftsballotlists[{{$index}}][ballot_id]" class="form-control" wire:model="ftsballotlists.{{$index}}.ballot_id" 
                        wire:change="searchBallotId($event.target.value, {{ $index }})" required/>
                    </td>
                    <td>
                        <input type="text" name="ftsballotlists[{{$index}}][clustered_precint]" class="form-control" wire:model="ftsballotlists.{{$index}}.clustered_precint" readonly/>
                    </td>
                    <td>
                        <input type="text" name="ftsballotlists[{{$index}}][city_mun_prov]" class="form-control" wire:model="ftsballotlists.{{$index}}.city_mun_prov" readonly/>
                    </td>
                    <td>
                        <input type="text" name="ftsballotlists[{{$index}}][quantity]" class="form-control" wire:model="ftsballotlists.{{$index}}.quantity" readonly/>
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
            @if($ftsshowSaveBtn == true)
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary"><i class="material-icons">save</i> Save </button>
            </div>
            @endif
            <script>
                window.addEventListener('ftssearchSucceed', event => {
                    $("ftsfocusBallot1").focus();
                    var readonlyId = event.detail.idFocus - 1;
                    $("#ftsfocusBallot" + readonlyId).attr('readonly', 'readonly');
                    document.getElementById("ftsfocusBallot" + event.detail.idFocus).focus();
                })
                window.onload = function() {
                    document.getElementById("ftsfocusBallot0").focus();
                };
            </script>
        </div>
    </form>
</div>
<!--end create fts dr-->