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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>REPORTS OF UNCLAIMED SPECIALIZED GOODS</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:7px;"><b>From {{ \Carbon\Carbon::parse($from)->format('F, j') }}-{{ \Carbon\Carbon::parse($to)->format('j Y') }}</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:7px;">(In Philippine Peso)</label><br>
        </th>
    </tr>
</table>

<table>
<tr>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px; "><b>W.O NO.</b></th>
<th width="10%" style="border:0.1px solid #000000; text-align:center;">
<table style="border-collapse:collapse;">
            <tr>
              <th style="border:0.1px solid #000000; font-size:7px;" colspan="2">
              <b>RAF NO./ SI</b>
              </th>
            </tr>
            <tr>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>NUMBER</b></td>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>DATE</b></td>
            </tr>
          </table>
</th>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">AGENCY</th>    
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">PARTICULARS</th>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">AMOUNT</th>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">DATE RECEIVED BY SMD</th>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">QUANTITY</th>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">O.R # W/ TOTAL PAYMENT</th>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">CONTACT #</th>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">REMARKS</th>
</tr>

@foreach($cloned_query as $asd)
<tr>
<th width="10%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->work_order_no}}</th>
<th width="5%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->sales_invoice_code}}</th>
<th width="5%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->date}}</th>

<th width="10%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->agency_name}}</th>
<td width="10%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->item_description}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="10%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->total}}</td>
                  </tr>
            @endforeach
      </table>
</td>

 
<td width="10%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->date}}</td>
<td width="10%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
<table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->quantity}} {{$items->unit}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="10%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
<table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$asd->or_no}} {{$items->total}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="10%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->contact_no}} {{$asd->email}}</td>
<td width="10%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->additional_description}}</td>
</tr>
@endforeach

</table>