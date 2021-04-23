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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>DAILY SALES REPORT - SPECIALIZED</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>ACCOUNTABLE AND NON-ACCOUNTABLE FORMS</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>{{ \Carbon\Carbon::parse($daily_query->first()->created_at)->format('F, Y') }}</b></label><br>
        </th>
    </tr>
    @foreach($daily_query as $items)
    <tr>
    <th width="100%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>CLIENT</b></th>
    </tr>
    <tr>
        <th width="20%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;">
        <table style="border-collapse:collapse;">
            <tr>
              <th colspan="2">
              <b>SALES INVOICE</b>
              </th>
            </tr>
            <tr>
            <td  style="text-align:left;"><b>DATE</b></td>
            <td  style="text-align:right;"><b>NUMBER</b></td>
            </tr>
          </table>
        </th> 
        <th width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>W.O NO.</b></th> 
        <th width="10%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>REGION</b></th>
        <th width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>AGENCY</b></th>  
        <th width="30%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">
        <table style="border-collapse:collapse;">
            <tr>
              <th colspan="3">
              <b>O.R</b>
              </th>
            </tr>
            <tr>
            <td  style="text-align:left;"><b>AMOUNT</b></td>
            <td  style="text-align:center;"><b>DATE</b></td>
            <td  style="text-align:right;"><b>NUMBER</b></td>
            </tr>
          </table>
        </th>   
        <th width="20%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;">
        <table style="border-collapse:collapse;">
            <tr>
              <th colspan="2">
              <b>DELIVERY</b>
              </th>
            </tr>
            <tr>
            <td style="text-align:left;"><b>NUMBER</b></td>
            <td style="text-align:right;"><b>DATE</b></td>
            </tr>
          </table>
        </th>
    </tr>
    <tr>

        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{ \Carbon\Carbon::parse($items->created_at)->toDateString() }}</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->sales_invoice_code}}</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->work_order_no}}</td>
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->region}}</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->agency_name}}</td>
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">total here</td>
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->is_posted_at}}</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->or_no}}</td>
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->dr_no}}</td>
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->is_delivered_at}}</td>
    </tr>
    <tr>
    <th width="100%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>TRANSACTION</b></th>
    </tr>
    <tr>
    <th width="10%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>QUANTITY</b></th>
    <th width="20%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>JOB TITLE</b></th>
    <th width="20%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;">
    <table style="border-collapse:collapse;">
            <tr>
              <th colspan="2">
              <b>ACCOUNNTABLE FORM</b>
              </th>
            </tr>
            <tr>
            <td><b>CASH</b></td>
            <td><b>ON ACCOUNT</b></td>
            </tr>
          </table>
        </th> 
        <th width="20%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;">
        <table>
            <tr>
              <th colspan="2">
              <b>NON ACCOUNNTABLE FORM</b>
              </th>
            </tr>
            <tr>
            <td><b>CASH</b></td>
            <td><b>ON ACCOUNT</b></td>
            </tr>
          </table>
    </th>
    <th width="20%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;">
        <table>
            <tr>
              <th colspan="2">
              <b>STANDARD FORM</b>
              </th>
            </tr>
            <tr>
            <td><b>CASH</b></td>
            <td><b>ON ACCOUNT</b></td>
            </tr>
          </table>
    </th>
    <th width="10%"  style="border:0.1px solid #000000; font-size:7px; text-align:center;"><b>TOTAL</b></th>
    </tr>
    @foreach($items->sales_invoice_items as $asd) 
    <tr>
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->quantity}}</td> 
        <td width="20%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->item_description}}</td>
        @if($asd->form_type == 'AF')
            @if($items->payment_mode == 'CASH')
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->total}}</td> 
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"></td> 
            @else
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"></td> 
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->total}}</td> 
            @endif
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        @elseif($asd->form_type == 'NAF')
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
            @if($items->payment_mode == 'CASH')
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->total}}</td> 
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"></td> 
            @else
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"></td> 
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->total}}</td> 
            @endif
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        @else
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
            @if($items->payment_mode == 'CASH')
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->total}}</td> 
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"></td> 
            @else
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"></td> 
            <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$asd->total}}</td> 
            @endif
        @endif
        <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">---</td> 
    </tr>
    @endforeach
    <tr>
      <td width="30%" style="border:0.1px solid #000000; font-size:7px; text-align:center;"></td>
      <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">
      @php
      $total_af = App\Models\SalesInvoiceItem::where('sales_invoice_code',$asd->sales_invoice_code)->where('form_type','AF')->get()
      @endphp
        {{ $total_af->sum('total')}}
      </td>
      <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">
      @php
      $total_af = App\Models\SalesInvoiceItem::where('sales_invoice_code',$asd->sales_invoice_code)->where('form_type','AF')->get()
      @endphp
        {{ $total_af->sum('total')}}
      </td>
      <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">
      @php
      $total_naf = App\Models\SalesInvoiceItem::where('sales_invoice_code',$asd->sales_invoice_code)->where('form_type','NAF')->get()
      @endphp
        {{ $total_naf->sum('total')}}
      </td>
      <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">
      @php
      $total_naf = App\Models\SalesInvoiceItem::where('sales_invoice_code',$asd->sales_invoice_code)->where('form_type','NAF')->get()
      @endphp
        {{ $total_af->sum('total')}}
      </td>
      <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">
      @php
      $total_sf = App\Models\SalesInvoiceItem::where('sales_invoice_code',$asd->sales_invoice_code)->where('form_type','SF')->get()
      @endphp
        {{ $total_sf->sum('total')}}
      </td>
      <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">
      @php
      $total_sf = App\Models\SalesInvoiceItem::where('sales_invoice_code',$asd->sales_invoice_code)->where('form_type','SF')->get()
      @endphp
        {{ $total_sf->sum('total')}}
      </td>
      <td width="10%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">{{$items->sales_invoice_items->sum('total')}}</td>
    </tr>
    <br>
    @endforeach
    <tr>
    <th width="30%" style="border:0.1px solid #000000; font-size:9px; text-align:center;"></th>
    <th width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">Total Accountable Form Cash Amount</th>
    <th width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">Total Accountable Form On Account Amount</th>
    <th width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">Total Non-Accountable Form Cash Amount</th>
    <th width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">Total Non-Accountable Form On Account Amount</th>
    <th width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">Total Standard Form Cash Amount</th>
    <th width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">Total Standard Form On Account Amount</th>
    <th width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">Total Amount for Specialized on this Day</th>
    </tr>
    <tr>
    <td width="30%" style="border:0.1px solid #000000; font-size:9px; text-align:center;"></td>
    <td width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">{{(clone $data)->where('form_type','AF')->where('payment_mode','CASH')->sum('total')}}</td>
    <td width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">{{(clone $data)->where('form_type','AF')->where('payment_mode','!=','CASH')->sum('total')}}</td>
    <td width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">{{(clone $data)->where('form_type','NAF')->where('payment_mode','CASH')->sum('total')}}</td>
    <td width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">{{(clone $data)->where('form_type','NAF')->where('payment_mode','!=','CASH')->sum('total')}}</td>
    <td width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">{{(clone $data)->where('form_type','SF')->where('payment_mode','CASH')->sum('total')}}</td>
    <td width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">{{(clone $data)->where('form_type','SF')->where('payment_mode','!=','CASH')->sum('total')}}</td>
    <td width="10%" style="border:0.1px solid #000000; font-size:9px; text-align:center;">{{(clone $data)->sum('total')}}</td>
 </tr>
</table>