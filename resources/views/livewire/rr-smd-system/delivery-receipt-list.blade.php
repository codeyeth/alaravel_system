<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Delivery Receipt Table</h6>
                </div>
                
                @if(session('messageDrDelivered'))
                <div class="alert alert-accent alert-dismissible fade show mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-info mx-2"></i>
                    <strong style="font-size: 150%">  {!! Str::upper(session('messageDrDelivered')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                </div>
                @endif
                
                <div class="card-body pt-0 pb-3 text-center" style="overflow-x:auto;">
                    <div class="row border-bottom py-2 mb-0 bg-light">
                        <div class="col-12 col-sm-12">
                            <div class="d-flex">
                                <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                                    <label class="btn btn-white {{ $keywordMode == true ? 'active' : ''}}" wire:click="$set('keywordMode', true)"><input type="radio" name="options" id="option1"> Search by Keyword </label>
                                    <label class="btn btn-white {{ $keywordMode == true ? '' : 'active'}}" wire:click="$set('keywordMode', false)"><input type="radio" name="options" id="option2"> Search by Dates</label>
                                </div>
                                <div class="p-2"></div>
                                <div class="ml-auto p-2">
                                    Total of <b class="text-success" style="font-size: 120%;"> {{ $drListCount }} </b> Result/s Found
                                </div>
                            </div>
                        </div>
                        
                        @if ($keywordMode == true)
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg mb-0" type="text" placeholder="Search" wire:model="searchDeliverReceipt" value="{{ $keywordMode }}">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg mb-0" type="date" placeholder="Search" wire:model="searchDeliverReceipt">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <ul class="list-group list-group-flush" style="overflow-x:auto;">
                    <li class="list-group-item p-0 pb-3 text-center" id="dr_list">
                        @if (count($drList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">DR NO</th>
                                    <th scope="col" class="border-0">SI NO</th>
                                    <th scope="col" class="border-0">STOCK NO</th>
                                    <th scope="col" class="border-0">OR NO</th>
                                    <th scope="col" class="border-0">AGENCY NAME</th>
                                    <th scope="col" class="border-0">DR STATUS</th>
                                    <th scope="col" class="border-0">POSTED BY</th>
                                    <th scope="col" class="border-0">POSTED AT</th>
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drList as $dr_list)
                                <tr>
                                    <td>{{ $dr_list->id }}</td>
                                    <td>
                                        <a href="#" title="View Delivery Receipt" data-toggle="modal" data-target="#modalViewDr" wire:click="getDr({{ $dr_list->id }})">
                                            {{-- <i class="material-icons">search</i>  --}}
                                            <b>{{ $dr_list->dr_no }}</b>
                                        </a>
                                    </td>
                                    <td><b class="text-success"> {{ $dr_list->sales_invoice_code }} </b></td>
                                    <td>{{ $dr_list->stock_no }}</td>
                                    <td>{{ $dr_list->or_no }}</td>
                                    <td>{{ $dr_list->agency_name }}</td>
                                    <td>
                                        @if ( $dr_list->is_delivered == true)
                                        <p class="text-success mb-0"><b> DELIVERED </b></p>
                                        @else
                                        <p class="text-danger mb-0"><b> PENDING </b></p>
                                        @endif
                                    </td>
                                    <td>{{ $dr_list->created_by_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($dr_list->created_at)->toDayDateTimeString() }}</td>
                                    <td>
                                        <button type="button" class="btn btn-accent btn-sm"><i class="material-icons">text_snippet</i> PDF</button>
                                    </td>
                                    <td>
                                        @if ( $dr_list->issued_by != null && $dr_list->received_by != null )
                                        @if ( $dr_list->is_delivered == false)
                                        <button type="button" class="btn btn-success btn-sm" wire:click="markAsDelivered({{ $dr_list->id }})"><i class="material-icons">check</i> SET AS DELIVERED</button>
                                        @endif
                                        @else
                                        <p class="text-danger mb-0">Pending Details</p>
                                        @endif
                                        
                                    </td>
                                </tr>      
                                @endforeach
                            </tbody>
                        </table>    
                        @else
                        <br>
                        <p style="text-align: center">No Delivery Receipt Found.</p>
                        @endif
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
    <div class="text-center"> 
        {{ $drList->links() }}
    </div>
    
    {{-- MODAL VIEW DELIVERY RECEIPT --}}
    <div class="modal fade" id="modalViewDr" tabindex="-1" role="dialog" aria-labelledby="modalViewDr" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">View Delivery Receipt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if( $showViewDrModal == true )
                    
                    @if ( $parentDr->is_delivered == true )
                    <h3 style="text-align: right;" class="mb-0 text-success"><b> DELIVERED </b></h3>
                    <p style="text-align: right;" class="text-default mb-3">at {{ \Carbon\Carbon::parse($parentDr->is_delivered_at)->toDayDateTimeString() }}</p>
                    @else
                    <h3 style="text-align: right;" class="mb-3 text-danger">PENDING</h3>
                    @endif
                    
                    <h6 style="text-align: right;" class="mb-0"><b>DR NO. :</b> {{ $parentDr->sales_invoice_code }}</h6>
                    <h6 style="text-align: right;" class="mb-4"><b>DATE. :</b> {{ \Carbon\Carbon::parse($parentDr->created_at)->toFormattedDateString() }}</h6>
                    
                    <hr class="hr_dashed">
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <h6 class="mb-1"><b>AGENCY NAME:</b> {{ $parentDr->agency_name }}</h6>
                            <h6 class="mb-1"><b>COMPLETE ADDRESS:</b> {{ $parentDr->agency_address }}</h6>
                            <h6 class="mb-1"><b>REGION:</b> {{ $parentDr->region }}</h6>
                            <h6 class="mb-1"><b>CONTACT NO/PERSON:</b> {{ $parentDr->contact_no }} - {{ $parentDr->contact_person }}</h6>
                            <h6 class="mb-1"><b>E-MAIL ADDRESS:</b> {{ $parentDr->email }}</h6>
                        </div>
                    </div>
                    
                    <hr class="hr_dashed">
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;" >S.I NO.</th>
                                <th style="text-align: center;" >STOCK ORDER NO.</th>
                                <th style="text-align: center;" >BILL / OR NO.</th>
                                <th style="text-align: center;" >QTY</th>
                                <th style="text-align: center;" >UNIT OF MEASURE</th>
                                <th style="text-align: center;" colspan="2">DESCRIPTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($childDr as $child_dr)
                            <tr>
                                @if($loop->index == 0)
                                <td style="text-align: center;"> {{ $parentDr->sales_invoice_code }}</td>
                                <td style="text-align: center;"> {{ $parentDr->stock_no }}</td>
                                <td style="text-align: center;"> {{ $parentDr->or_no }}</td>
                                @else
                                <td></td>
                                <td></td>
                                <td></td>
                                @endif
                                <td style="text-align: center;"> {{ $child_dr->quantity }}</td>
                                <td style="text-align: center;"> {{ $child_dr->unit }}</td>
                                <td style="text-align: center;"> {{ $child_dr->item_description }}</td>
                                <td style="text-align: center;"> {{ $child_dr->additional_description }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <hr class="hr_dashed">
                    
                    @if(session('messageDrUpdate'))
                    <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-info mx-2"></i>
                        <strong style="font-size: 150%">  {!! Str::upper(session('messageDrUpdate')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                    </div>
                    <br>
                    @endif
                    
                    @if ( $parentDr->is_delivered == true )
                    <h6 class="mb-1"><b>ISSUED BY:</b> {{ $parentDr->issued_by }}</h6>
                    <h6 class="mb-1"><b>RECEIVED BY:</b> {{ $parentDr->received_by }}</h6>
                    <h6 class="mb-1"><b>NO. OF BUNDLE/S:</b> {{ $parentDr->no_of_bundles }}</h6>
                    <h6 class="mb-1"><b>REMARKS:</b> {{ $parentDr->remarks }}</h6>
                    @endif
                    
                    @if ( $parentDr->is_delivered == false )
                    
                    <h6 class="mb-2 text-accent"><i class="material-icons">info</i> <b> FILL THIS FIRST BEFORE GENERATING THE DR PDF</b></h6>
                    
                    <form wire:submit.prevent="updateSaveDetails({{ $parentDr->id }})" autocomplete="off">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <strong class="text-muted d-block mb-2">ISSUED BY <span class="requiredTag">&bullet;</span> </strong>
                                        <input type="text" class="form-control" id="issuedBy" name="issuedBy" placeholder="Issued By" autocomplete="off" wire:model="issuedBy" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <strong class="text-muted d-block mb-2">NO OF BUNDLES <span class="requiredTag">&bullet;</span> </strong>
                                        <input type="number" class="form-control" id="noOfBundles" name="noOfBundles" placeholder="No. of Bundles" autocomplete="off" wire:model="noOfBundles" required>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <strong class="text-muted d-block mb-2">RECEIVED BY <span class="requiredTag">&bullet;</span> </strong>
                                        <input type="text" class="form-control" id="receivedBy" name="receivedBy" placeholder="Received By" autocomplete="off" wire:model="receivedBy" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <strong class="text-muted d-block mb-2">REMARKS </strong>
                                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" autocomplete="off" wire:model="remarks" >
                                    </div>
                                    <div class="form-group col-md-2">
                                        <strong class="text-muted d-block mb-2"></strong>
                                        <br>
                                        <button type="submit" class="btn btn-accent btn-block"><i class="material-icons">save</i> Save/Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                    
                    @endif
                    
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                
            </div>
        </div>
    </div>
    
</div>