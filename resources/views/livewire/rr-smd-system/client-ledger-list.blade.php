<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Client Ledger Table (Latest Posted Transactions)</h6>
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
                
                <ul class="list-group list-group-flush" style="overflow-x:auto;">
                    <li class="list-group-item p-0 pb-3 text-center" id="sales_invoice_list">
                        @if (count($clientLedgerList) > 0)
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">#</th>
                                    <th scope="col" class="border-0" style="text-align: left">AGENCY NAME</th>
                                    <th scope="col" class="border-0" style="text-align: right">SALES INVOICE NO</th>
                                    <th scope="col" class="border-0" style="text-align: left">SALES INVOICE DATE</th>
                                    <th scope="col" class="border-0" style="text-align: left">POSTED BY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientLedgerList as $client_ledger_list)
                                <tr>
                                    <td>{{ $client_ledger_list->id }}</td>
                                    @foreach ($clientDatabase as $client_database)
                                    @if ( $client_ledger_list->agency_id ==  $client_database->id )
                                    <td style="text-align: left"><a href="{{ asset ('/client_ledger') }}/{{ $client_database->id }} " target="_blank" title="View Client Ledger">
                                        <b>{{ $client_database->agency_name }}</b></a>
                                    </td>
                                    @break
                                    @endif
                                    @endforeach
                                    <td style="text-align: right"><span class="badge badge-accent">{{ $client_ledger_list->sales_invoice_code }}</span></td>
                                    <td style="text-align: left"><span class="badge badge-accent"> {{ \Carbon\Carbon::parse($client_ledger_list->sales_invoice_created_at)->toDayDateTimeString() }} </span></td>
                                    <td style="text-align: left"><b> {{ $client_ledger_list->created_by_name }} </b> at {{ \Carbon\Carbon::parse($client_ledger_list->created_at)->toDayDateTimeString() }}</td>
                                </tr>      
                                @endforeach 
                            </tbody>
                        </table>    
                        @else
                        <br>
                        <p style="text-align: center">No Client Ledger Record Found.</p>
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