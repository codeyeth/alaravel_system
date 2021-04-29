<?php

namespace App\Http\Livewire\RrUserManagement;

use Livewire\Component;
use App\Models\Division;
use App\Models\Section;
use App\Models\ComelecRoles;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Hash;

class AddUser extends Component
{
    //USER DETAILS
    public $fname;
    public $mname;
    public $lname;
    public $position;
    public $division = '';
    public $section = '';
    public $userRole = '';
    
    public $isUserMgt = false;
    public $isBallot = false;
    public $isDr = false;
    public $isSmdSystem = false;
    public $isGazette = false;
    public $isMotorpool = false;
    
    public $comelecRole = '';
    public $barcodedReceiver = '';
    
    public $divisionsList = [];
    public $sectionsList = [];
    public $comelecRolesList = [];
    public $barcodedReceiverList = [];
    
    public function refreshTrick(){
        $this->fname = '';
        $this->mname = '';
        $this->lname = '';
        $this->position = '';
        $this->division = '';
        $this->section = '';
        $this->userRole = '';
        $this->isUserMgt = '';
        $this->isBallot = '';
        $this->isDr = '';
        $this->isSmdSystem = '';
        $this->isGazette = '';
        $this->isMotorpool = '';
        $this->comelecRole = '';
        $this->barcodedReceiver = '';
    }
    
    public function spitBarcodedReceiverList($comelecRole){
        $this->barcodedReceiverList = ComelecRoles::where('comelec_role', '!=', $comelecRole)->get();
        $this->barcodedReceiver = '';
    }
    
    public function spitMatchedSection($selectedDivision){
        $this->sectionsList = Section::where('division_id', $selectedDivision)->get();
        $this->section = '';
    }
    
    public function saveNewUser(){
        
        if( $this->mname == ''){
            $name = $this->fname . ' ' . $this->lname;
            $this->mname = '';
        }else{
            $name = $this->fname . ' ' . $this->mname . ' ' . $this->lname;
        }
        
        if($this->userRole == 2){
            $userRoleSA = true;
            $userRole = true;
        }else{
            $userRoleSA = false;
            $userRole = $this->userRole;
        }
        
        $replaced = Str::replaceArray(' ', ['_'], $this->lname);
        $email = Str::lower($replaced.Str::random(3). '@example.org');
        
        $saveNewUser = User::create([
            'user_id' => Str::uuid(),
            'fname' => Str::upper($this->fname),
            'mname' => Str::upper($this->mname),
            'lname' => Str::upper($this->lname),
            'name' => Str::upper($name),
            'email' => $email,
            
            'position' => Str::upper($this->position),
            'division' =>  $this->division,
            'section' =>  $this->section,
            
            'is_super_admin' => $userRoleSA,
            'is_admin' => $userRole,
            'is_user_mgt' =>  $this->isUserMgt,
            'is_ballot_tracking' =>  $this->isBallot,
            'is_dr' =>  $this->isDr,
            'is_smd_system' =>  $this->isSmdSystem,
            'is_gazette' =>  $this->isGazette,
            'is_motorpool' =>  $this->isMotorpool,
            
            'comelec_role' =>  Str::upper($this->comelecRole),
            'barcoded_receiver' =>  Str::upper($this->barcodedReceiver),
            
            'created_by_id' => Auth::user()->id,
            'created_by_name' => Auth::user()->name,
            
            'password' => Hash::make('12345678'),
            'password_string' => '12345678',
            ]
        );
        
        session()->flash('messageSaveNewUser', 'User Saved Successfully!');
        $this->refreshTrick();
        $this->emit('newUserAdded');
    }
    
    public function mount(){
        $this->divisionsList = Division::all();
        $this->comelecRolesList = ComelecRoles::all();
        $this->allUserCount = User::all()->count();
    }
    
    public function render()
    {
        return view('livewire.rr-user-management.add-user');
    }
}
