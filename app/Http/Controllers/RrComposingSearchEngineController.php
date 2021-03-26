<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class RrComposingSearchEngineController extends Controller
{
    public function search_engine()
    {
        return view('rr_composing_system.search_engine');
    }
}
