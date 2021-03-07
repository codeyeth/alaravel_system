<div class='card card-small mb-3'>
    <div class="card-header border-bottom mb-3">
        <form class="col-12">
            <div class="form-row">
                <label class="col-sm-2 col-form-label"  for="name">Create DR For:</label>
                <div x-data="{ open: false }">
  <ul class="nav nav-tabs ">
    <li class="nav-item dropdown">
        <a @click="open = !open" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Select</a>
            <div class="dropdown-menu">
                <a @click.prevent="$dispatch('dropdown-select', { element: 'one' })" class="dropdown-item" href="#" >OB</a>
                <a  @click.prevent="$dispatch('dropdown-select', { element: 'two' })" class="dropdown-item" href="#" >FTS</a>
    </li>
  </ul>
</div>
              
            </div>
        </form>
    </div>
        <div class='card-body p-0'>
            <ul class="list-group list-group-flush">
                <div class="col-lg-12 col-md-12">

                <div x-data="{ selected: '' }" @dropdown-select.window="selected = $event.detail.element">
  <div x-show="selected === 'one'">
  



















  <div class="card card-small mb-3"><!-- Add New Post Form -->
                        <div>
                            <div class="card">
                                <div class="card-header">
                                     Official Ballot
                                </div>
                                    @if (session()->has('message'))
                                    <div class="alert alert-success">
                                    {{ session('message') }}
                                    </div>
                                    @endif
                                    <form>
                                    <div class="card-body">
                                        <table class="table" id="ballots_table">
                                            <thead>
                                                <tr>
                                                    <th>Ballot ID</th>
                                                    <th>Clustered Precint</th>
                                                    <th>City / Municipality / Province</th>
                                                    <th>Quanitity</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ballotlists as $index => $ballotlist)
                                             <tr>
                                                <td>
                                                    <input type="text" name="ballotlists[{{$index}}][ballot_id]" class="form-control" wire:model="ballotlists.{{$index}}.ballot_id" />
                                                </td>
                                                <td>
                                                    <input type="text" name="ballotlists[{{$index}}][clustered_precint]" class="form-control" wire:model="ballotlists.{{$index}}.clustered_precint" />
                                                </td>
                                                <td>
                                                    <input type="text" name="ballotlists[{{$index}}][city_mun_prov]" class="form-control" wire:model="ballotlists.{{$index}}.city_mun_prov" />
                                                </td>
                                                <td>
                                                    <input type="text" name="ballotlists[{{$index}}][quantity]" class="form-control" wire:model="ballotlists.{{$index}}.quantity" />
                                                </td>
                                                <td>
                                                    <a href="#" wire:click.prevent="removeBallot({{$index}})">Remove</a>
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
                                                <button  wire:click.prevent="store()" class="btn btn-primary"><i class="material-icons">save</i> Save </button>
                                            </div>
                                            
                    
                                        </div>
                            </div>
                    </div>
                    <br />
    
                            </form>
                    </div> <!-- / Add New Post Form -->















  
  
  </div>
  <div x-show="selected === 'two'">
  
  
  </div>
</div>



                   
                    


































































                    
        </div>
        
                 
            </ul>
            
</div>

