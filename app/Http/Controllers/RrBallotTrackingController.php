<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class RrBallotTrackingController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $breadcrumb = "Ballot Tracking";
        $sidebar = "Ballot Tracking";
        
        if(Auth::user()->is_ballot_tracking){
            return view('rr_ballot_tracking.ballot_tracking')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
        }else{
            abort(403, 'UNAUTHORIZED ACCESS!');
        }
    }
    
    public function status_view()
    {
        $breadcrumb = "Ballot Tracking Status View";
        $sidebar = "Ballot Tracking";
        
        if(Auth::user()->is_ballot_tracking){
            return view('rr_ballot_tracking.status_View')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
        }else{
            abort(403, 'UNAUTHORIZED ACCESS!');
        }
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
