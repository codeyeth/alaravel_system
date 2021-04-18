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
