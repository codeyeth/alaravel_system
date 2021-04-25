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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:6px;"><b>MONTHLY SALES REPORT</b></label><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:7px;"><b>{{ \Carbon\Carbon::parse($from)->format('F, j') }}-{{ \Carbon\Carbon::parse($to)->format('j Y') }}</b></label><br>
        </th>
    </tr>
</table>
<table>
<tr>
  <th width="10%" style="border:0.1px solid #000000; text-align:center;">Date</th>
  <th width="30%" style="border:0.1px solid #000000; text-align:center;">
  <table style="border-collapse:collapse;">
            <tr>
              <th style="font-size:7px;" colspan="2">
              <b>GENERIC</b>
              </th>
            </tr>
            <tr>
            <td style="font-size:6px; text-align:left;"><b>ACCOUNTABLE FORMS</b></td>
            <td style="font-size:6px; text-align:right;"><b>NON ACCOUNTABLE FORMS</b></td>
            </tr>
          </table>
  </th>
  <th width="20%" style="border:0.1px solid #000000; text-align:center;">Total</th>
  <th width="30%" style="border:0.1px solid #000000; text-align:center;">
  <table style="border-collapse:collapse;">
            <tr>
              <th style="font-size:7px;" colspan="2">
              <b>SPECIALIZED</b>
              </th>
            </tr>
            <tr>
            <td style="font-size:6px; text-align:left;"><b>ACCOUNTABLE FORMS</b></td>
            <td style="font-size:6px; text-align:right;"><b>NON ACCOUNTABLE FORMS</b></td>
            </tr>
          </table>
          </th>
  <th width="10%" style="border:0.1px solid #000000; text-align:center;">Total</th>
</tr>
@foreach($data as $key => $item)
@foreach($item as $asd)
@endforeach
<tr>
<td width="10%" style="border:0.1px solid #000000; text-align:center;">{{$key}} </td>
<td width="15%" style="border:0.1px solid #000000; text-align:center;">   
      @php
      $total_gen_af = App\Models\SalesInvoice::where('date',$key)->join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoice_items.form_type','AF')->where('sales_invoices.goods_type','GENERIC')->get();
      @endphp
      {{ $total_gen_af->sum('total')}}
</td>
<td width="15%" style="border:0.1px solid #000000; text-align:center;">
      @php
      $total_gen_naf = App\Models\SalesInvoice::where('date',$key)->join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoice_items.form_type','NAF')->where('sales_invoices.goods_type','GENERIC')->get();
      @endphp
      {{ $total_gen_naf->sum('total')}}
</td>
<td width="20%" style="border:0.1px solid #000000; text-align:center;">
      @php
      $total_gen = App\Models\SalesInvoice::where('date',$key)->join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoices.goods_type','GENERIC')->get();
      @endphp
      {{ $total_gen->sum('total')}}
</td>
<td width="15%" style="border:0.1px solid #000000; text-align:center;">
      @php
      $total_spe_af = App\Models\SalesInvoice::where('date',$key)->join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoice_items.form_type','AF')->where('sales_invoices.goods_type','SPECIALIZED')->get();
      @endphp
      {{ $total_spe_af->sum('total')}}
</td>
<td width="15%" style="border:0.1px solid #000000; text-align:center;">
      @php
      $total_spe_naf = App\Models\SalesInvoice::where('date',$key)->join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoice_items.form_type','NAF')->where('sales_invoices.goods_type','SPECIALIZED')->get();
      @endphp
      {{ $total_spe_naf->sum('total')}}
</td>
<td width="10%" style="border:0.1px solid #000000; text-align:center;">
      @php
      $total_spe = App\Models\SalesInvoice::where('date',$key)->join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoices.goods_type','SPECIALIZED')->get();
      @endphp
      {{ $total_spe->sum('total')}}
</td>
</tr>
@endforeach
<tr>
<td width="10%" style="border:0.1px solid #000000; text-align:center;">Total</td>
<td width="15%" style="border:0.1px solid #000000; text-align:center; color: red;">
      @php
      $total_all_gen_af = App\Models\SalesInvoice::join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoices.goods_type','GENERIC')->where('sales_invoice_items.form_type','AF')->get();
      @endphp
      {{ $total_all_gen_af->sum('total')}}
</td>
<td width="15%" style="border:0.1px solid #000000; text-align:center; color: red;">
      @php
      $total_all_gen_naf = App\Models\SalesInvoice::join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoices.goods_type','GENERIC')->where('sales_invoice_items.form_type','NAF')->get();
      @endphp
      {{ $total_all_gen_naf->sum('total')}}
</td>
<td width="20%" style="border:0.1px solid #000000; text-align:center; color: red;">
      @php
      $total_all_gen = App\Models\SalesInvoice::join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoices.goods_type','GENERIC')->get();
      @endphp
      {{ $total_all_gen->sum('total')}}
</td>
<td width="15%" style="border:0.1px solid #000000; text-align:center; color: red;">
      @php
      $total_all_spe_af = App\Models\SalesInvoice::join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoices.goods_type','SPECIALIZED')->where('sales_invoice_items.form_type','AF')->get();
      @endphp
      {{ $total_all_spe_af->sum('total')}}
</td>
<td width="15%" style="border:0.1px solid #000000; text-align:center; color: red;">
      @php
      $total_all_spe_naf = App\Models\SalesInvoice::join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoices.goods_type','SPECIALIZED')->where('sales_invoice_items.form_type','NAF')->get();
      @endphp
      {{ $total_all_spe_naf->sum('total')}}
</td>
<td width="10%" style="border:0.1px solid #000000; text-align:center;  color: red;">
      @php
      $total_all_spe = App\Models\SalesInvoice::join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')->where('sales_invoices.goods_type','SPECIALIZED')->get();
      @endphp
      {{ $total_all_spe->sum('total')}}
</td>
</tr>
<br><br>
<tr>
<td width="10%">
<table style="border-collapse:collapse;">
          <tr>
              <th colspan="2" style="font-size:6px; text-align:center; border:0.1px solid #000000;"><b>TOTAL</b></th>
            </tr>
            <tr>
              <th style="font-size:6px; text-align:center; border:0.1px solid #000000;"><b>WALK IN</b></th>
              <th style="font-size:6px; text-align:center; border:0.1px solid #000000;"><b>EMAIL</b></th>
            </tr>
            <tr>
            <td style="font-size:7px; text-align:center; border:0.1px solid #000000;"><b>{{(clone $cloned_query)->where('sales_invoices.transaction_type','WALK-IN')->count()}}</b></td>
            <td style="font-size:7px; text-align:center; border:0.1px solid #000000;"><b>{{(clone $cloned_query)->where('sales_invoices.transaction_type','EMAIL')->count()}}</b></td>
            </tr>
          </table>
</td>
<td width="15%"></td>
<td width="25%" style="text-align:left; font-size:9px">
Prepared by:<br><br><br>
JOHANNA A. ROBLES<br>
Photoengraver II
</td>
<td width="25%" style="text-align:left; font-size:9px">
Submitted by:<br><br><br>
SOFIA M. BATILARAN<br>
Supervisor Sales Section
</td>
<td width="25%" style="text-align:left; font-size:9px">
Certified Correct:<br><br><br>
LETHELYN C. SAMOSA<br>
Chief, S.M.D
</td>
</tr>

</table>




<br>

