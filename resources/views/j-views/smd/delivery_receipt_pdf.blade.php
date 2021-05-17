<table>
    <tr>
      <th width="20%" style="font-size:6px; text-align:left;">
        DR - Form<br>
        Revised Sept. 2019
      </th>
      <th width="10%" style="float:left"> 
        <img src="{{$imagepath}}/shards_template/images/npo.png" height="40px">
      </th>
      <th width="50%" style="text-align:left; font-size:9px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-family:Times;">Republic of the Philippines</label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Presidential Communications Operations Office<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>NATIONAL PRINTING OFFICE</u></b><br>
        &nbsp;&nbsp;&nbsp;&nbsp;EDSA cor. NIA Northside Road Diliman Quezon City<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>SALES and MARKETING DIVISION</b><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:8px;"> npo.gov.ph /8925-2197/09178050356</label><br>
        <label style="font-size:8px;">npo.salesandmarketing@gmail.com / sales.division@npo.gov.ph</label>
      </th>
  
      <th width="20%" style="text-align:left; font-size:6px;">      
        <input type="checkbox" id="copies1" name="copies1" value="copies1" checked = "checked">
        <label for="copies1">FMD Copy</label><br>
        <input type="checkbox" id="copies2" name="copies2" value="copies2" checked = "checked">
        <label for="copies2">SMD - Sales Sec. Copy</label><br>
        <input type="checkbox" id="copies3" name="copies3" value="copies3" checked =  "checked">
        <label for="copies3">Requisitioner's Copy</label><br>
        <input type="checkbox" id="copies4" name="copies4" value="copies4" checked = "checked">
        <label for="copies4">Cashier Copy</label><br>
        </th>
    </tr>
    <tr>
    <th width="100%" style="font-size:8px; text-align:right;">
      <b>{{$value}}</b>
      </th>
    </tr>

    <tr>
      <th width="70%" style="text-align:right; font-size:9px">
      </th>
      <th width="30%" style="text-align:left; font-size:6px;">
      <label style="font-size:8px; text-align:right;">NO. : {{$dr_query->dr_no}}</label><br>
      <label style="font-size:8px; text-align:right;">Date :  {{ \Carbon\Carbon::parse($dr_query->is_posted_at)->format('F,d Y') }}</label><br>
       
      </th>
    </tr>

    <tr>
      <th width="100%" style="text-align:center; font-size:9px">
        <label style="font-family:Times;"><b>DELIVERY RECEIPT</b></label><br>
        <hr>
      </th>
    </tr>

   
    <tr>
      <th width="15%" style="text-align:left; font-size:8px">
      Agency Name:<br>
      Complete Address:<br>
      Region<br>
      Contact No./Person:<br>
      Email Address:
      </th>
      <th width="50%" style="text-align:left; font-size:8px;">      
      <b><label style="font-size:7px;">{{$dr_query->agency_name}}</label></b><br>
      {{$dr_query->agency_address}}<br>
      {{$dr_query->region}}<br>
      {{$dr_query->contact_no}}<br>
      {{$dr_query->email}}
      </th>
      <th width="15%" style="text-align:left; font-size:8px">

      </th>
      <th width="20%" style="text-align:left; font-size:6px;"><br><br><br><br><br><br>
   
      </th>
    </tr>
    <br>

  

