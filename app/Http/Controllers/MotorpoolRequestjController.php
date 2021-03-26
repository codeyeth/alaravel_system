<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Motorpool;
use App\Models\Division;
use App\Models\Section;
use PDF;
use Illuminate\Support\Facades\DB;

class MotorpoolRequestjController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumb = "Motorpool Request";
        $sidebar = "Motorpool Request";
        return view('j-views.motorpool.motorpool')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
    }

    
    public function savemotorpoolreport()
    {

         $id = request()->get('pdfid');
         $letter_details = DB::table('motorpools')
         ->where('id',$id)
         ->get();
         $letter_details = Motorpool::find($id);
         $date_created= Carbon::parse($letter_details->created_at)->format('d F Y');
         $date_action = Carbon::parse($letter_details->date)->format('F d, Y');
         $time_action = Carbon::parse($letter_details->time)->format('g:i A');

         $view = \View::make('j-views.motorpool.motorpool_letter',compact('date_created','date_action','time_action','letter_details'));
         $html_content = $view->render();

        PDF::setHeaderCallback(function($pdf) {
        $imagepath = public_path();
        $image_file = $imagepath.'\shards_template\images\header.png';
        $pdf->Image($image_file, 0, 0, 216, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false); 
        });
        PDF::setFooterCallback(function($pdf) {
            $imagepath = public_path();
            $image_file =  $imagepath.'\shards_template\images\footer.png';
            $pdf->Image($image_file, 0, 258, 216, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false); 
        });
         PDF::AddPage('P', 'LETTER');
      
         PDF::writeHTML($html_content, true, false, true, false, '');
         // D is the change of these two functions. Including D parameter will avoid 
         // loading PDF in browser and allows downloading directly
         PDF::Output('motorpool_request.pdf', 'I'); 
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
        $now = Carbon::now();
        $incremental = Motorpool::count() + 1;
        
        $newTechRequest = new Motorpool;
        $newTechRequest->transaction_id = Str::uuid();
        $newTechRequest->request_id = 'MTRPOOL_RQST' . $now->year . $incremental;
        
        $newTechRequest->emp_name = Str::upper($request->input('empName'));
        $newTechRequest->division_chief = Str::upper($request->input('chiefName'));
        $newTechRequest->destination = Str::upper($request->input('destination'));
        //$newTechRequest->datetime = Str::upper($request->input('datetime'));
        $format1 = 'Y-m-d';
        $format2 = 'H:i:s';
        $newTechRequest->date = Carbon::parse($request->input('datetime'))->format($format1);
        $newTechRequest->time = Carbon::parse($request->input('datetime'))->format($format2);
  

        $newTechRequest->division = Division::where('id', $request->input('division') )->value('division');
        $newTechRequest->section = Section::where('id', $request->input('section') )->value('section');


        $newTechRequest->purpose = Str::upper($request->input('purpose'));
        $newTechRequest->status = 'PENDING';
        
        $newTechRequest->save();
        
        return back()->with('success', 'Request Added Successfully')->with('now', $now);
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
}
