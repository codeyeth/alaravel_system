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
                                    <th scope="col" class="border-0">STOCK #</th>
                                    <th scope="col" class="border-0">AGENCY NAME</th>
                                    <th scope="col" class="border-0">AGENCY ADDRESS</th>
                                    <th scope="col" class="border-0">T. TYPE</th>
                                    <th scope="col" class="border-0">P. TYPE</th>
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
                                    <td><b>{{ $sales_invoice_list->sales_invoice_code }}</b></td>
                                    <td><b>{{ $sales_invoice_list->stock_no }}</b></td>
                                    <td>{{ $sales_invoice_list->agency_name }}</td>
                                    <td>{{ $sales_invoice_list->agency_address }} - {{ $sales_invoice_list->region }}</td>
                                    <td>{{ $sales_invoice_list->transaction_type }}</td>
                                    <td>{{ $sales_invoice_list->payment_type }}</td>
                                    <td>{{ $sales_invoice_list->created_by_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sales_invoice_list->created_at)->toDayDateTimeString() }}</td>
                                    
                                    {{-- <th><button class="btn btn-info btn-block"> <i class="material-icons">search</i> View</button></th> --}}
                                    <th><button class="btn btn-info btn-block"> <i class="material-icons">text_snippet</i> Generate</button></th>
                                    <th>
                                        @if ($sales_invoice_list->is_posted == false)
                                        <button class="btn btn-accent btn-block" wire:click="postToLedger({{ $sales_invoice_list->id }})"> <i class="material-icons">text_snippet</i> Post to CL</button>
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
</div>