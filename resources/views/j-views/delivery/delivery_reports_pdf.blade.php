<table style="page-break-inside:auto">
    <tr style="page-break-inside:avoid; page-break-after:auto" >
      <th width="10%" style="font-size:6px; text-align:left;">
    
      </th>
      <th width="10%" style="float:right; text-align:left; "> 
       
      </th>
      <th width="60%" style="text-align:center; font-size:8px">
      <h1>BALLOT TRACKING SYSTEM</h1>
      <h2>Delivery Report<br></h2>
      </th>
      <th width="20%" style="text-align:left; font-size:6px;">
    
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
    <th width="100%" style="font-size:8px; text-align:right;">
      <b>{{$value->copies}} Copy</b>
      </th>
    </tr>

    <tr style="page-break-inside:avoid; page-break-after:auto">
      <th width="20%" style="font-size:8px; text-align:left;">
     
        DELIVERED TO:<br>
        TITLE:<br>
        DESCRIPTION<br><br>
        DATE:
      </th>
      <th width="80%" style="text-align:left; font-size:9px">
        <u>{{$var_delivered_to}}</u><br>
        <u>{{$var_downloaded_title}}</u><br>
        <u>{{$var_description}}</u><br><br>
        <u>{{$var_date_to_display}} </u>
      </th> 
    </tr>
    <tr style="page-break-inside:avoid; page-break-after:auto">
      <td></td>
      <td></td>
    </tr>
</table>
<br><br>
<table style="text-align:center;  font-size: x-small; border-collapse:collapse; border:1px solid #000000; page-break-inside:auto">
  <col width="10%">
  <col width="35%">
  <col width="40%">
  <col width="15%">
    <tr style="page-break-inside:avoid; page-break-after:auto">
      <th width="10%" style="border:1px solid #000000;">Ballot Control No.</th>
      <th width="35%" style="border:1px solid #000000;">Poll Location Serial Number</th>
      <th width="40%" style="border:1px solid #000000;">Ballot Delivery Location</th>
      <th width="15%" style="border:1px solid #000000;">Quantity</th>
    </tr>
        @foreach($cloned_query_all_deliveries as $deliver)
    <tr style="page-break-inside:avoid; page-break-after:auto">
      <td style="border:1px solid #000000; padding:10px; font-size: x-small;">{{$deliver->BALLOT_ID}}</td>
      <td style="border:1px solid #000000; padding:10px;font-size:13px font-weight: bold; font-size: x-small;  ">{{$deliver->CLUSTERED_PREC}}</td>
      <td style="border:1px solid #000000; padding:10px;font-size:18px font-weight: bold; font-size: x-small;">{{$deliver->CITY_MUN_PROV}}</td>
      <td style="border:1px solid #000000; padding:10px; font-size: x-small;">{{$deliver->CLUSTER_TOTAL}}</td>
    </tr>
    @endforeach
    <tr style="page-break-inside:avoid; page-break-after:auto">
      <td colspan="3" style="border:1px solid #000000; padding:10px; font-size: x-small; text-align:left"><b>Total:</b></td>
      <td colspan="3" style="border:1px solid #000000; padding:10px; font-size: x-small;"><b> {{$var_total_sum}} </b></td>
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
