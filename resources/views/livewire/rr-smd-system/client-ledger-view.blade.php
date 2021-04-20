<div>
    <h2 style="text-align: center" class="mb-1">
        <strong> SUBSIDIARY LEDGER </strong>
    </h2>
    <h5 style="text-align: center">CLIENT
        {{-- <a href="{{ asset('client_ledger_pdf') }}/{{ $clientDetails->id }}" target="_blank"><i class="material-icons">text_snippet</i></a> --}}
    </h5>
    
    <br>
    
    <h5 class="mb-1"><b>AGENCY NAME:</b> {{ $clientDetails->agency_name }}</h5>
    <h5 class="mb-1"><b>COMPLETE ADDRESS:</b> {{ $clientDetails->agency_address }} - {{ $clientDetails->region }}</h5>
    <h5 class="mb-1"><b>CONTACT DETAILS:</b> {{ $clientDetails->contact_no }} - {{ $clientDetails->contact_person }}</h5>
    
    <hr class="hr_dashed">
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align: center">DATE</th>
                <th style="text-align: center">PO/PR NO.</th>
                <th style="text-align: center">STOCK NO.</th>
                <th style="text-align: center" colspan="2" rowspan="4">SALES INVOICE</th>
                <th style="text-align: center">DESCRIPTION</th>
                <th style="text-align: center">QUANTITY</th>
                <th style="text-align: center">OFFICIAL <br> RECEIPT NO.</th>
                <th style="text-align: center">AMOUNT</th>
                <th style="text-align: center">REMARKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientLedger as $client_ledger_item)
            <tr>
                <td style="text-align: center">{{ \Carbon\Carbon::parse($client_ledger_item->created_at)->toDayDateTimeString() }}</td>
                <td style="text-align: center">{{ $client_ledger_item->pr_no }}</td>
                <td style="text-align: center">{{ $client_ledger_item->stock_no }}</td>
                
                {{-- SALES INVOICE DETAILS --}}
                @foreach ($salesInvoice as $sales_invoice_item)
                @if ( $client_ledger_item->sales_invoice_code == $sales_invoice_item->sales_invoice_code)
                <td style="text-align: center">{{ \Carbon\Carbon::parse($sales_invoice_item->created_at)->toDayDateTimeString() }}</td>
                <td style="text-align: center">{{ $sales_invoice_item->sales_invoice_code }}</td>
                @endif
                @endforeach
                
                {{-- SALES INVOICE ITEMS DETAILS --}}
                <td>
                    @foreach ($salesInvoiceItems as $sales_invoice_item_item)
                    @if($client_ledger_item->sales_invoice_code == $sales_invoice_item_item->sales_invoice_code)
                    <li style="text-align: center;">{{ $sales_invoice_item_item->item_description }}</li>
                    @endif
                    @endforeach
                </td>
                
                <td>
                    @foreach ($salesInvoiceItems as $sales_invoice_item_item)
                    @if($client_ledger_item->sales_invoice_code == $sales_invoice_item_item->sales_invoice_code)
                    <li style="text-align: center;">{{ $sales_invoice_item_item->quantity }}</li>
                    @endif
                    @endforeach
                </td>
                
                <td style="text-align: center">{{ $client_ledger_item->or_no }}</td>
                
                <td style="text-align: center"> 
                    
                    
                    {{ $salesInvoiceItems->where('sales_invoice_code', $client_ledger_item->sales_invoice_code)->sum('total') }}
                    
                    
                </td>
                
                <td style="text-align: center">{{ $client_ledger_item->remarks }}</td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>


{{-- <td style="padding: 0;">
    <table class="table">
        <tbody>
            @foreach ($salesInvoiceItems as $sales_invoice_item_item)
            <tr>
                <td style="text-align: center;">{{ $sales_invoice_item_item->item_description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</td> --}}

{{-- <td style="padding: 0;">
    <table class="table">
        <tbody>
            @foreach ($salesInvoiceItems as $sales_invoice_item_item)
            <tr>
                <td style="text-align: center">{{ $sales_invoice_item_item->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</td> --}}