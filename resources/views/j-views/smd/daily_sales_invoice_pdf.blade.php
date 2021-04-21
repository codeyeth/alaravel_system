<table>
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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>DAILY SALES REPORT</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>ACCOUNTABLE AND NON-ACCOUNTABLE FORMS</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>January, 2021</b></label><br>
        </th>
    </tr>
    <tr>
        <th width="4%"  style="border:0.1px solid #000000; font-size:5px; text-align:center;">DATE</th>
        <th width="4%"  style="border:0.1px solid #000000; font-size:5px; text-align:center;">P.O./P.R #</th>
        <th width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">STOCK NO.</th> 
        <th width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">SI NO.</th>   
        <th width="3%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">REGION</th>  
        <th width="4%"  style="border:0.1px solid #000000; font-size:5px; text-align:center;">WALKIN EMAIL</th>
        <th width="3%"  style="border:0.1px solid #000000; font-size:5px; text-align:center;">CODE</th>
        <th width="6%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">REQUISITIONER</th> 
        <th width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">ADDRESS</th>   
        <th width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">CONTACT NO. EMAIL</th> 
        <th width="4%"  style="border:0.1px solid #000000; font-size:5px; text-align:center;">UNIT</th>
        <th width="4%"  style="border:0.1px solid #000000; font-size:5px; text-align:center;">QTY</th>
        <th width="8%"  style="border:0.1px solid #000000; font-size:5px; text-align:center;">
        <table>
            <tr>
              <th colspan="2">
              AF
              </th>
            </tr>
            <tr>
            <td>UP</td>
            <td>AMOUNT</td>
            </tr>
          </table>
        </th> 
        <th width="8%"  style="border:0.1px solid #000000; font-size:5px; text-align:center;">
        <table>
            <tr>
              <th colspan="2">
              NAF
              </th>
            </tr>
            <tr>
            <td>UP</td>
            <td>AMOUNT</td>
            </tr>
          </table>
        </th> 
        <th width="8%"  style="border:0.1px solid #000000; font-size:5px; text-align:center;" colspan="2">TOTAL</th>
        <th width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">SERIAL NO.</th> 
        <th width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">OR NO</th>   
        <th width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">DATE</th> 
        <th width="4%"  style="border:0.1px solid #000000; font-size:5px; text-align:center;">AMOUNT</th>
        <th width="4%"  style="border:0.1px solid #000000; font-size:5px; text-align:center;">DR NO.</th>
        <th width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">REMARKS</th>    
    </tr>
    @foreach($daily_query as $items)
    <tr>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{ \Carbon\Carbon::parse($items->created_at)->toDateString() }}</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->pr_no}}</td> 
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->stock_no}}</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->sales_invoice_code}}</td>
        <td width="3%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->region}}</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->transaction_type}}</td> 
        <td width="3%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->code}}</td>
        <td width="6%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->agency_name}}</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->agency_address}}</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->contact_no}} {{$items->email}}</td> 
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->unit}}</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->quantity}}</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">asd</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">asd</td> 
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->price}}</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">{{$items->sales_invoice_items->sum('total')}}</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;"></td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;"></td> 
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;"></td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">asd</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">asd</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">asd</td> 
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">asd</td>
        <td width="4%" style="border:0.1px solid #000000; font-size:5px; text-align:center;">asd</td>
    </tr>
@endforeach
</table>