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
    {   $breadcrumb = "Delivery";
        $sidebar = "Delivery";
        return view('j-views.delivery.delivery')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
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


    public function reports()
    {   $breadcrumb = "DR Reports Management";
        $sidebar = "Delivery";
        return view('j-views.delivery.delivery_reports')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
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

    public function savepdfobdr()
     {
        $copies = Request::all();
        $imagepath = public_path();
        $search = request()->get('search');
        $dated= request()->get('dated');
        $delivered_to = request()->get('delivered');
        $description = request()->get('description');

        $query_config = DB::table('delivery_configs')->get();

        $issued_by = (clone $query_config)->Where('id', request()->get('issued'))->first();
        $approved_by = (clone $query_config)->Where('id', request()->get('approved'))->first();
        $received_by = (clone $query_config)->Where('id', request()->get('received'))->first();
        $inspected_by = (clone $query_config)->Where('id', request()->get('inspected'))->first();
 
        $copy = DB::table('delivery_configs')
        ->where('copies','<>','')
        ->whereIn('id',$copies['copies'])
        ->get();
        
        for ($i = 0; $i < $copy->count(); $i++) {
            foreach($copy as $i => $value){
                $deliveries = DB::table('deliveries')
      ->where('BALLOT_ID','<>','')
      ->Where('BALLOT_ID', 'not like', '%F_%')
      ->Where('DR_NO',$search)
      ->get();
      $total_row = $deliveries->count();
      $total_sum = $deliveries->sum('CLUSTER_TOTAL');
               
                $view = \View::make('j-views.delivery.delivery_dr_pdf',compact('value','deliveries','imagepath','total_row','total_sum','copy','delivered_to','description','issued_by','dated','approved_by','received_by','inspected_by'));
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
                PDF::Output(public_path('DeliveryFiles/OB DR '.$search.' Report for ' .  $value->copies . '.pdf'), 'F');
                PDF::reset(); 
            } 
        }
      
        $time_generate = Carbon::now();
        $zip = new ZipArchive;
        $fileName = 'FTS OB Reports '.$search.' ' . $time_generate->toDateString() . '.zip';
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

     public function savepdfobdated()
     {
        $copies = Request::all();
        $imagepath = public_path();
        $from = request()->get('datefromdated');
        $to = request()->get('datetodated');
        $delivered_to = request()->get('delivered');
        $description = request()->get('description');

        $query_config = DB::table('delivery_configs')->get();

        $issued_by = (clone $query_config)->Where('id', request()->get('issued'))->first();
        $approved_by = (clone $query_config)->Where('id', request()->get('approved'))->first();
        $received_by = (clone $query_config)->Where('id', request()->get('received'))->first();
        $inspected_by = (clone $query_config)->Where('id', request()->get('inspected'))->first();
 
        $copy = DB::table('delivery_configs')
        ->where('copies','<>','')
        ->whereIn('id',$copies['copies'])
        ->get();
        
        for ($i = 0; $i < $copy->count(); $i++) {
            foreach($copy as $i => $value){
    $deliveries = DB::table('deliveries')
      ->where('BALLOT_ID','<>','')
      ->Where('BALLOT_ID', 'not like', '%F_%')
      ->whereRaw('updated_at >= ? AND updated_at <= ?', array($from.' 00:00:00', $to.' 23:59:59'))
      ->get();
      $total_row = $deliveries->count();
      $total_sum = $deliveries->sum('CLUSTER_TOTAL');
               
                $view = \View::make('j-views.delivery.delivery_dated_pdf',compact('value','deliveries','imagepath','total_row','total_sum','copy','from','to','delivered_to','description','issued_by','approved_by','received_by','inspected_by'));
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
                PDF::Output(public_path('DeliveryFiles/OB Dated DR Report for ' .  $value->copies . '.pdf'), 'F');
                PDF::reset(); 
            } 
        }
      
        $time_generate = Carbon::now();
        $zip = new ZipArchive;
        $fileName = 'OB Dated DR Reports ' . $time_generate->toDateString() . '.zip';
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

  

     public function savepdfftsdr()
     {

        $copies = Request::all();
        $imagepath = public_path();
        $search = request()->get('search');
        $dated= request()->get('dated');
        $delivered_to = request()->get('delivered');
        $description = request()->get('description');

        $query_config = DB::table('delivery_configs')->get();

        $issued_by = (clone $query_config)->Where('id', request()->get('issued'))->first();
        $approved_by = (clone $query_config)->Where('id', request()->get('approved'))->first();
        $received_by = (clone $query_config)->Where('id', request()->get('received'))->first();
        $inspected_by = (clone $query_config)->Where('id', request()->get('inspected'))->first();
 
        $copy = DB::table('delivery_configs')
        ->where('copies','<>','')
        ->whereIn('id',$copies['copies'])
        ->get();
        
        for ($i = 0; $i < $copy->count(); $i++) {
            foreach($copy as $i => $value){
                $deliveries = DB::table('deliveries')
      ->where('BALLOT_ID','<>','')
      ->Where('BALLOT_ID', 'like', '%F_%')
      ->Where('DR_NO',$search)
      ->get();
      $total_row = $deliveries->count();
      $total_sum = $deliveries->sum('CLUSTER_TOTAL');
               
                $view = \View::make('j-views.delivery.delivery_dr_pdf',compact('value','deliveries','imagepath','total_row','total_sum','copy','delivered_to','description','issued_by','dated','approved_by','received_by','inspected_by'));
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
                PDF::Output(public_path('DeliveryFiles/FTS DR '.$search.' Report for ' .  $value->copies . '.pdf'), 'F');
                PDF::reset(); 
            } 
        }
      
        $time_generate = Carbon::now();
        $zip = new ZipArchive;
        $fileName = 'FTS DR Reports '.$search.' ' . $time_generate->toDateString() . '.zip';
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
   

     public function savepdfftsdated()
     {

        $copies = Request::all();
        $imagepath = public_path();
        $from = request()->get('datefromdated');
        $to = request()->get('datetodated');
        $delivered_to = request()->get('delivered');
        $description = request()->get('description');

        $query_config = DB::table('delivery_configs')->get();

        $issued_by = (clone $query_config)->Where('id', request()->get('issued'))->first();
        $approved_by = (clone $query_config)->Where('id', request()->get('approved'))->first();
        $received_by = (clone $query_config)->Where('id', request()->get('received'))->first();
        $inspected_by = (clone $query_config)->Where('id', request()->get('inspected'))->first();
 
        $copy = DB::table('delivery_configs')
        ->where('copies','<>','')
        ->whereIn('id',$copies['copies'])
        ->get();
        
        for ($i = 0; $i < $copy->count(); $i++) {
            foreach($copy as $i => $value){
                $deliveries = DB::table('deliveries')
      ->where('BALLOT_ID','<>','')
      ->Where('BALLOT_ID', 'like', '%F_%')
      ->whereRaw('updated_at >= ? AND updated_at <= ?', array($from.' 00:00:00', $to.' 23:59:59'))
      ->get();
      $total_row = $deliveries->count();
      $total_sum = $deliveries->sum('CLUSTER_TOTAL');
               
                $view = \View::make('j-views.delivery.delivery_dated_pdf',compact('value','deliveries','imagepath','total_row','total_sum','copy','from','to','delivered_to','description','issued_by','approved_by','received_by','inspected_by'));
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
                PDF::Output(public_path('DeliveryFiles/FTS Dated DR Report for ' .  $value->copies . '.pdf'), 'F');
                PDF::reset(); 
            } 
        }
      
        $time_generate = Carbon::now();
        $zip = new ZipArchive;
        $fileName = 'FTS Dated DR Reports ' . $time_generate->toDateString() . '.zip';
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
