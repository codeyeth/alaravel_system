<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RrSmdLogbookSystemController extends Controller
{
    public function logbook_system()
    {
        return view('rr_smd_system.logbook_system');
    }
}