</table>
<br><br>
<table style="text-align:center;  font-size: x-small; border-collapse:collapse;">
    <tr>
        <th width="10%"  style="border:1px solid #000000">S.I NO.</th>
        <th width="10%"  style="border:1px solid #000000">STOCK ORDER NO.</th>
        <th width="10%" style="border:1px solid #000000">BILL / OR. NO</th> 
        <th width="20%" style="border:1px solid #000000">QTY</th>   
        <th width="20%" style="border:1px solid #000000">UNIT OF MEASURE</th>     
        <th width="30%" style="border:1px solid #000000" colspan="2">DESCRIPTION</th>     
    </tr>
 
  
    <tr>
    <td width="10%"  style="border:1px solid #000000">{{$dr_query->sales_invoice_code}} </td>   
    <td width="10%"  style="border:1px solid #000000">{{$dr_query->stock_no}} </td>   
    <td width="10%"  style="border:1px solid #000000">{{$dr_query->or_no}} </td>   
      
        <td width="20%"  style="border:1px solid #000000">
        <table style="border-collapse:collapse;">
        @foreach($dr_query->sales_invoice_items as $items)
        <tr>
        <td style="height:25px; font-size:8px; border-top:1px solid #000000; border-bottom: none; text-align: center;">{{$items->quantity}} </td>   
        </tr>
        @endforeach
        </table>
        
        </td>   
        <td width="20%"  style="border:1px solid #000000"> 
        <table style="border-collapse:collapse;">
        @foreach($dr_query->sales_invoice_items as $items)
        <tr>
        <td style="height:25px; font-size:8px; border-top:1px solid #000000; border-bottom: none; text-align: center;">{{$items->unit}} </td>   
        </tr>
        @endforeach
        </table>
         </td>   
        <td width="15%"  style="border:1px solid #000000"> 
        <table style="border-collapse:collapse;">
        @foreach($dr_query->sales_invoice_items as $items)
        <tr>
        <td style="height:25px; font-size:6px; border-top:1px solid #000000; border-bottom: none; text-align: center;">{{$items->item_description}} </td>   
        </tr>
        @endforeach
        </table>
        </td>   
        <td width="15%"  style="border:1px solid #000000">
        <table style="border-collapse:collapse;">
        @foreach($dr_query->sales_invoice_items as $items)
        <tr>
        <td style="height:25px; font-size:6px; border-top:1px solid #000000; border-bottom: none; text-align: center;">{{$items->additional_description}} </td>   
        </tr>
        @endforeach
        </table>
        </td>   
    
   
    </tr>

 
    <tr>
        <td colspan="8"  style="border:1px solid #000000">**nothing follows**</td> 
    </tr>
    @for ($i = 0; $i < $totaladdrow; $i++) 
    <tr>
        <td width="10%"  style="border:1px solid #000000"></td>
        <td width="10%"  style="border:1px solid #000000"></td>    
        <td width="10%" style="border:1px solid #000000"></td>
        <td width="20%" style="border:1px solid #000000"></td>  
        <td width="20%" style="border:1px solid #000000"></td>
        <td width="15%" style="border:1px solid #000000"></td>  
        <td width="15%" style="border:1px solid #000000"></td>
    </tr>
    @endfor
    <tr>
<td width="100%" >
<label style="font-size:8px; text-align:right;">I confirm that all goods received are in good order and condition.</label>
</td>
</tr>
<br><br>

    <tr>
        <td width="10%" >
        <label style="font-size:8px; text-align:left;">Issued By:</label>
        </td>
        <td width="30%" >
        <label style="font-size:8px; text-align:left;">________________________________</label>
        </td>
        <td width="20%" >&nbsp;</td>    
        <td width="10%"><label style="font-size:8px; text-align:left;">No. of Bundle (s):</label> </td>
        <td width="30%" >
        <label style="font-size:8px; text-align:left;">_____________<u>{{$dr_query->no_of_bundles}}</u>_____________</label>
        </td>
    </tr>


<br><br>
    <tr>
    <td width="10%" >
        <label style="font-size:8px; text-align:left;">Remarks:</label>
        </td>
        <td width="30%" >
        <label style="font-size:8px; text-align:left;">_____________<u>{{$dr_query->remarks}}</u>_____________</label></td>
        <td width="20%" >&nbsp;</td>    
        <td width="10%"><label style="font-size:8px; text-align:left;">Received by:</label> </td>
        <td width="30%" >
        <label style="font-size:8px; text-align:left;">________________________________</label>
        </td>
    </tr>


    <br>
    <tr>
        <td width="100%" >
        <label style="font-size:10px; text-align:right;">Thank you!</label>
        </td>
    </tr>


</table>

