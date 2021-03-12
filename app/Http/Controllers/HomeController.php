<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        
        $breadcrumb = "Home";
        $sidebar = "Home";
        
        return view('home')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
    }
}