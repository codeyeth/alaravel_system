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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>{{ \Carbon\Carbon::parse($generic_daily_date)->format('F, d Y') }}</b></label><br>
        </th>
    </tr>
 </table>

 <table>
 <tr>
 <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Date</th>
 <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">P.O./P.R. #</th>
 <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Stock #</th>
 <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">S.I. #</th>
 <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">REGION</th>
 <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Transanction Type</th>
 <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Code</th>
 <th width="6%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Requisitioner</th>
 <th width="6%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Address</th>
 <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Contact/Email</th>
 <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Unit</th>
 <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Qty</th>
 <th width="6%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Description</th>
 <th width="6%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">
 <table style="border-collapse:collapse;">
            <tr>
              <th style="font-size:7px;" colspan="2">
              <b>AF</b>
              </th>
            </tr>
            <tr>
            <td style="font-size:6px; text-align:left;"><b>UP</b></td>
            <td style="font-size:6px; text-align:right;"><b>Amount</b></td>
            </tr>
          </table>
  </th>
  <th width="6%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">
 <table style="border-collapse:collapse;">
            <tr>
              <th style="font-size:7px;" colspan="2">
              <b>NAF</b>
              </th>
            </tr>
            <tr>
            <td style="font-size:6px; text-align:left;"><b>UP</b></td>
            <td style="font-size:6px; text-align:right;"><b>Amount</b></td>
            </tr>
          </table>
  </th>
  <th width="6%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Total</th>
  <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Serial #</th>
  <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">OR #</th>
  <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Date</th>
  <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Amount</th>
  <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">DR #</th>
  <th width="4%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Remarks</th>
 </tr>
 @foreach($data as $asd)
 <tr>
 <td width="4%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->date}}</td>
 <td width="4%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->pr_no}}</td>
 <td width="4%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->stock_no}}</td>
 <td width="4%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->sales_invoice_code}}</td>
 <td width="4%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->region}}</td>
 <td width="4%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->transaction_type}}</td>
 <td width="4%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->code}}</td>
 <td width="6%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->agency_name}}</td>
 <td width="6%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->agency_address}}</td>
 <td width="4%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->contact_no}} {{$asd->email}}</td>
 <td width="4%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->unit}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="4%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->quantity}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="6%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->item_description}}</td>
                  </tr>
            @endforeach
      </table>
</td>


<td width="3%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
      @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                      <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">
                   
                        @if($items->form_type == 'AF')
                          {{$items->price}}
                        @endif
                    
                      </td>
                  </tr>
                  @endforeach
         
      </table>
</td>
<td width="3%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
      @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                      <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">
                      
                        @if($items->form_type == 'AF')
                          {{$items->total}}
                        @endif
                 
                      </td>
                  </tr>
                  @endforeach
        
      </table>
</td>


<td width="3%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
      @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                  <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">
              
                        @if($items->form_type == 'NAF')
                          {{$items->price}}
                        @endif
                 
                      </td>
                  </tr>
                  @endforeach
      
      </table>
</td>
<td width="3%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
      @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                  <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">
                 
                        @if($items->form_type == 'NAF')
                          {{$items->total}}
                        @endif
                     
                      </td>
                  </tr>
                  @endforeach
      </table>
</td>

<td width="6%" style="border:0.1px solid #000000; font-size:7px; text-align:center;">                 
                        @php
                        $total_af = App\Models\SalesInvoiceItem::where('sales_invoice_code',$asd->sales_invoice_code)->get()
                        @endphp
                          {{ $total_af->sum('total')}}
     
</td>
<td width="4%" style="height:25px; border:0.1px solid #000000; font-size:7px; text-align:center;"> 
{{$asd->sales_invoice_code}}
</td>
<td width="4%" style="height:25px; border:0.1px solid #000000; font-size:7px; text-align:center;">  
{{$asd->or_no}}
</td>
<td width="4%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->date}}</td>
<td width="4%" style="height:25px; border:0.1px solid #000000; font-size:7px; text-align:center;"> 
@php
                        $total_af = App\Models\SalesInvoiceItem::where('sales_invoice_code',$asd->sales_invoice_code)->get()
                        @endphp
                          {{ $total_af->sum('total')}}
</td>
<td width="4%" style="height:25px; border:0.1px solid #000000; font-size:7px; text-align:center;">  
{{$asd->dr_no}} 
</td>
<td width="4%" style="height:25px; border:0.1px solid #000000; font-size:7px; text-align:center;">  
{{$asd->additional_description}} 
</td>




































 </tr>
@endforeach

 </table>