<?php

namespace App\Http\Controllers;

use Request;
use App\Models\User;
use App\Models\Delivery;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;
use ZipArchive;
use Illuminate\Filesystem\Filesystem;
use App\Models\Section;
use Carbon\Carbon;

class DeliveryjController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   /*$breadcrumb = "Delivery";
        $sidebar = "Delivery";
        return view('j-views.delivery.delivery')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);*/
        $breadcrumb = "Delivery";
        $sidebar = "Delivery";
        return view('j-views.delivery.delivery_management')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);

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




    public function ob()
    {   $breadcrumb = "Offical Ballot";
        $sidebar = "Delivery";
        return view('j-views.delivery.delivery_ob')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
    }

    public function fts()
    {   $breadcrumb = "FTS";
        $sidebar = "Delivery";
        return view('j-views.delivery.delivery_fts')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
    }

    public function config()
    {   $breadcrumb = "CONFIGURATION";
        $sidebar = "Delivery";

        return view('j-views.delivery.delivery_configuration')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
    }

    public function delivery_management()
    {   $breadcrumb = "CONFIGURATION";
        $sidebar = "Delivery";

        return view('j-views.delivery.delivery_configuration')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
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

     public function save_dr_pdf()
     {
        ini_set('memory_limit', '-1');
        set_time_limit(43200);
        $var_copies = Request::all();
        $var_imagepath = public_path();
        $var_monthly_dr_from = request()->get('modal_input_monthly_datefrom');
        $var_monthly_dr_to = request()->get('modal_input_monthly_dateto');
        $var_search_dr_no = request()->get('modal_input_search_dr_no');
        $var_daily_dr = request()->get('modal_input_daily_date');
        $var_dr_no_dated = request()->get('modal_input_dated');
        $var_delivered_to = request()->get('modal_input_delivered');
        $var_description = request()->get('modal_input_description');
        $query_all_delivery_config = DB::table('delivery_configs')->get();
        $var_issued_by = (clone $query_all_delivery_config)->Where('id', request()->get('modal_input_issued'))->first();
        $var_approved_by = (clone $query_all_delivery_config)->Where('id', request()->get('modal_input_approved'))->first();
        $var_received_by = (clone $query_all_delivery_config)->Where('id', request()->get('modal_input_received'))->first();
        $var_inspected_by = (clone $query_all_delivery_config)->Where('id', request()->get('modal_input_inspected'))->first();
        $var_copy = DB::table('delivery_configs')
        ->where('copies','<>','')
        ->whereIn('id',$var_copies['modal_input_copies'])
        ->get();
        $query_all_deliveries = DB::table('deliveries')
        ->where('BALLOT_ID','<>','');

        $var_reports_identifier = request()->get('modal_input_dr_reports_identifier');
        $var_dr_identifier = request()->get('modal_input_dr_types_identifier');
        for ($i = 0; $i < $var_copy->count(); $i++) {
            foreach($var_copy as $i => $value){
                if($var_dr_identifier == 1){
                    if($var_reports_identifier == 1){
                        $cloned_query_all_deliveries = clone $query_all_deliveries
                        ->Where('BALLOT_ID', 'not like', '%F_%')
                        ->Where('DR_NO',$var_search_dr_no)
                        ->get();
                        $var_downloaded_title = 'OB Reports for DR No. '.$var_search_dr_no;
                        $var_date_to_display= Carbon::parse($var_dr_no_dated)->format('d F Y');
                    }elseif($var_reports_identifier == 2) {
                        $cloned_query_all_deliveries = clone $query_all_deliveries
                        ->Where('BALLOT_ID', 'not like', '%F_%')
                        ->where('created_at','like','%'.$var_daily_dr.'%')
                        ->get();
                        $var_downloaded_title = 'Daily Reports for OB for ALL DR Dated '.Carbon::parse($var_daily_dr)->format('d F Y');
                        $var_date_to_display= Carbon::parse($var_dr_no_dated)->format('d F Y');
                    }else{
                        $cloned_query_all_deliveries = clone $query_all_deliveries
                        ->Where('BALLOT_ID', 'not like', '%F_%')
                        ->whereRaw('updated_at >= ? AND updated_at <= ?', array($var_monthly_dr_from.' 00:00:00', $var_monthly_dr_to.' 23:59:59'))
                        ->get();
                        $var_downloaded_title = 'OB Dated DR Reports';
                        $var_date_to_display= 'From '.Carbon::parse($var_monthly_dr_from)->format('d F Y').' To '.Carbon::parse($var_monthly_dr_to)->format('d F Y').'';
                    }
                }else{
                    if($var_reports_identifier == 1){
                        $cloned_query_all_deliveries = clone $query_all_deliveries
                        ->Where('BALLOT_ID', 'like', '%F_%')
                        ->Where('DR_NO',$var_search_dr_no)
                        ->get();
                        $var_downloaded_title = 'FTS Reports for DR No. '.$var_search_dr_no;
                        $var_date_to_display= Carbon::parse($var_dr_no_dated)->format('d F Y');
                    }elseif($var_reports_identifier == 2) {
                        $cloned_query_all_deliveries = clone $query_all_deliveries
                        ->Where('BALLOT_ID', 'like', '%F_%')
                        ->where('created_at','like','%'.$var_daily_dr.'%')
                        ->get();
                        $var_downloaded_title = 'Daily Reports for FTS for ALL DR Dated '.Carbon::parse($var_daily_dr)->format('d F Y');
                        $var_date_to_display= Carbon::parse($var_dr_no_dated)->format('d F Y');
                    }else{
                        $cloned_query_all_deliveries = clone $query_all_deliveries
                        ->Where('BALLOT_ID', 'like', '%F_%')
                        ->whereRaw('updated_at >= ? AND updated_at <= ?', array($var_monthly_dr_from.' 00:00:00', $var_monthly_dr_to.' 23:59:59'))
                        ->get();
                        $var_downloaded_title = 'OB Dated DR Reports';
                        $var_date_to_display= 'From '.Carbon::parse($var_monthly_dr_from)->format('d F Y').' To '.Carbon::parse($var_monthly_dr_to)->format('d F Y').'';
                    }
                }
                $var_total_row = $query_all_deliveries->count();
                $var_total_sum = $query_all_deliveries->sum('CLUSTER_TOTAL');
                $view = \View::make('j-views.delivery.delivery_reports_pdf',compact('value','cloned_query_all_deliveries','var_imagepath','var_total_row','var_total_sum','var_copy','var_date_to_display','var_delivered_to','var_downloaded_title','var_description','var_issued_by','var_approved_by','var_received_by','var_inspected_by'));
                $html_content = $view->render();
                PDF::setFooterCallback(function($pdf) {
                // Position at 15 mm from bottom
                $pdf->SetY(-15);
                // Set font
                $pdf->SetFont('helvetica', 'I', 8);
                // Page number
                $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                });
                PDF::SetTitle("List of users");
                PDF::AddPage();
                PDF::writeHTML($html_content, true, false, true, false, '');
                PDF::Output(public_path('DeliveryFiles/'.$var_downloaded_title.' ' .  $value->copies . '.pdf'), 'F');
                PDF::reset(); 
                } 
            }
          
            $time_generate = Carbon::now();
            $zip = new ZipArchive;
            $fileName = $var_downloaded_title.' - '.$time_generate->toDateString() . '.zip';
            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE){
                $files = File::files(public_path('DeliveryFiles'));
                foreach ($files as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
                $zip->close();
            }
            File::cleanDirectory(public_path('DeliveryFiles'));
            return response()->download(public_path($fileName))->deleteFileAfterSend(true);
   
     }
     

}
