<div>
    <div class="row">
        
        <style>
            input { 
                text-transform: uppercase;
            }
            ::-webkit-input-placeholder { /* WebKit browsers */
                text-transform: none;
            }
        </style>
        
        <div class="col-lg-5 col-md-12">
            <div class="card card-small mb-2">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Actions</h6>
                </div>
                
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3">
                            
                            <span class="d-flex mb-2">
                                <strong class="mr-1">   <i class="material-icons mr-1">face</i>Total User Count:</strong>
                                <strong class="text-success">{{ $allUserCount }}</strong>
                            </span>
                            <span class="d-flex mb-2">
                                <strong class="mr-1"> <i class="material-icons mr-1">sentiment_satisfied_alt</i> Total Active Users:</strong>
                                <strong class="text-success">{{ $allUserCount }}</strong>
                            </span>
                            <span class="d-flex mb-2">
                                <strong class="mr-1"> <i class="material-icons mr-1">disabled_by_default</i> Total Freezed Users:</strong>
                                <strong class="text-success">{{ $allUserCount }}</strong>
                            </span>
                            
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalAddUser">
                                <i class="material-icons">add</i> Add New User
                            </button>
                            <div style="margin-left: 10px;"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        {{-- ADD USER MODULE --}}
        @livewire('rr-user-management.add-user')
        
    </div>
</div>
