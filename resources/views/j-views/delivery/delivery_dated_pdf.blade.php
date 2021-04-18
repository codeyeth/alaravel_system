<table style="page-break-inside:auto">
  <col width="10%">
  <col width="10%">
  <col width="60%">
  <col width="20%">
    <tr style="page-break-inside:avoid; page-break-after:auto" >
      <th width="10%" style="font-size:6px; text-align:left;">
        Specialized<br>
        Delivery<br>
        Receipt<br>
        August 2019
      </th>
      <th width="10%" style="float:right; text-align:left; "> 
        <img src="{{$imagepath}}/shards_template/images/npo.png" height="40px">
      </th>
      <th width="60%" style="text-align:center; font-size:8px">
        Republic of the Philippines<br>
        Presidential Communications Operations Office<br>
        NATIONAL PRINTING OFFICE<br>
        EDSA cor. NIA Northside Road<br>
        Diliman Quezon City<br>
        SALES and MARKETING DIVISION<br>
        <b>DELIVERY RECEIPT</b>
      </th>
      <th width="20%" style="text-align:left; font-size:6px;">
        No. <u>(Sample)20-06-0026 Palawan</u><br>
        @foreach($copy as $copies)
        <input type="checkbox" id="copies{{$copies->id}}" name="copies{{$copies->id}}" value="copies{{$copies->id}}" checked = "checked">
        <label for="copies{{$copies->id}}">{{$copies->copies}}</label><br>
        @endforeach
        </th>
    </tr>
    <tr>
    <th width="100%" style="font-size:8px; text-align:right;">
      <b>{{$value->copies}} Copy</b>
      </th>
    </tr>
 
</table><br><br>
<table style="page-break-inside:auto">

    <tr style="page-break-inside:avoid; page-break-after:auto">
      <th width="20%" style="font-size:8px; text-align:left;">
        DELIVERED TO:<br>
        DESCRIPTION<br><br>
        DATE:
      </th>
      <th width="80%" style="text-align:left; font-size:9px">
        <u>{{$delivered_to}}</u><br>
        <u>{{$description}}</u><br><br>
        <u>From  {{ \Carbon\Carbon::parse($from)->format('d F Y g:i A') }} to  {{ \Carbon\Carbon::parse($to)->format('d F Y g:i A') }} </u>
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
      <th width="10%" style="border:1px solid #000000;">BALLOT ID</th>
      <th width="35%" style="border:1px solid #000000;">CLUSTERED PRECINT </th>
      <th width="40%" style="border:1px solid #000000;">PROVINCE / MUNICIPALITY / BARANGAY</th>
      <th width="15%" style="border:1px solid #000000;">QUANTITY</th>
    </tr>
        @foreach($deliveries as $deliver)
    <tr style="page-break-inside:avoid; page-break-after:auto">
      <td style="border:1px solid #000000; padding:10px; font-size: x-small;">{{$deliver->BALLOT_ID}}</td>
      <td style="border:1px solid #000000; padding:10px;font-size:13px font-weight: bold; font-size: x-small;  ">{{$deliver->CLUSTERED_PREC}}</td>
      <td style="border:1px solid #000000; padding:10px;font-size:18px font-weight: bold; font-size: x-small;">{{$deliver->CITY_MUN_PROV}}</td>
      <td style="border:1px solid #000000; padding:10px; font-size: x-small;">{{$deliver->CLUSTER_TOTAL}}</td>
    </tr>
    @endforeach
    <tr style="page-break-inside:avoid; page-break-after:auto">
      <td colspan="3" style="border:1px solid #000000; padding:10px; font-size: x-small; text-align:left"><b>Total:</b></td>
      <td colspan="3" style="border:1px solid #000000; padding:10px; font-size: x-small;"><b> {{$total_sum}} </b></td>
    </tr>
</table>

<table style="page-break-inside:auto">
<col width="33%">
<col width="34%">
<col width="33%">


<tr style="page-break-inside:avoid; page-break-after:auto">
<th width="33%" style="border:1px solid #000000; font-size:8px; text-align:center;">
Issued by:<br><br>
_________________________<br>
Signature<br>
<b>{{$issued_by->personnel}}</b><br>@if($issued_by->title == 'N/A')&nbsp;@else{{$issued_by->title}}@endif<br><br>
Approved by:<br><br>
_________________________<br>
<b>{{$approved_by->personnel}}</b><br>
@if($approved_by->title == 'N/A')&nbsp;@else{{$approved_by->title}}@endif

</th>
<th width="34%" style="border:1px solid #000000; font-size:8px; text-align:center;">
Received by:<br><br>
_________________________<br>
Signature<br>
<b>{{$received_by->personnel}}</b><br>@if($received_by->title == 'N/A')&nbsp;@else{{$received_by->title}}@endif<br><br>
Name in Print

</th>
<th width="33%" style="border:1px solid #000000; font-size:8px; text-align:center;">
Inspected by:<br><br>
_________________________<br>
Signature<br>
<b>{{$inspected_by->personnel}}</b><br>@if($inspected_by->title == 'N/A')&nbsp;@else{{$inspected_by->title}}@endif<br><br>
Name in Print

</th>
</tr>

<tr style="page-break-inside:avoid; page-break-after:auto">

<td></td>
<td></td>
<td></td>
</tr>

</table><br>
