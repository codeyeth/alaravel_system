<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Purchase Order Table</h6>
                </div>
                
                <div class="card-body pt-0 pb-3 text-center">
                    <div class="row border-bottom py-2 mb-0 bg-light">
                        <div class="col-12 col-sm-12">
                            <div class="d-flex">
                                <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                                    <label class="btn btn-white {{ $keywordMode == true ? 'active' : ''}}" wire:click="$set('keywordMode', true)"><input type="radio" name="options" id="option1"> Search by Keyword </label>
                                    <label class="btn btn-white {{ $keywordMode == true ? '' : 'active'}}" wire:click="$set('keywordMode', false)"><input type="radio" name="options" id="option2"> Search by Dates</label>
                                </div>
                                <div class="p-2"></div>
                                <div class="ml-auto p-2">
                                    Total of <b class="text-success" style="font-size: 120%;"> {{ $purchaseOrderListCount }} </b> Result/s Found
                                </div>
                            </div>
                        </div>
                        
                        @if ($keywordMode == true)
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg mb-0" type="text" placeholder="Search" wire:model="search" value="{{ $keywordMode }}">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg mb-0" type="date" placeholder="Search" wire:model="search">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pb-3 text-center" id="purchase_order_list">
                        @if (count($purchaseOrderList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0" style="text-align: right;">P.O NO</th>
                                    <th scope="col" class="border-0" style="text-align: left;">AGENCY NAME</th>
                                    <th scope="col" class="border-0" style="text-align: right;">P.O SOURCE</th>
                                    <th scope="col" class="border-0" style="text-align: left;">GOODS TYPE</th>
                                    <th scope="col" class="border-0"  style="text-align: left;">CREATED BY</th>
                                    {{-- <th scope="col" class="border-0"  style="text-align: left;"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchaseOrderList as $purchase_order_list)
                                <tr>
                                    <td>{{ $purchase_order_list->id }}</td>
                                    <td  style="text-align: right;">
                                        <a href="#" title="View Purchase Order" data-toggle="modal" data-target="#modalViewPurchaseOrder" wire:click="getPurchaseOrder({{ $purchase_order_list->id }})">
                                            <b style="font-size: 120%;">{{ $purchase_order_list->purchase_order_no }}</b>
                                        </a>
                                    </td>
                                    <td  style="text-align: left;"> 
                                        @if( $purchase_order_list->goods_type == 'GENERIC')
                                        <span class="badge badge-accent">{{ $purchase_order_list->agency_name }}</span> 
                                        @else
                                        <span class="badge badge-secondary">{{ $purchase_order_list->agency_name }}</span> 
                                        @endif
                                    </td>
                                    <td style="text-align: right;"> <span class="badge badge-info"> {{ $purchase_order_list->po_source }} </span> </td>
                                    <td style="text-align: left;"> 
                                        @if( $purchase_order_list->goods_type == 'GENERIC')
                                        <span class="badge badge-accent"> {{ $purchase_order_list->goods_type }} </span>
                                        @else
                                        <span class="badge badge-secondary"> {{ $purchase_order_list->goods_type }} </span>
                                        @endif
                                    </td>
                                    
                                    <td style="text-align: left;">{{ $purchase_order_list->created_by_name }} <br> at {{ \Carbon\Carbon::parse($purchase_order_list->created_at)->toDayDateTimeString() }}</td>
                                    {{-- <td style="text-align: left;">
                                        @if( $purchase_order_list->is_posted == true )
                                        <span class="badge badge-success">PURCHASE ORDER POSTED</span> 
                                        @else
                                        <span class="badge badge-warning">PURCHASE ORDER PENDING</span> 
                                        @endif
                                    </td> --}}
                                    
                                </tr>      
                                @endforeach
                            </tbody>
                        </table>    
                        @else
                        <br>
                        <p style="text-align: center">No Purchase Order Found.</p>
                        @endif
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
    <div class="text-center"> 
        {{ $purchaseOrderList->links() }}
    </div>
    
    {{-- MODAL VIEW PURCHASE ORDER --}}
    <div class="modal fade" id="modalViewPurchaseOrder" tabindex="-1" role="dialog" aria-labelledby="modalViewPurchaseOrder" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">View Purchase Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if( $showPurchaseOrderModal == true )
                    
                    <h6  style="text-align: right;" class="mb-0"><b>PO NO. :</b> {{ $parentPurchaseOrderDetails->purchase_order_no }}</h6>
                    
                    <hr class="hr_dashed">
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="d-flex">
                                <div class="col-sm-12 col-md-8">
                                    <h6 class="mb-1"><b>AGENCY NAME:</b> {{ $parentPurchaseOrderDetails->agency_name }}</h6>
                                    <h6 class="mb-1"><b>COMPLETE ADDRESS:</b> {{ $parentPurchaseOrderDetails->agency_address }}</h6>
                                    <h6 class="mb-1"><b>REGION:</b> {{ $parentPurchaseOrderDetails->region }}</h6>
                                    <h6 class="mb-1"><b>CONTACT NO/PERSON:</b> {{ $parentPurchaseOrderDetails->contact_no }} - {{ $parentPurchaseOrderDetails->contact_person }}</h6>
                                    <h6 class="mb-1"><b>E-MAIL ADDRESS:</b> {{ $parentPurchaseOrderDetails->email }}</h6>
                                </div>
                                
                                <div class="col-sm-12 col-md-4">
                                    
                                </div>  
                            </div>
                        </div>
                    </div>
                    
                    <hr class="hr_dashed">
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;" >QTY</th>
                                <th style="text-align: center;" >UNIT OF MEASURE</th>
                                <th style="text-align: center;" colspan="2">DESCRIPTION</th>
                                <th style="text-align: center;" colspan="2">PRICE</th>
                                <th style="text-align: center;" colspan="2">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($childPurchaseOrderDetails as $child_purchase_order)
                            <tr>
                                <td style="text-align: center;"> {{ $child_purchase_order->quantity }}</td>
                                <td style="text-align: center;"> {{ $child_purchase_order->unit }}</td>
                                <td style="text-align: center;"> {{ $child_purchase_order->item_description }}</td>
                                <td style="text-align: center;"> {{ $child_purchase_order->additional_description }}</td>
                                <td style="text-align: center;" class="text-accent">PHP</td>
                                <td style="text-align: center;">{{ $child_purchase_order->price }}</td>
                                <td style="text-align: center;" class="text-accent">PHP</td>
                                <td style="text-align: center;">{{ $child_purchase_order->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="text-align: center;">TOTAL</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center;" class="text-accent">PHP</td>
                                <td style="text-align: center;">{{ $childPurchaseOrderDetails->sum('total') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                
            </div>
        </div>
    </div>
    
</div>