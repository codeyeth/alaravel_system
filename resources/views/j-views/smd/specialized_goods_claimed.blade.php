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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>REPORTS OF SPECIALIZED CLAIMED GOODS</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:7px;"><b>From {{ \Carbon\Carbon::parse($specialized_claimed_from)->format('F, j') }}-{{ \Carbon\Carbon::parse($specialized_claimed_to)->format('j Y') }}</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:7px;">(In Philippine Peso)</label><br>
        </th>
    </tr>
</table>

<table>
<tr>
<th width="10%" style="border:0.1px solid #000000; text-align:center;">
<table style="border-collapse:collapse;">
            <tr>
              <th style="border:0.1px solid #000000; font-size:7px;" colspan="2">
              <b>RAF NO./ SI</b>
              </th>
            </tr>
            <tr>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>DATE</b></td>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>NUMBER</b></td>
            </tr>
          </table>
</th>
<th width="5%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">W.O NO.</th>
<th width="5%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">QTY</th>
<th width="5%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">REGION</th>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">AGENCY</th>
<th width="10%" style="border:0.1px solid #000000; text-align:center; font-size:6px; ">JOB TITLE</th>
<th width="14%" style="border:0.1px solid #000000; text-align:center;">
<table style="border-collapse:collapse;">
            <tr>
              <th style="border:0.1px solid #000000; font-size:7px;" colspan="2">
              <b>ACCOUNTABLE FORM</b>
              </th>
            </tr>
            <tr>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>CASH</b></td>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>ON ACCT.</b></td>
            </tr>
          </table>
</th>
<th width="14%" style="border:0.1px solid #000000; text-align:center;">
<table style="border-collapse:collapse;">
            <tr>
              <th style="border:0.1px solid #000000; font-size:7px;" colspan="2">
              <b>STANDARD FORM</b>
              </th>
            </tr>
            <tr>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>CASH</b></td>
            <td style="border:0.1px solid #000000; font-size:6px; text-align:center;"><b>ON ACCT.</b></td>
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
<th width="12%" style="border:0.1px solid #000000; text-align:center;">
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
</tr>
@foreach($cloned_query as $asd)
<tr>
<th width="5%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->date}}</th>
<th width="5%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->sales_invoice_code}}</th>
<th width="5%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->work_order_no}}</th>
<td width="5%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->quantity}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<th width="5%" style="height:25px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->region}}</th>
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
@foreach($asd->sales_invoice_items as $item) 
@if($items->form_type == 'AF')
@if($asd->payment_mode == 'CASH')
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->total}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
           
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;"></td>
                  </tr>
       
      </table>
</td>
@else
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
           
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;"></td>
                  </tr>
       
      </table>
</td>
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->total}}</td>
                  </tr>
            @endforeach
      </table>
</td>
@endif
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
           
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;"></td>
                  </tr>
       
      </table>
</td>
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
           
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;"></td>
                  </tr>
   
      </table>
</td>
@else
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
           
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;"></td>
                  </tr>
       
      </table>
</td>
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
           
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;"></td>
                  </tr>
   
      </table>
</td>
@if($asd->payment_mode == 'CASH')
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->total}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
           
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;"></td>
                  </tr>
       
      </table>
</td>
@else
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
           
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;"></td>
                  </tr>
       
      </table>
</td>
<td width="7%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->total}}</td>
                  </tr>
            @endforeach
      </table>
</td>
@endif
@endif
@endforeach 
<td width="5%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
      <table style="border-collapse:collapse;">
            @foreach($asd->sales_invoice_items as $items) 
                  <tr>
               <td style="height:25px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$items->total}}</td>
                  </tr>
            @endforeach
      </table>
</td>
<td width="5%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->or_no}}</td>
<td width="5%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->date}}</td>
<td width="6%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->dr_no}}</td>
<td width="6%" style="height:25px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$asd->is_delivered_at}}</td>
</tr>
@endforeach

</table>