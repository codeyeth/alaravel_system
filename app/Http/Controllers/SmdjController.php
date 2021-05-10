<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;
use ZipArchive;
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;

class SmdjController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function si(){
        $copies = ['FMD Copy','SMD - Sales Sec. Copy','Requisitioner\'s Copy','Cashier Copy'];
        $count = count($copies);
        $time_generate = Carbon::now();
        for ($i = 0; $i < $count; $i++) {
            foreach($copies as $i => $value){
                $imagepath = public_path();
                $sales_id = request()->get('si_id');
                $si_query  = SalesInvoice::where('sales_invoice_code',$sales_id)->first();
               
                $si_item_count = $si_query->sales_invoice_items->count();
                if ($si_item_count > 16){
                    $totaladdrow = 8;
                }else{
                    $itemcount = $si_item_count * 2;
                    $totalrowcount = 32;
                    $totaladdrow = $totalrowcount - $itemcount;
                }
                $view = \View::make('j-views.smd.sales_invoice_pdf',compact('totaladdrow','value','imagepath','si_query','count'));
                $html_content = $view->render();
                PDF::setFooterCallback(function($pdf) {
                    // Position at 15 mm from bottom
                    $pdf->SetY(-15);
                    // Set font
                    $pdf->SetFont('helvetica', 'I', 8);
                    // Page number
                    $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                });
                PDF::SetTitle("Sales Invoice");
                PDF::AddPage();
                PDF::writeHTML($html_content, true, false, true, false, '');
                PDF::Output(public_path('SalesInvoice/Sales Invoice '.$sales_id.' for ' .  $value . ' ' . $time_generate->toDateString() . '.pdf'), 'F');
                PDF::reset(); 
            }
        }
        $zip = new ZipArchive;
        $fileName = 'Sales Invoice '.$sales_id.' ' . $time_generate->toDateString() . '.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE){
            $files = File::files(public_path('SalesInvoice'));
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }
        File::cleanDirectory(public_path('SalesInvoice'));
        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }

    public function daily_sales_generic(){
        $data_daily_generic = request()->get('input_daily_generic');
        $generic_daily_date = Carbon::parse($data_daily_generic)->toDateString();
        $data  = SalesInvoice::where('created_at','like','%'.$generic_daily_date.'%')->where('goods_type','GENERIC')->get();

        $imagepath = public_path();
        $view = \View::make('j-views.smd.daily_sales_invoice_generic_pdf',compact('data','imagepath','generic_daily_date'));
        $html_content = $view->render();
        PDF::setFooterCallback(function($pdf) {
            // Position at 15 mm from bottom
            $pdf->SetY(-15);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
            $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });
        PDF::SetTitle("Daily Sales Invoice");
        PDF::AddPage('L', 'LEGAL');
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('daily.pdf');
        PDF::reset(); 
    }

    public function daily_sales_specialized(){
        $data_daily_specialized = request()->get('input_daily_specialized');
        $specialized_daily_date = Carbon::parse($data_daily_specialized)->toDateString();
        $data  = SalesInvoice::where('created_at','like','%'.$specialized_daily_date.'%')->where('goods_type','SPECIALIZED')->get();
        
        $imagepath = public_path();
        $view = \View::make('j-views.smd.daily_sales_invoice_specialized_pdf',compact('data','imagepath','specialized_daily_date'));
        $html_content = $view->render();
        PDF::setFooterCallback(function($pdf) {
            // Position at 15 mm from bottom
            $pdf->SetY(-15);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
            $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });
        PDF::SetTitle("Daily Sales Invoice");
        PDF::AddPage('L', 'LEGAL');
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('daily.pdf');
        PDF::reset(); 
    }

    public function monthly_sales_invoice(){
       
        $imagepath = public_path();
        $monthly_si_from = request()->get('input_monthly_si_datefrom');
        $monthly_si_to  = request()->get('input_monthly_si_dateto');
        $cloned_query = SalesInvoice::whereRaw('created_at >= ? AND created_at <= ?', array($monthly_si_from.' 00:00:00', $monthly_si_to.' 23:59:59'));
        $data = SalesInvoice::orderBy('sales_invoice_items.created_at')
            ->join('sales_invoice_items', 'sales_invoices.sales_invoice_code', '=', 'sales_invoice_items.sales_invoice_code')
            ->whereRaw('sales_invoice_items.created_at >= ? AND sales_invoice_items.created_at <= ?', array($monthly_si_from.' 00:00:00', $monthly_si_to.' 23:59:59'))
            ->get()->groupBy(function($item) {
                return $item->created_at->format('Y-m-d');
            });     
        $view = \View::make('j-views.smd.monthly_sales_invoice_pdf',compact('monthly_si_from','monthly_si_to','cloned_query','data','imagepath'));
        $html_content = $view->render();
        PDF::setFooterCallback(function($pdf) {
            // Position at 15 mm from bottom
            $pdf->SetY(-15);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
            $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });
        PDF::SetTitle("Monthly Sales Invoice");
        PDF::AddPage('L', 'LEGAL');
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('Monthly Sales Invoice.pdf');
        PDF::reset(); 
    }

    public function claimed_generic(){
       
        $imagepath = public_path();
        $generic_claimed_from = request()->get('input_generic_claimed_datefrom');
        $generic_claimed_to = request()->get('input_generic_claimed_dateto');
        $cloned_query = SalesInvoice::whereRaw('created_at >= ? AND created_at <= ?', array($generic_claimed_from.' 00:00:00', $generic_claimed_to.' 23:59:59'))
        ->where('goods_type','GENERIC')
        ->where('is_delivered',1)
        ->get();
        $view = \View::make('j-views.smd.generic_goods_claimed',compact('generic_claimed_from','generic_claimed_to','imagepath','cloned_query'));
        $html_content = $view->render();
        PDF::setFooterCallback(function($pdf) {
            // Position at 15 mm from bottom
            $pdf->SetY(-15);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
            $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });
        PDF::SetTitle("REPORTS OF CLAIMED GOODS IN-HOUSE GENERIC");
        PDF::AddPage('L', 'LEGAL');
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('REPORTS OF CLAIMED GOODS IN-HOUSE GENERIC.pdf');
        PDF::reset(); 
    }

    public function unclaimed_generic(){
       
        $imagepath = public_path();
        $generic_unclaimed_from = request()->get('input_generic_unclaimed_datefrom');
        $generic_unclaimed_to = request()->get('input_generic_claimed_dateto');
        $cloned_query = SalesInvoice::whereRaw('created_at >= ? AND created_at <= ?', array($generic_unclaimed_from.' 00:00:00', $generic_unclaimed_to.' 23:59:59'))
        ->where('goods_type','GENERIC')
        ->where('is_delivered','!=',1)
        ->get();
        $view = \View::make('j-views.smd.generic_goods_unclaimed',compact('generic_unclaimed_from','generic_unclaimed_to','imagepath','cloned_query'));
        $html_content = $view->render();
        PDF::setFooterCallback(function($pdf) {
            // Position at 15 mm from bottom
            $pdf->SetY(-15);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
            $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });
        PDF::SetTitle("REPORTS OF CLAIMED GOODS IN-HOUSE GENERIC");
        PDF::AddPage('L', 'LEGAL');
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('REPORTS OF CLAIMED GOODS IN-HOUSE GENERIC.pdf');
        PDF::reset(); 
    }

    public function claimed_specialized(){
       
        $imagepath = public_path();
        $specialized_claimed_from = request()->get('input_specialized_claimed_datefrom');
        $specialized_claimed_to = request()->get('input_specialized_claimed_dateto');
        $cloned_query = SalesInvoice::whereRaw('created_at >= ? AND created_at <= ?', array($specialized_claimed_from.' 00:00:00', $specialized_claimed_to.' 23:59:59'))
        ->where('goods_type','SPECIALIZED')
        ->where('is_delivered',1)
        ->get();
        $view = \View::make('j-views.smd.specialized_goods_claimed',compact('specialized_claimed_from','specialized_claimed_to','imagepath','cloned_query'));
        $html_content = $view->render();
        PDF::setFooterCallback(function($pdf) {
            // Position at 15 mm from bottom
            $pdf->SetY(-15);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
            $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });
        PDF::SetTitle("REPORTS OF CLAIMED GOODS SPECIALIZED");
        PDF::AddPage('L', 'LEGAL');
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('REPORTS OF CLAIMED GOODS SPECIALIZED.pdf');
        PDF::reset(); 
    }

    public function unclaimed_specialized(){
       
        $imagepath = public_path();
        $specialized_unclaimed_from = request()->get('input_specialized_unclaimed_datefrom');
        $specialized_unclaimed_to = request()->get('input_specialized_unclaimed_dateto');
        $cloned_query = SalesInvoice::whereRaw('created_at >= ? AND created_at <= ?', array($specialized_unclaimed_from.' 00:00:00', $specialized_unclaimed_to.' 23:59:59'))
        ->where('goods_type','SPECIALIZED')
        ->where('is_delivered','!=',1)
        ->get();
        $view = \View::make('j-views.smd.specialized_goods_unclaimed',compact('specialized_unclaimed_from','specialized_unclaimed_to','imagepath','cloned_query'));
        $html_content = $view->render();
        PDF::setFooterCallback(function($pdf) {
            // Position at 15 mm from bottom
            $pdf->SetY(-15);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
            $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });
        PDF::SetTitle("REPORTS OF UNCLAIMED GOODS SPECIALIZED");
        PDF::AddPage('L', 'LEGAL');
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output('REPORTS OF UNCLAIMED GOODS SPECIALIZED.pdf');
        PDF::reset(); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
