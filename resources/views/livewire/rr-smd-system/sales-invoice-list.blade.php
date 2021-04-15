<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Sales Invoice Table</h6>
                </div>
                
                @if(session('messagePostToLedger'))
                <div class="alert alert-accent alert-dismissible fade show mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-info mx-2"></i>
                    <strong style="font-size: 150%">  {!! Str::upper(session('messagePostToLedger')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                </div>
                @endif
                
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
                                    Total of <b class="text-success" style="font-size: 120%;"> {{ $salesInvoiceListCount }} </b> Result/s Found
                                </div>
                            </div>
                        </div>
                        
                        @if ($keywordMode == true)
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg mb-0" type="text" placeholder="Search" wire:model="searchSalesInvoice" value="{{ $keywordMode }}">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg mb-0" type="date" placeholder="Search" wire:model="searchSalesInvoice">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pb-3 text-center" id="sales_invoice_list">
                        @if (count($salesInvoiceList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">S.I CODE</th>
                                    {{-- <th scope="col" class="border-0">STOCK #</th> --}}
                                    <th scope="col" class="border-0">AGENCY NAME</th>
                                    {{-- <th scope="col" class="border-0">AGENCY ADDRESS</th> --}}
                                    <th scope="col" class="border-0">T. TYPE</th>
                                    <th scope="col" class="border-0">MOP</th>
                                    <th scope="col" class="border-0">CREATED BY</th>
                                    <th scope="col" class="border-0">CREATED AT</th>
                                    {{-- <th scope="col" class="border-0"></th> --}}
                                    <th scope="col" class="border-0"></th>
                                    <th scope="col" class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salesInvoiceList as $sales_invoice_list)
                                <tr>
                                    <td>{{ $sales_invoice_list->id }}</td>
                                    <td>
                                        <a href="#" title="View Sales Invoice" data-toggle="modal" data-target="#modalViewSalesInvoice" wire:click="getSalesInvoice({{ $sales_invoice_list->id }})">
                                            <i class="material-icons">search</i> 
                                            <b>{{ $sales_invoice_list->sales_invoice_code }}</b>
                                        </a>
                                    </td>
                                    {{-- <td><b>{{ $sales_invoice_list->stock_no }}</b></td> --}}
                                    <td>{{ $sales_invoice_list->agency_name }}</td>
                                    {{-- <td>{{ $sales_invoice_list->agency_address }} - {{ $sales_invoice_list->region }}</td> --}}
                                    <td>{{ $sales_invoice_list->transaction_type }}</td>
                                    <td>{{ $sales_invoice_list->payment_mode }}</td>
                                    <td>{{ $sales_invoice_list->created_by_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sales_invoice_list->created_at)->toDayDateTimeString() }}</td>
                                    
                                    {{-- <th><button class="btn btn-info btn-block"> <i class="material-icons">search</i> View</button></th> --}}
                                    <th><button class="btn btn-accent btn-block btn-sm"> <i class="material-icons">text_snippet</i> PDF</button></th>
                                    <th>
                                        @if ($sales_invoice_list->is_posted == false)
                                        <button class="btn btn-accent btn-block btn-sm" wire:click="postToLedger({{ $sales_invoice_list->id }})"> <i class="material-icons">text_snippet</i> Post to CL</button>
                                        @else
                                        <b class="text-success">POSTED</b>
                                        @endif
                                    </th>
                                </tr>      
                                @endforeach
                            </tbody>
                        </table>    
                        @else
                        <br>
                        <p style="text-align: center">No Sales Invoice Found.</p>
                        @endif
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
    <div class="text-center"> 
        {{ $salesInvoiceList->links() }}
    </div>
    
    
    {{-- MODAL VIEW SALES INVOICE --}}
    <div class="modal fade" id="modalViewSalesInvoice" tabindex="-1" role="dialog" aria-labelledby="modalViewSalesInvoice" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">View Sales Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if( $showViewSalesInvoiceModal == true )
                    
                    <h6  style="text-align: right;" class="mb-0"><b>NO. :</b> {{ $parentSalesInvoiceDetails->sales_invoice_code }}</h6>
                    <h6  style="text-align: right;" class="mb-4"><b>DATE. :</b> {{ \Carbon\Carbon::parse($parentSalesInvoiceDetails->created_at)->toFormattedDateString() }}</h6>
                    <h6  style="text-align: right;" class="mb-1"><b>CODE:</b>{{ $parentSalesInvoiceDetails->code }}</h6>
                    
                    <hr class="hr_dashed">
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="d-flex">
                                <div class="col-sm-12 col-md-8">
                                    <h6 class="mb-1"><b>AGENCY NAME:</b> {{ $parentSalesInvoiceDetails->agency_name }}</h6>
                                    <h6 class="mb-1"><b>COMPLETE ADDRESS:</b> {{ $parentSalesInvoiceDetails->agency_address }}</h6>
                                    <h6 class="mb-1"><b>REGION:</b> {{ $parentSalesInvoiceDetails->region }}</h6>
                                    <h6 class="mb-1"><b>CONTACT NO/PERSON:</b> {{ $parentSalesInvoiceDetails->contact_no }} - {{ $parentSalesInvoiceDetails->contact_person }}</h6>
                                    <h6 class="mb-1"><b>E-MAIL ADDRESS:</b> {{ $parentSalesInvoiceDetails->email }}</h6>
                                </div>
                                
                                <div class="col-sm-12 col-md-4">
                                    <h6 class="mb-1"><b>PR#</b> {{ $parentSalesInvoiceDetails->pr_no }}</h6>
                                    <h6 class="mb-1"><b>DR#</b> {{ $parentSalesInvoiceDetails->dr_no }}</h6>
                                    <h6 class="mb-1"><b>OR#</b> {{ $parentSalesInvoiceDetails->or_no }}</h6>
                                    {{-- <h6 class="mb-1"><b>Transaction Type</b> {{ $parentSalesInvoiceDetails->transaction_type }}</h6>
                                    <h6 class="mb-1"><b>Payment Type </b> {{ $parentSalesInvoiceDetails->payment_type }}</h6> --}}
                                    <h6 class="mb-1"><b>W.O#</b> {{ $parentSalesInvoiceDetails->work_order_no }}</h6>
                                    <h6 class="mb-1"><b>STOCK#</b> {{ $parentSalesInvoiceDetails->stock_no }}</h6>
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
                            @foreach ($childSalesInvoiceDetails as $child_sales_invoice)
                            <tr>
                                <td style="text-align: center;"> {{ $child_sales_invoice->quantity }}</td>
                                <td style="text-align: center;"> {{ $child_sales_invoice->unit }}</td>
                                <td style="text-align: center;"> {{ $child_sales_invoice->item_description }}</td>
                                <td style="text-align: center;"> {{ $child_sales_invoice->additional_description }}</td>
                                <td style="text-align: center;" class="text-accent">PHP</td>
                                <td style="text-align: center;">{{ $child_sales_invoice->price }}</td>
                                <td style="text-align: center;" class="text-accent">PHP</td>
                                <td style="text-align: center;">{{ $child_sales_invoice->total }}</td>
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
                                <td style="text-align: center;">{{ $childSalesInvoiceDetails->sum('total') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="d-flex">
                                <div class="col-sm-12 col-md-8">
                                    <h6 class="mb-1"><b>PAYMENT MODE/PACKAGE TYPE:</b> {{ $parentSalesInvoiceDetails->payment_mode }}/{{ $parentSalesInvoiceDetails->package_type }}</h6>
                                    <h6 class="mb-1"><b>ISSUED BY:</b> {{ $parentSalesInvoiceDetails->issued_by }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="hr_dashed">
                    
                    @if(session('messageControlNumberUpdate'))
                    <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-info mx-2"></i>
                        <strong style="font-size: 150%">  {!! Str::upper(session('messageControlNumberUpdate')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                    </div>
                    <br>
                    @endif

                    <h6 class="mb-2 text-warning"><b>UPDATE CONTROL NUMBERS</b></h6>
                    
                    <form wire:submit.prevent="updateControlNumber({{ $parentSalesInvoiceDetails->id }})" autocomplete="off">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">PR# <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="prNo" name="prNo" placeholder="PR#" autocomplete="off" wire:model="prNo" >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <strong class="text-muted d-block mb-2">DR# <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="drNo" name="drNo" placeholder="DR#" autocomplete="off" wire:model="drNo" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <strong class="text-muted d-block mb-2">OR# <span class="requiredTag">&bullet;</span></strong>
                                        <input type="text" class="form-control" id="orNo" name="orNo" placeholder="OR#" autocomplete="off" wire:model="orNo" >
                                    </div>
                                    <div class="form-group col-md-1">
                                        <strong class="text-muted d-block mb-2"></strong>
                                        <br>
                                        <button type="submit" class="btn btn-accent btn-block">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                    
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                
            </div>
        </div>
    </div>
</div>