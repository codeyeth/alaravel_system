<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
