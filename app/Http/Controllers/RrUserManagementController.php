<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Division;
use App\Models\Section;
use Auth;

class RrUserManagementController extends Controller
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
        $breadcrumb = "User Management";
        $sidebar = "User Management";
        
        if(Auth::user()->is_user_mgt){
            return view('rr_user_mgt.user_mgt')->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
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
        $now = Carbon::now();
        
        $post = new User;
        $post->user_id = Str::uuid();
        $post->fname = Str::upper($request->input('fname'));
        $post->mname = Str::upper($request->input('mname'));
        $post->lname = Str::upper($request->input('lname'));
        
        if( $post->mname == ''){
            $post->name = $post->fname . ' ' . $post->lname;
        }else{
            $post->name = $post->fname . ' ' . $post->mname . ' ' . $post->lname;
        }
        
        $replaced = Str::replaceArray(' ', ['_'], $post->lname);
        $post->email = Str::lower($replaced.Str::random(3). '@npo.org');
        
        $post->position = Str::upper($request->input('position'));
        $post->division = Division::where('id', $request->input('division') )->value('division');
        $post->section = Section::where('id', $request->input('section') )->value('section');
        
        // if( $request->input('user_role') == "Administrator"){
        //     $post->is_admin = true;
        // }else{
        //     $post->is_admin = false;
        // }
        
        $post->is_admin = $request->input('user_role');

        //FIXED PASSWORD
        $post->password = Hash::make('12345678');
        $post->password_string = '12345678';
        
        if( $request->input('is_user_mgt') == null){
            $post->is_user_mgt = false;
        }else{
            $post->is_user_mgt = true;
        }
        
        if( $request->input('is_ballot_tracking') == null){
            $post->is_ballot_tracking = false;
        }else{
            $post->is_ballot_tracking = true;
        }
        
        if( $request->input('is_dr') == null){
            $post->is_dr = false;
        }else{
            $post->is_dr = true;
        }
        
        if( $request->input('is_gazette') == null){
            $post->is_gazette = false;
        }else{
            $post->is_gazette = true;
        }
        
        if( $request->input('is_motorpool') == null){
            $post->is_motorpool = false;
        }else{
            $post->is_motorpool = true;
        }
        
        $post->comelec_role = $request->input('comelec_role');
        $post->barcoded_receiver = $request->input('barcoded_receiver');
        
        $post->created_by_id = Auth::user()->id;
        $post->created_by_name = Auth::user()->name;
        
        $post->save();
        
        return back()->with('success', 'User Created Successfully!')
        ->with('now', $now);
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
        $post = User::find($id);      
        
        $breadcrumb = "Edit User";
        $sidebar = "User Management";
        
        return view('rr_user_mgt.edit')
        ->with('post', $post)
        ->with('breadcrumb', $breadcrumb)
        ->with('sidebar', $sidebar);
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
        $now = Carbon::now();
        
        $post = User::find($id);
        $post->user_id = Str::uuid();
        $post->fname = Str::upper($request->input('fname'));
        $post->mname = Str::upper($request->input('mname'));
        $post->lname = Str::upper($request->input('lname'));
        
        if( $post->mname == ''){
            $post->name = $post->fname . ' ' . $post->lname;
        }else{
            $post->name = $post->fname . ' ' . $post->mname . ' ' . $post->lname;
        }
        
        $post->position = Str::upper($request->input('position'));
        $post->division = Division::where('id', $request->input('division') )->value('division');
        $post->section = Section::where('id', $request->input('section') )->value('section');
        
        // if( $request->input('user_role') == "Administrator"){
        //     $post->is_admin = true;
        // }else{
        //     $post->is_admin = false;
        // }

        $post->is_admin = $request->input('user_role');

        
        if( $request->input('user_mgt') == null){
            $post->is_user_mgt = false;
        }else{
            $post->is_user_mgt = true;
        }
        
        if( $request->input('is_ballot_tracking') == null){
            $post->is_ballot_tracking = false;
        }else{
            $post->is_ballot_tracking = true;
        }
        
        if( $request->input('is_dr') == null){
            $post->is_dr = false;
        }else{
            $post->is_dr = true;
        }
        
        if( $request->input('is_gazette') == null){
            $post->is_gazette = false;
        }else{
            $post->is_gazette = true;
        }
        
        if( $request->input('is_motorpool') == null){
            $post->is_motorpool = false;
        }else{
            $post->is_motorpool = true;
        }
        
        $post->comelec_role = $request->input('comelec_role');
        $post->barcoded_receiver = $request->input('barcoded_receiver');
        
        $post->save();
        
        return back()->with('success', 'User Created Successfully!')
        ->with('now', $now);
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $now = Carbon::now();
        $post = User::find($id);
        
        $post-> delete();
        return back()->with('success', 'User Removed Successfully')
        ->with('now', $now);
    }
}
