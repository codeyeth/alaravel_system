<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Client Ledger Table</h6>
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
                                    Total of <b class="text-success" style="font-size: 120%;"> {{ $clientLedgerListCount }} </b> Result/s Found
                                </div>
                            </div>
                        </div>
                        
                        @if ($keywordMode == true)
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg mb-0" type="text" placeholder="Search" wire:model="searchClientLedger" value="{{ $keywordMode }}">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-12 col-sm-12">
                            <div class="input-group mb-1">
                                <input class="form-control form-control-lg mb-0" type="date" placeholder="Search" wire:model="searchClientLedger">
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
                        @if (count($clientLedgerList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0">AGENCY NAME</th>
                                    <th scope="col" class="border-0">DATE POSTED</th>
                                    <th scope="col" class="border-0">POSTED BY</th>
                                    <th scope="col" class="border-0">PO/PR NO</th>
                                    <th scope="col" class="border-0">STOCK NO</th>
                                    <th scope="col" class="border-0">S.I DATE</th>
                                    <th scope="col" class="border-0">S.I NO</th>
                                    {{-- <th scope="col" class="border-0">DESCRIPTION - QTY</th> --}}
                                    <th scope="col" class="border-0">OR NO.</th>
                                    <th scope="col" class="border-0">AMOUNT</th>
                                    <th scope="col" class="border-0">DESCRIPTION</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientLedgerList as $client_ledger_list)
                                <tr>
                                    <td>{{ $client_ledger_list->id }}</td>
                                    
                                    @foreach ($clientDatabase as $client_database)
                                    @if ( $client_ledger_list->agency_id ==  $client_database->id )
                                    <td><b>{{ $client_database->agency_name }}</b></td>
                                    @break
                                    @endif
                                    @endforeach
                                    
                                    <td>{{ \Carbon\Carbon::parse($client_ledger_list->created_at)->toDayDateTimeString() }}</td>
                                    <td><b> {{ $client_ledger_list->created_by_name }} </b></td>
                                    
                                    <td><b>{{ $client_ledger_list->pr_no }}</b></td>
                                    <td><b>{{ $client_ledger_list->stock_no }}</b></td>
                                    <td>{{ \Carbon\Carbon::parse($client_ledger_list->sales_invoice_created_at)->toDayDateTimeString() }}</td>
                                    <td><b>{{ $client_ledger_list->sales_invoice_code }}</b></td>
                                    
                                    {{-- <td>
                                        <table class="table table-bordered">
                                            @foreach ($salesInvoiceItems as $sales_invoice_item)
                                            @if ( $client_ledger_list->sales_invoice_code ==  $sales_invoice_item->sales_invoice_code )
                                            <tr>
                                                <td><b>{{ $sales_invoice_item->item_description }}</b></td>
                                                <td><b>{{ $sales_invoice_item->quantity }}</b></td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </table>
                                    </td> --}}
                                    
                                    <td>{{ $client_ledger_list->or_no }}</td>
                                    <td>{{ $client_ledger_list->or_no }}</td>
                                    <td>{{ $client_ledger_list->remarks }}</td>
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
        {{ $clientLedgerList->links() }}
    </div>
</div>