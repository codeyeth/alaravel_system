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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>{{ \Carbon\Carbon::parse($specialized_daily_date)->format('F,d Y') }}</b></label><br>
        </th>
    </tr>
</table>
<table>
<tr>
<th width="14%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">
  <table style="border-collapse:collapse;">
            <tr>
              <th style="font-size:7px;" colspan="2">
              <b>SALES INVOICE</b>
              </th>
            </tr>
            <tr>
            <td style="font-size:6px; text-align:left;"><b>DATE</b></td>
            <td style="font-size:6px; text-align:right;"><b>NUMBER</b></td>
            </tr>
          </table>
</th>
<th width="7%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">W.O #</th>
 <th width="7%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">QTY</th>
 <th width="7%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">REGION</th>
 <th width="7%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">AGENCY</th>
 <th width="7%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">JOB TITLE</th>

 <th width="12%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">
 <table style="border-collapse:collapse;">
            <tr>
              <th style="font-size:7px;" colspan="2">
              <b>ACCOUNTABLE FORM</b>
              </th>
            </tr>
            <tr>
            <td style="font-size:6px; text-align:left;"><b>CASH</b></td>
            <td style="font-size:6px; text-align:right;"><b>ON ACCT</b></td>
            </tr>
          </table>
 </th>
 <th width="12%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">
 <table style="border-collapse:collapse;">
            <tr>
              <th style="font-size:7px;" colspan="2">
              <b>STANDARD FORM</b>
              </th>
            </tr>
            <tr>
            <td style="font-size:6px; text-align:left;"><b>CASH</b></td>
            <td style="font-size:6px; text-align:right;"><b>ON ACCT</b></td>
            </tr>
          </table>
 </th>

 <th width="15%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">
 <table style="border-collapse:collapse;">
            <tr>
              <th style="font-size:7px;" colspan="3">
              <b>O.R</b>
              </th>
            </tr>
            <tr>
            <td style="font-size:6px; text-align:left;"><b>AMOUNT</b></td>
            <td style="font-size:6px; text-align:center;"><b>DATE</b></td>
            <td style="font-size:6px; text-align:right;"><b>NUMBER</b></td>
            </tr>
          </table>
 </th>

 
 <th width="12%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">
 <table style="border-collapse:collapse;">
            <tr>
              <th style="font-size:7px;" colspan="2">
              <b>DELIVERY</b>
              </th>
            </tr>
            <tr>
            <td style="font-size:6px; text-align:left;"><b>NUMBER</b></td>
            <td style="font-size:6px; text-align:right;"><b>DATE</b></td>
          
            </tr>
          </table>
 </th>
</tr>
@foreach($data as $asd)
<tr>
<td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->date}}</td>
 <td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->sales_invoice_code}}</td>
 <td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->work_order_no}}</td>
 <td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->quantity}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->region}}</td>
<td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->agency_name}}</td>
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->item_description}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="6%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
      @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                      <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">
                        @if($items->form_type == 'AF')
                            @if($asd->payment_mode == 'CASH')
                          {{$items->total}}
                            @endif
                        @endif
                    
                      </td>
                  </tr>
                  @endforeach
         
      </table>
</td>
<td width="6%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
      @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                      <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">
                        @if($items->form_type == 'AF')
                            @if($asd->payment_mode != 'CASH')
                          {{$items->total}}
                            @endif
                        @endif
                    
                      </td>
                  </tr>
                  @endforeach
         
      </table>
</td>
<td width="6%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
      @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                      <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">
                        @if($items->form_type != 'AF')
                            @if($asd->payment_mode == 'CASH')
                          {{$items->total}}
                            @endif
                        @endif
                    
                      </td>
                  </tr>
                  @endforeach
         
      </table>
</td>
<td width="6%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
      @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                      <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">
                        @if($items->form_type != 'AF')
                            @if($asd->payment_mode != 'CASH')
                          {{$items->total}}
                            @endif
                        @endif
                    
                      </td>
                  </tr>
                  @endforeach
         
      </table>
</td>
<td width="5%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
<table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->total}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="5%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->date}}</td>
<td width="5%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->or_no}}</td>
<td width="6%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->dr_no}}</td>
<td width="6%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->date}}</td>

</tr>
@endforeach

















</table>