<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use App\Models\LoginHistory;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LogSuccessfulLogout
{
    /**
    * Create the event listener.
    *
    * @return void
    */
    public function __construct()
    {
        //
    }
    
    /**
    * Handle the event.
    *
    * @param  Login  $event
    * @return void
    */
    public function handle(Logout $event)
    {
        $now = Carbon::now();
        
        LoginHistory::create([
            'user_id'       =>  Auth::user()->id,
            'name'       =>  Auth::user()->name,
            'email'       =>  Auth::user()->email,
            'action'       =>  'Logout',
            'ip'    =>  \Illuminate\Support\Facades\Request::ip(),
            ]);
            
            $user = Auth::user();
            $new_sessid = Session::flush();
            $user->session_id = $new_sessid;
            $user->save();
        }
    }