<div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-3">
                <div class="card-header border-bottom text-center">
                    <div class="mb-3 mx-auto">
                        <img class="rounded-circle" src="{{ asset('shards_template/images/avatars/user-icon.png') }}" alt="User Avatar" width="110"> 
                    </div>
                    <h4 class="mb-1">{{ Str::upper($userDetails->name) }}</h4>
                    <span class="text-muted d-block mb-1">{{ Str::upper($userDetails->position) }}</span>
                    <span class="text-muted d-block mb-2">{{ Str::upper($division) }} - {{ Str::upper($section) }}</span>
                    
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-4">
                        <div class="progress-wrapper">
                            <strong class="text-muted d-block mb-0"> {{ $userRole }} </strong>
                            
                            <hr class="hr_dashed">
                            
                            @if( $userRole == 'SUPER ADMINISTRATOR')
                            <span class="badge badge-accent mb-1">ALL MODULES</span>
                            @endif
                            
                            @if( $userRole == 'ADMINISTRATOR')
                            
                            @if( $userDetails->is_user_mgt == true )
                            <span class="badge badge-accent mb-1">USER MANAGEMENT</span>
                            @endif
                            
                            @if( $userDetails->is_ballot_tracking == true )
                            <span class="badge badge-accent mb-1">BALLOT TRACKING</span>
                            @endif
                            
                            @if( $userDetails->is_dr == true )
                            <span class="badge badge-accent mb-1">DELIVERY RECEIPT (B.T)</span>
                            @endif
                            
                            @if( $userDetails->is_motorpool == true )
                            <span class="badge badge-accent mb-1">MOTORPOOL SYSTEM</span>
                            @endif
                            
                            @if( $userDetails->is_gazette == true )
                            <span class="badge badge-accent mb-1">COMPOSING SYSTEM</span>
                            @endif
                            
                            @if( $userDetails->is_smd_system == true )
                            <span class="badge badge-accent mb-1">SMD SYSTEM</span>
                            @endif
                            
                            @endif
                            
                        </div>
                    </li>
                    <li class="list-group-item p-4">
                        <strong class="text-muted d-block mb-2">Last Seen</strong>
                        @if( $lastSeenOnDate[0]->action == 'Login')
                        <span class="badge badge-success">{{ Str::upper($lastSeenOnDate[0]->action) }} </span>
                        @else
                        <span class="badge badge-danger">{{ Str::upper($lastSeenOnDate[0]->action) }} </span>
                        @endif
                        
                        <span><i class="material-icons">schedule</i> {{ \Carbon\Carbon::parse($lastSeenOnDate[0]->created_at)->toDayDateTimeString() }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>