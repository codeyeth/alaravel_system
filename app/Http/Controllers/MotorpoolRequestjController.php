<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Motorpool;

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
        $newTechRequest->date = Str::upper($request->input('date'));
        $newTechRequest->time = Str::upper($request->input('time'));
        $newTechRequest->purpose = Str::upper($request->input('purpose'));
        
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
