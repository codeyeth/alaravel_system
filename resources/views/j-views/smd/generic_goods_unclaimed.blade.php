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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>REPORTS OF UNCLAIMED GOODS IN-HOUSE - GENERIC</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:7px;"><b>For the period {{ \Carbon\Carbon::parse($generic_unclaimed_from)->format('F, j') }}-{{ \Carbon\Carbon::parse($generic_unclaimed_to)->format('j Y') }}</b></label><br>
        </th>
    </tr>
</table>
<table>
<tr>
<th width="5%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">NO.</th>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">NAME OF AGENCY</th>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">PARTICULARS</th>
<th width="14%" style="border:0.1px solid #000000; text-align:center;">
<table style="border-collapse:collapse;">
            <tr>
              <th style="border:0.1px solid #000000; font-size:7px;" colspan="2">
              <b>SALES INVOICE</b>
              </th>
            </tr>
            <tr>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>NUMBER</b></td>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>DATE</b></td>
            </tr>
          </table>
</th>
<th width="7%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">QUANTITY</th>
<th width="14%" style="border:0.1px solid #000000; text-align:center;">
<table style="border-collapse:collapse;">
            <tr>
              <th style="border:0.1px solid #000000; font-size:7px;" colspan="2">
              <b>CLAIMED</b>
              </th>
            </tr>
            <tr>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>QUANTITY</b></td>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>AMOUNT</b></td>
            </tr>
          </table>
</th>
<th width="15%" style="border:0.1px solid #000000; text-align:center;">
<table style="border-collapse:collapse;">
            <tr>
              <th style="border:0.1px solid #000000; font-size:7px;" colspan="3">
              <b>O.R</b>
              </th>
            </tr>
            <tr>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>DATE</b></td>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>NUMBER</b></td>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>AMOUNT</b></td>
            </tr>
          </table>
</th>
<th width="14%" style="border:0.1px solid #000000; text-align:center;">
<table style="border-collapse:collapse;">
            <tr>
              <th style="border:0.1px solid #000000; font-size:7px;" colspan="2">
              <b>DELIVERY RECEIPT</b>
              </th>
            </tr>
            <tr>
            <td style=" border:0.1px solid #000000; font-size:6px; text-align:center;"><b>NUMBER</b></td>
            <td style=" border:0.1px solid #000000; font-size:6px; text-align:center;"><b>DATE</b></td>
            </tr>
          </table>
</th>
<th width="11%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">CONTACT DETAILS</th>
</tr>
@foreach($cloned_query as $asd)
<tr>
<td width="5%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px;"></td>
<td width="10%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->agency_name}}</td>
<td width="10%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->item_description}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->sales_invoice_code}}</td>
<td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->date}}</td>
<td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">
<table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                 <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->quantity}} {{$items->unit}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">
<table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                        <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->quantity}} {{$items->unit}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">
<table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                        <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;"> {{$items->total}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="5%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">
<table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                        <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;"> {{$items->created_at}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="5%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->or_no}}</td>
<td width="5%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">
<table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
                        <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;"> {{$items->total}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->dr_no}}</td>
<td width="7%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->is_delivered_at}}</td>
<td width="11%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px;">{{$asd->contact_no}} {{$asd->email}}</td>
</tr>
@endforeach
</table>

