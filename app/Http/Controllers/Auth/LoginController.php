<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Illuminate\Support\Facades\Session;
use DB;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LoginHistory;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    use AuthenticatesUsers;
    
    /**
    * Where to redirect users after login.
    *
    * @var string
    */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function authenticated(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            ]);
            
            $user = DB::table('users')->where('email', $request->input('email'))->first();
            $now = Carbon::now();
            
            if (auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                $new_sessid   = Session::getId(); //get new session_id after user sign in
                if($user->session_id != '') {
                    $last_session = Session::getHandler()->read($user->session_id); 
                    if ($last_session) {
                        if (Session::getHandler()->destroy($user->session_id)) {
                            LoginHistory::create([
                                'user_id'       =>  Auth::user()->id,
                                'name'       =>  Auth::user()->name,
                                'email'       =>  Auth::user()->email,
                                'action'       =>  'Forced Logout from another Computer!',
                                'ip'    =>  \Illuminate\Support\Facades\Request::ip(),
                                ]);
                            }
                        }
                    }
                    
                    DB::table('users')->where('id', $user->id)->update(['session_id' => $new_sessid]);
                    LoginHistory::create([
                        'user_id'       =>  Auth::user()->id,
                        'name'       =>  Auth::user()->name,
                        'email'       =>  Auth::user()->email,
                        'action'       =>  'Login',
                        'ip'    =>  \Illuminate\Support\Facades\Request::ip(),
                        ]);
                        $user = auth()->guard('web')->user();
                        return redirect($this->redirectTo);
                    }   
                }
                
            }
            