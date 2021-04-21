<table>
    <tr>
      <th width="20%" style="font-size:6px; text-align:left;">
        SI - Form<br>
        Revised July 2019
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
<br>
    <tr>
      <th width="70%" style="text-align:right; font-size:9px">
      </th>
      <th width="30%" style="text-align:left; font-size:6px;">
      <label style="font-size:8px; text-align:right;">NO. : {{$si_query->sales_invoice_code}}</label><br>
      <label style="font-size:8px; text-align:right;">Date :  {{ \Carbon\Carbon::parse($si_query->is_posted_at)->format('F,d Y') }}</label><br>
       
      </th>
    </tr>

    <tr>
      <th width="55%" style="text-align:right; font-size:9px">
        <label style="font-family:Times;"><b>SALES INVOICE</b></label><br>
      </th>
      <th width="45%" style="text-align:left; font-size:6px;">      
     
      </th>
    </tr>

    <tr>
      <th width="80%" style="text-align:right; font-size:6px">&nbsp;<br>
      <hr>
      </th>
      <th width="20%" style="text-align:left; font-size:6px;">      
      <label style="font-family:Times;"><b>CODE: {{$si_query->code}}</b></label><br>
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
      <b><label style="font-size:7px;">{{$si_query->agency_name}}</label></b><br>
      {{$si_query->agency_address}}<br>
      {{$si_query->region}}<br>
      {{$si_query->contact_no}}<br>
      {{$si_query->email}}
      </th>
      <th width="15%" style="text-align:left; font-size:8px">
        PR# {{$si_query->pr_no}}<br>
        DR# {{$si_query->dr_no}}<br>
        OR# {{$si_query->or_no}}<br>
      </th>
      <th width="20%" style="text-align:left; font-size:6px;"><br><br><br><br><br><br>
      Mode of Payment
      <input type="checkbox" id="copies1" name="copies1" value="copies1" checked = "checked">
        <label for="copies1">{{$si_query->payment_mode}}</label><br>
      Package Type
      <input type="checkbox" id="copies2" name="copies2" value="copies2" checked = "checked">
        <label for="copies2">{{$si_query->package_type}}</label>
      </th>
    </tr>
    <br>

    <tr>
      <th width="60%" style="text-align:right; font-size:7px">
       <label style="font-family:Times;"><u>{{$si_query->transaction_type}}</u></label><br>
      </th>
      <th width="40%" style="text-align:center; font-size:7px;">      
     W.O# {{$si_query->work_order_no}} <br>STOCK NO# {{$si_query->stock_no}}
      </th>
    </tr>
</table>
<br><br>
<table style="text-align:center;  font-size: x-small; border-collapse:collapse;">
    <tr>
        <th width="10%"  style="border:1px solid #000000">QTY</th>
        <th width="10%"  style="border:1px solid #000000">UNIT OF MEASURE</th>
        <th width="40%" style="border:1px solid #000000" colspan="2">DESCRIPTION</th> 
        <th width="20%" style="border:1px solid #000000" colspan="2">PRICE</th>   
        <th width="20%" style="border:1px solid #000000" colspan="2">TOTAL</th>     
    </tr>
    @foreach($si_query->sales_invoice_items as $items)
    <tr>
        <td width="10%"  style="border:1px solid #000000">{{$items->quantity}}</td>
        <td width="10%"  style="border:1px solid #000000">{{$items->unit}}</td>    
        <td width="20%" style="border:1px solid #000000">{{$items->item_description}}</td>
        <td width="20%" style="border:1px solid #000000">{{$items->additional_description}}</td>  
        <td width="10%" style="border:1px solid #000000">PHP</td>
        <td width="10%" style="border:1px solid #000000">{{$items->price}}</td>  
        <td width="10%" style="border:1px solid #000000">PHP</td>
        <td width="10%"  style="border:1px solid #000000">{{$items->total}}  </td>   
    </tr>
    @endforeach
    <tr>
        <td colspan="8"  style="border:1px solid #000000">**nothing follows**</td> 
    </tr>
    @for ($i = 0; $i < $totaladdrow; $i++) 
    <tr>
        <td width="10%"  style="border:1px solid #000000"></td>
        <td width="10%"  style="border:1px solid #000000"></td>    
        <td width="20%" style="border:1px solid #000000"></td>
        <td width="20%" style="border:1px solid #000000"></td>  
        <td width="10%" style="border:1px solid #000000"></td>
        <td width="10%" style="border:1px solid #000000"></td>  
        <td width="10%" style="border:1px solid #000000"></td>
        <td width="10%"  style="border:1px solid #000000"></td>   
    </tr>
    @endfor
  
<tr style="page-break-inside:avoid; page-break-after:auto">
      <td colspan="6" style="border:1px solid #000000; padding:10px; font-size: x-small; text-align:left"><b>Total:</b></td>
      <td style="border:1px solid #000000; padding:10px; font-size: x-small;"><b> PHP </b></td>
      <td style="border:1px solid #000000; padding:10px; font-size: x-small;"><b> {{$si_query->sales_invoice_items->sum('total')}} </b></td>
    </tr>
<br>
    <tr>
        <td width="40%" >
        <label style="font-size:8px; text-align:right;">Issued By:</label><br><br>
        __________________________________<br>
        {{$si_query->created_by_name}}
        </td>
        <td width="20%" ></td>    
        <td width="40%">
        <label style="font-size:8px; text-align:left;">Received By:</label><br><br>
        __________________________________<br>
        Sofia M. Batilaran
        </td>
    </tr>
    
    <tr>
        <td width="100%" >
        <label style="font-size:10px; text-align:right;">Thank you!</label>
        </td>
    </tr>
</table>

