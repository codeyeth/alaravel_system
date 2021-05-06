<table style="border-collapse:collapse;">
    <tr>
  <th width="35%" style="font-size:6px; text-align:left;">
      &nbsp;
 </th>
      <th width="5%" style="float:right"> 
        <img src="{{$imagepath}}/shards_template/images/npo.png" height="40px">
      </th>
      <th width="60%" style="text-align:left; font-size:9px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-family:Times;">Republic of the Philippines</label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presidential Communications Operations Office<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-family:Times; font-size:10px;">NATIONAL PRINTING OFFICE</label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>SALES and MARKETING DIVISION </b><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>DAILY SALES REPORT - GENERIC</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>ACCOUNTABLE AND NON-ACCOUNTABLE FORMS</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>{{ \Carbon\Carbon::parse($generic_daily_date)->format('F, Y') }}</b></label><br>
        </th>
    </tr>
    @foreach($daily_query as $items)
    <tr>
    <th width="100%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>CLIENT</b></th>
    </tr>
    <tr>
        <th width="7%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>DATE</b></th>
        <th width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>SI NO.</b></th> 
        <th width="7%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>P.O./P.R #</b></th>
        <th width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>STOCK NO.</b></th>   
        <th width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>REGION</b></th>  
        <th width="7%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>WALKIN EMAIL</b></th>
        <th width="7%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>CODE</b></th>
        <th width="11%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>REQUISITIONER</b></th> 
        <th width="12%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>ADDRESS</b></th>   
        <th width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>CONTACT NO. EMAIL</b></th>  
        <th width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>OR NO</b></th>   
        <th width="7%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>DR NO.</b></th>
        <th width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>REMARKS</b></th>    
    </tr>
    <tr>
        <td width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{ \Carbon\Carbon::parse($items->created_at)->toDateString() }}</td>
        <td width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->sales_invoice_code}}</td>
        <td width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->pr_no}}</td> 
        <td width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->stock_no}}</td>
        <td width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->region}}</td>
        <td width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->transaction_type}}</td> 
        <td width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->code}}</td>
        <td width="11%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->agency_name}}</td>
        <td width="12%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->agency_address}}</td>
        <td width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->contact_no}} {{$items->email}}</td> 
        <td width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->or_no}}</td>
        <td width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->dr_no}}</td> 
        <td width="7%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">remarks here</td>
    </tr>
    <tr>
    <th width="100%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>TRANSACTION</b></th>
    </tr>
    <tr>
    <th width="10%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>Quantity</b></th>
    <th width="10%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>Unit</b></th>
    <th width="17%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>Item Description</b></th>
    <th width="17%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>Details</b></th>
    <th width="18%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;">
    <table style="border-collapse:collapse;">
            <tr>
              <th colspan="2">
              <b>AF</b>
              </th>
            </tr>
            <tr>
            <td><b>UP</b></td>
            <td><b>AMOUNT</b></td>
            </tr>
          </table>
        </th> 
        <th width="18%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;">
        <table>
            <tr>
              <th colspan="2">
              <b>NAF</b>
              </th>
            </tr>
            <tr>
            <td><b>UP</b></td>
            <td><b>AMOUNT</b></td>
            </tr>
          </table>
    </th>
    <th width="10%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>TOTAL</b></th>
    </tr>
    @foreach($items->sales_invoice_items as $asd) 
    <tr>
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->quantity}}</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->unit}}</td> 
        <td width="17%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->item_description}}</td> 
        <td width="17%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->additional_description}}</td> 
        @if($asd->form_type == 'AF')
        <td width="9%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->price}}</td> 
        <td width="9%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->total}}</td> 
        <td width="9%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        <td width="9%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        @else
        <td width="9%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        <td width="9%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        <td width="9%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->price}}</td> 
        <td width="9%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->total}}</td> 
        @endif
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
    </tr>
    @endforeach
    <tr>
      <td width="63%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"></td>
      <td width="9%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">
      @php
      $total_af = App\Models\SalesInvoiceItem::where('sales_invoice_code',$asd->sales_invoice_code)->where('form_type','AF')->get()
      @endphp
        {{ $total_af->sum('total')}}
      </td>
      <td width="9%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"></td>
      <td width="9%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">
      @php
      $total_naf = App\Models\SalesInvoiceItem::where('sales_invoice_code',$asd->sales_invoice_code)->where('form_type','NAF')->get()
      @endphp
      {{ $total_naf->sum('total')}}
      </td>
      <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->sales_invoice_items->sum('total')}}</td>
    </tr>
    <br>
    @endforeach
    <tr>
    <th width="63%" style="border:0.1px solid #000000; font-size:9px; text-align:center;"></th>
    <th width="9%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">Total Accountable Form Amount</th>
    <th width="9%" style="border:0.1px solid #000000; font-size:9px; text-align:center;"></th>
    <th width="9%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">Total Non-Accountable Form Amount</th>
    <th width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">Total Amount for this Day</th>
    </tr>
    <tr>
    <td width="63%" style="border:0.1px solid #000000; font-size:9px; text-align:center;"></td>
    <td width="9%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">{{(clone $data)->where('form_type','AF')->sum('total')}}</td>
    <td width="9%" style="border:0.1px solid #000000; font-size:9px; text-align:center;"></td>
    <td width="9%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">{{(clone $data)->where('form_type','NAF')->sum('total')}}</td>
    <td width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">{{(clone $data)->sum('total')}}</td>
 </tr>
</table>