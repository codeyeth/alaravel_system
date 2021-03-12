<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Delivery;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
        $imagepath = public_path();
        $issued_to = request()->get('issued_to');
        $search = request()->get('search');
        $issued_date = request()->get('issued_date');
        $issued_by = request()->get('issued_by');

        $deliveries = DB::table('deliveries')
        ->Where('DR_NO',$search)
        ->Where('BALLOT_ID', 'not like', '%F_%')
        ->get();
        $total_row = $deliveries->count();

         $view = \View::make('j-views.delivery.ob_dr_pdf',compact('deliveries','imagepath','total_row'));
         $html_content = $view->render();
        
         PDF::AddPage();
         PDF::writeHTML($html_content, true, false, true, false, '');
         // D is the change of these two functions. Including D parameter will avoid 
         // loading PDF in browser and allows downloading directly
         PDF::Output('dr_ob.pdf', 'D');    
     }

     public function savepdfobdaily()
     {
     $imagepath = public_path();
      $from = request()->get('datefromdaily');
      $to = request()->get('datetodaily');
      $issued_to = request()->get('issued_to');
      $issued_by = request()->get('issued_by');

      $deliveries = DB::table('deliveries')
      ->where('BALLOT_ID','<>','')
      ->Where('BALLOT_ID', 'not like', '%F_%')
      ->whereRaw('updated_at >= ? AND updated_at <= ?', array($from, $to))
      ->get();
      $total_row = $deliveries->count();
      $total_sum = $deliveries->sum('CLUSTER_TOTAL');
      
         $view = \View::make('j-views.delivery.ob_daily_pdf',compact('deliveries','imagepath','total_row','total_sum'));
         $html_content = $view->render();
         

                // Custom Footer
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
         // D is the change of these two functions. Including D parameter will avoid 
         // loading PDF in browser and allows downloading directly
         PDF::Output('daily_ob.pdf', 'D');    
     }

     public function savepdfobbatch()
     {
        $imagepath = public_path();
        $from = request()->get('datefrombatch');
        $to = request()->get('datetobatch');
        $issued_to = request()->get('issued_to');
        $issued_by = request()->get('issued_by');
        $delivered_to = request()->get('delivered_to');

        $deliveries = DB::table('deliveries')
        ->where('BALLOT_ID','<>','')
        ->Where('BALLOT_ID', 'not like', '%F_%')
        ->whereRaw('updated_at >= ? AND updated_at <= ?', array($from,$to))
        ->get();
        $total_row = $deliveries->count();
        $total_sum = $deliveries->sum('CLUSTER_TOTAL');


         $view = \View::make('j-views.delivery.ob_batch_pdf',compact('deliveries','imagepath','total_row','total_sum'));
         $html_content = $view->render();

                    // Custom Footer
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
         // D is the change of these two functions. Including D parameter will avoid 
         // loading PDF in browser and allows downloading directly
         PDF::Output('batch_ob.pdf', 'D');    
     }

     public function savepdfftsdr()
     {
        $imagepath = public_path();
        $issued_to = request()->get('issued_to');
        $search = request()->get('search');
        $issued_date = request()->get('issued_date');
        $issued_by = request()->get('issued_by');

        $deliveries = DB::table('deliveries')
        ->Where('DR_NO',$search)
        ->Where('BALLOT_ID', 'like', '%F_%')
        ->get();
        $total_row = $deliveries->count();
         $view = \View::make('j-views.delivery.ob_dr_pdf',compact('deliveries','imagepath','total_row')  );
         $html_content = $view->render();
        
         PDF::AddPage();
         PDF::writeHTML($html_content, true, false, true, false, '');
         // D is the change of these two functions. Including D parameter will avoid 
         // loading PDF in browser and allows downloading directly
         PDF::Output('dr_ob.pdf', 'D');  
     }

     public function savepdfftsdaily()
     {
         for ($i = 0; $i < 5; $i++) {
        $imagepath = public_path();
        $from = request()->get('datefromdaily');
        $to = request()->get('datetodaily');
        $issued_to = request()->get('issued_to');
        $issued_by = request()->get('issued_by');

       $deliveries = DB::table('deliveries')
      ->where('BALLOT_ID','<>','')
      ->Where('BALLOT_ID', 'like', '%F_%')
      ->whereRaw('updated_at >= ? AND updated_at <= ?', array($from.' 00:00:00', $to.' 23:59:59'))
      ->get();
      $total_row = $deliveries->count();
      $total_sum = $deliveries->sum('CLUSTER_TOTAL');

         $view = \View::make('j-views.delivery.fts_daily_pdf',compact('deliveries','imagepath','total_row','total_sum'));
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
         // D is the change of these two functions. Including D parameter will avoid 
         // loading PDF in browser and allows downloading directly

         
       $windows_user = "/".getenv("username");
        PDF::Output('C:\Users'.$windows_user.'\Downloads\daily_fts' . $i .'.pdf', 'F');  
         //PDF::reset();
        //PDF::Output('dr_ob'. $i .'.pdf' , 'S');  
        PDF::reset(); 
     }
     
    }

     public function savepdfftsbatch()
     {
         $imagepath = public_path();
         $from = request()->get('datefrombatch');
         $to = request()->get('datetobatch');
         $issued_to = request()->get('issued_to');
         $issued_by = request()->get('issued_by');
      
         $deliveries = DB::table('deliveries')
         ->where('BALLOT_ID','<>','')
         ->Where('BALLOT_ID', 'like', '%F_%')
         ->whereRaw('updated_at >= ? AND updated_at <= ?', array($from.' 00:00:00', $to.' 23:59:59'))
         ->get();
         $total_row = $deliveries->count();
         $total_sum = $deliveries->sum('CLUSTER_TOTAL');

         $users = User::orderBy('id','asc')->get();
         $view = \View::make('j-views.delivery.fts_batch_pdf',compact('deliveries','imagepath','total_row','total_sum'));
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
         // D is the change of these two functions. Including D parameter will avoid 
         // loading PDF in browser and allows downloading directly
         PDF::Output('batch_fts.pdf', 'D');    
     }

     










}
