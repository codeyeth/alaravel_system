<table style="">
<col width="10%">
<col width="10%">
<col width="60%">
<col width="20%">
<tr>
<th width="10%" style="font-size:6px; text-align:left;">Specialized Delivery<br>Receipt<br>August 2019

</th>
<th width="10%" style="float:right; text-align:left; ">
<img src="{{$imagepath}}/shards_template/images/npo.png" height="40px">
</th>
<th width="60%" style="text-align:center; font-size:8px">Republic of the Philippines<br>
                Presidential Communications Operations Office<br>
                NATIONAL PRINTING OFFICE<br>
                EDSA cor. NIA Northside Road<br>
                Diliman Quezon City<br>
                SALES and MARKETING DIVISION<br>
                <b>DELIVERY RECEIPT</b>

</th>
<th width="20%" style="text-align:left; font-size:8px;">No. <u>20-06-0026 Palawan</u></th>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</table><br>

<table>
<col width="20%">
<col width="80%">
<tr>

<th width="20%" style="font-size:9px; text-align:left;">DELIVERED TO:
</th>
<th width="80%" style="text-align:left; font-size:9px">Republic of the Philippines<br>
</th>
</tr>


<tr>

<th width="20%" style="font-size:9px; text-align:left;">DESCRIPTION
</th>
<th width="80%" style="text-align:left; font-size:9px">Republic of the Philippines<br>

</th>
</tr>
<tr>
<td></td>
<td></td>
</tr>
</table>
<br><br>

<table style="text-align:center;  font-size: x-small; border-collapse:collapse; border:1px solid #000000;">
<col width="10%">
<col width="35%">
<col width="40%">
<col width="15%">
<tr>
<th width="10%" style="border:1px solid #000000;">BALLOT ID</th>
<th width="35%" style="border:1px solid #000000;">CLUSTERED PRECINT</th>
<th width="40%" style="border:1px solid #000000;">PROVINCE / MUNICIPALITY / BARANGAY</th>
<th width="15%" style="border:1px solid #000000;">QUANTITY</th>
</tr>
@foreach($deliveries as $deliver)
<tr>
<td style="border:1px solid #000000; padding:10px; font-weight: bold; font-size: x-small;">{{$deliver->BALLOT_ID}}</td>
<td style="border:1px solid #000000; padding:10px;font-size:13px font-weight: bold; font-size: x-small;  ">{{$deliver->CLUSTERED_PREC}}</td>
<td style="border:1px solid #000000; padding:10px;font-size:18px font-weight: bold; font-size: x-small;">{{$deliver->PROV_NAME}} {{$deliver->MUN_NAME}} {{$deliver->BGY_NAME}}</td>
<td style="border:1px solid #000000; padding:10px; font-weight: bold; font-size: x-small;">{{$deliver->CLUSTER_TOTAL}}</td>
</tr>
@endforeach
</table>
