


  @if (session()->has('message'))
                                <div class="alert alert-success">
                            {{ session('message') }}
                                </div>
                            @endif





                                <div class="card-header">
                                    You are now in DR Entry for <b><i>Official Ballot </b></i>
                                </div>



  <table class="table" id="ballots_table">
                                <thead>
                                    <tr>
                                        <th>Ballot ID</th>
                                        <th>Clustered Precint</th>
                                        <th>Province / Municipality / Province</th>
                                        <th>Quanitity</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
            @foreach ($ballotlists as $index => $ballotlist)
            <tr>
                <td>
                    <input type="text" id="focusBallot{{$index}}" name="ballotlists[{{$index}}][ballot_id]" class="form-control" wire:model="ballotlists.{{$index}}.ballot_id" 
                    wire:keyup="searchBallotId($event.target.value, {{ $index }})" />
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
                                <button  wire:click.prevent="storeob()" class="btn btn-primary"><i class="material-icons">save</i> Save </button>
                            </div>


                            <script>
            window.addEventListener('searchSucceed', event => {
                // $("focusBallot1").focus();
                // alert("focusBallot" + event.detail.idFocus);
                document.getElementById("focusBallot" + event.detail.idFocus).focus();

            })
            window.onload = function() {
                document.getElementById("focusBallot0").focus();
            };
        </script>
                            </div>



