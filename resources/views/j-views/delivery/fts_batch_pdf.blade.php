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
        No. <u>20-06-0026 Palawan</u><br>
        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
        <label for="vehicle1"> COMELEC - Inspectorate</label><br>
        <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
        <label for="vehicle2"> COMELEC - BPG 1</label><br>
        <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
        <label for="vehicle3"> COMELEC - BPG 2</label><br>
        <input type="checkbox" id="vehicle4" name="vehicle1" value="Bike">
        <label for="vehicle1"> COMELEC - Delivery</label><br>
        <input type="checkbox" id="vehicle5" name="vehicle2" value="Car">
        <label for="vehicle2"> COA - COMELEC</label><br>
        <input type="checkbox" id="vehicle6" name="vehicle3" value="Boat">
        <label for="vehicle3"> NPO - Delivery 1</label><br>
        <input type="checkbox" id="vehicle7" name="vehicle3" value="Boat">
        <label for="vehicle3"> NPO - Delivery 2</label><br>
        <input type="checkbox" id="vehicle8" name="vehicle3" value="Boat">
        <label for="vehicle3"> NPO - Monitoring</label><br>
      </th>
    </tr>
    <tr style="page-break-inside:avoid; page-break-after:auto">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
</table><br>
<table style="page-break-inside:auto">
  <col width="20%">
  <col width="80%">
    <tr style="page-break-inside:avoid; page-break-after:auto">
      <th width="20%" style="font-size:8px; text-align:left;">
        DELIVERED TO:<br>
        DESCRIPTION
      </th>
      <th width="80%" style="text-align:left; font-size:9px">
        <u>Republic of the Philippines</u><br>
        <u>FTS Batch Delivery Report</u>
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
      <th width="35%" style="border:1px solid #000000;">CLUSTERED PRECINT</th>
      <th width="40%" style="border:1px solid #000000;">PROVINCE / MUNICIPALITY / BARANGAY</th>
      <th width="15%" style="border:1px solid #000000;">QUANTITY</th>
    </tr>
        @foreach($deliveries as $deliver)
    <tr style="page-break-inside:avoid; page-break-after:auto">
      <td style="border:1px solid #000000; padding:10px; font-size: x-small;">{{$deliver->BALLOT_ID}}</td>
      <td style="border:1px solid #000000; padding:10px;font-size:13px font-weight: bold; font-size: x-small;  ">{{$deliver->CLUSTERED_PREC}}</td>
      <td style="border:1px solid #000000; padding:10px;font-size:18px font-weight: bold; font-size: x-small;">{{$deliver->PROV_NAME}} {{$deliver->MUN_NAME}} {{$deliver->BGY_NAME}}</td>
      <td style="border:1px solid #000000; padding:10px; font-size: x-small;">{{$deliver->CLUSTER_TOTAL}}</td>
    </tr>
    @endforeach
       
</table>

<table style="page-break-inside:auto">
<col width="33%">
<col width="34%">
<col width="33%">

<tr style="page-break-inside:avoid; page-break-after:auto">
<th width="100%" style="border:1px solid #000000; font-size:10px; text-align:left;"><b>Total:</b>
</th>
</tr>


<tr style="page-break-inside:avoid; page-break-after:auto">
<th width="33%" style="border:1px solid #000000; font-size:8px; text-align:center;">
Issued by:<br><br>
_________________________<br>
<b>CHARLES ARTHUR C. LIMBAWAN</b><br><br>
Approved by:<br><br>
_________________________<br>
<b>LETHELYN C. SAMOSA</b><br>
Chief, S.M.D

</th>
<th width="34%" style="border:1px solid #000000; font-size:8px; text-align:center;">
Received by:<br><br>
_________________________<br><br>
Signature<br><br>
<b>DOMINIC TAN DOMONDON</b><br><br>
Name in Print

</th>
<th width="33%" style="border:1px solid #000000; font-size:8px; text-align:center;">
Inspected by:<br><br>
_________________________<br><br>
Signature<br><br>
<b>CARLITA DE GUZMAN</b><br><br>
Name in Print

</th>
</tr>

<tr style="page-break-inside:avoid; page-break-after:auto">

<td></td>
<td></td>
<td></td>
</tr>

</table><br>
