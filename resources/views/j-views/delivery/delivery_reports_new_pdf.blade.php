<table style="page-break-inside:auto">
    <tr style="page-break-inside:avoid; page-break-after:auto" >
      <th width="10%" style="font-size:6px; text-align:left;">
    
      </th>
      <th width="10%" style="float:right; text-align:left; "> 
      <img src="{{$var_imagepath}}/shards_template/images/logo.png" height="60px">
      </th>
      <th width="60%" style="text-align:center; font-size:8px">
      <h1>PRINTING COMPANY</h1>
      <h2>Delivery Report<br></h2>
      From Date of {{ \Carbon\Carbon::parse($new_var_monthly_dr_from)->format('F, d Y') }} To {{ \Carbon\Carbon::parse($new_var_monthly_dr_to)->format('F, d Y') }}<br>
      </th>
      <th width="20%" style="text-align:left; font-size:8px;">
      <b>{{$value->copies}} Copy</b>
        </th>
    </tr>

  
 <br><br>
</table><br>

<table style="page-break-inside:auto">
<hr>
</table>

<table style="page-break-inside:auto">

<tr>
<br>
    <th width="100%" style="font-size:10px; text-align:right;">
 
      </th>
    </tr>


 

</table>
<br><br>








<table>
 <tr>
 <th width="15%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">DR No.</th>
 <th width="15%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Company Name</th>
 <th width="15%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Company Address</th>
 <th width="15%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">Contact</th>
 <th width="40%" style="border:0.1px solid #000000; text-align:center; font-size:6px;">
 <table style="border-collapse:collapse;">
            <tr>
              <th style="font-size:7px;" colspan="4">
              <b>Items</b>
              </th>
            </tr>
            <tr>
     <th style="border:0.1px solid #000000; text-align:center; font-size:6px;">Ballot Control No.</th>
      <th style="border:0.1px solid #000000; text-align:center; font-size:6px;">Unit</th>
      <th style="border:0.1px solid #000000; text-align:center; font-size:6px;">Description</th>
      <th style="border:0.1px solid #000000; text-align:center; font-size:6px;">Quantity</th>
            </tr>
          </table>
  </th>

 </tr>
 @foreach($cloned_query_all_deliveries as $comp)
 <tr>
 <td width="15%" style="height:30px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$comp->DR_NO}}</td>
 <td width="15%" style="height:30px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$comp->company}}</td>
 <td width="15%" style="height:30px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$comp->address}}</td>
 <td width="15%" style="height:30px; border:0.1px solid #000000; text-align:center; font-size:6px; ">{{$comp->contact}}</td>
 <td width="40%" style="height:30px; height:100%; border:0.1px solid #000000; text-align:center; font-size:6px; ">
     
      <table style="border-collapse:collapse;">
                        
      @foreach($comp->deliveries as $item)
                  <tr>
               <td style="height:30px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$item->BALLOT_ID}}</td>
               <td style="height:30px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$item->CITY_MUN_PROV}}</td>
               <td style="height:30px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$item->description}}</td>
               <td style="height:30px; border-top: 0.1px solid #000000; border-bottom: none;  font-size:6px; text-align: center;">{{$item->CLUSTER_TOTAL}}</td>
                  </tr>
               @endforeach
                  
      
      </table>
</td>

              
   

 </tr>
 @endforeach
 <tr>
 <td colspan="4" style="height:15px; border:0.1px solid #000000; text-align:left; font-size:10px; "><b>Total</b></td>
 <td style="height:15px; border:0.1px solid #000000; text-align:center; font-size:10px; "><b>{{$item->sum('CLUSTER_TOTAL')}}</b> </td>
 </tr>


 </table>























<table style="page-break-inside:auto">
<col width="33%">
<col width="34%">
<col width="33%">

<br><br><br>
<tr style="page-break-inside:avoid; page-break-after:auto">
<th width="33%" style=" font-size:8px; text-align:center;">
Issued by:<br><br>
_________________________<br>
Signature<br>
<b>{{$var_issued_by->personnel}}</b><br>@if($var_issued_by->title == 'N/A')&nbsp;@else{{$var_issued_by->title}}@endif<br><br>
Approved by:<br><br>
_________________________<br>
<b>{{$var_approved_by->personnel}}</b><br>
@if($var_approved_by->title == 'N/A')&nbsp;@else{{$var_approved_by->title}}@endif

</th>
<th width="34%" style="font-size:8px; text-align:center;">
Received by:<br><br>
_________________________<br>
Signature<br>
<b>{{$var_received_by->personnel}}</b><br>@if($var_received_by->title == 'N/A')&nbsp;@else{{$var_received_by->title}}@endif<br><br>
Name in Print

</th>
<th width="33%" style=" font-size:8px; text-align:center;">
Inspected by:<br><br>
_________________________<br>
Signature<br>
<b>{{$var_inspected_by->personnel}}</b><br>@if($var_inspected_by->title == 'N/A')&nbsp;@else{{$var_inspected_by->title}}@endif<br><br>
Name in Print

</th>
</tr>

<tr style="page-break-inside:avoid; page-break-after:auto">

<td></td>
<td></td>
<td></td>
</tr>

</table><br>
