

<div class="container" style=" margin-left: auto; margin-right: auto; text-align: center;  font-size: 10px;" >
<div class="top-right" style="">Comelec</div>
Republic of the Philippines<br>
<div class="top-left" style=""><img src="{{$imagepath}}/shards_template/images/npo.png"  height="75px"></div>PRESIDENTIAL COMMUNICATIONS OPERATIONS OFFICE<br><br>
        <b><u>NATIONAL PRINTING OFFICE</u></b><br><br>
        DAILY REPORT OF DELIVERY <br>
        NATIONAL PRINTING OFFICE TO COMMISSION ON ELECTIONS<br>
        <b>FTS</b><br>
        MAY 17 2021
</div>
  <div class="top-left"><!--CEF#6 - OFFICIAL BALLOT - National and Local Election May 13, 2019--> </div>
</div>

    <h5>List for Official Ballot of 1 (one) DR</h5>
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
