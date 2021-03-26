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

class RrUserManagement extends Component
{
    //ADD NEW USER PROPERTIES
    public $fname;
    public $mname;
    public $lname;
    public $position;
    public $division = '';
    public $section = '';
    public $userRole = "";
    
    public $isUserMgt = false;
    public $isBallot = false;
    public $isDr = false;
    public $isGazette = false;
    public $isMotorpool = false;
    
    public $comelecRole = '';
    public $barcodedReceiver = '';
    
    public $divisionsList = [];
    public $sectionsList = [];
    public $comelecRolesList = [];
    
    //ACTION PANEL PROPERTIES
    public $allUserCount;
    
    protected $rules = [
        'fname' => 'required|max:15|regex:/^[\pL\s\-]+$/u',
        'mname' => 'max:15|regex:/^[\pL\s\-]+$/u',
        'lname' => 'required|max:15|regex:/^[\pL\s\-]+$/u',
        'position' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
        'division' => 'required',
        'section' => 'required',
        'userRole' => 'required',
        
        'isUserMgt' => 'max:10',
        'isBallot' => 'max:10',
        'isDr' => 'max:10',
        'isGazette' => 'max:10',
        'isMotorpool' => 'max:10',
        'comelecRole' => 'max:30',
        'barcodedReceiver' => 'max:30',
    ];
    
    protected $messages = [
        // FIRSTNAME
        'fname.required' => 'First name is required',
        'fname.max' => 'First name may not be greater than 15 characters',
        'fname.regex' => 'First name may only contain letters',
        // MIDDLENAME
        'mname.max' => 'Middle name may not be greater than 15 characters',
        'mname.regex' => 'Middle name may only contain letters',
        // LASTNAME
        'lname.required' => 'Last name is required',
        'lname.max' => 'Last name may not be greater than 15 characters',
        'lname.regex' => 'Last name may only contain letters',
        // POSITION
        'position.required' => 'Position is required',
        'position.max' => 'Position may not be greater than 50 characters',
        'position.regex' => 'Position may only contain letters and numbers',
    ];
    
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
        $this->isGazette = '';
        $this->isMotorpool = '';
        $this->comelecRole = '';
        $this->barcodedReceiver = '';
    }
    
    public function spitMatchedSection($selectedDivision){
        $this->sectionsList = Section::where('division_id', $selectedDivision)->get();
        $this->section = '';
    }
    
    public function checkAlsoBallot(){
        if( $this->isDr == true ){
            $this->isBallot = true;
        }
    }
    
    public function saveNewUser(){
        
        if( $this->mname == ''){
            $name = $this->fname . ' ' . $this->lname;
            $this->mname = '';
        }else{
            $name = $this->fname . ' ' . $this->mname . ' ' . $this->lname;
        }

        $this->validate();
        
        $replaced = Str::replaceArray(' ', ['_'], $this->lname);
        $email = Str::lower($replaced.Str::random(3). '@example.org');
        
        $saveNewUser = User::create([
            'user_id' => Str::uuid(),
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'name' => $name,
            'email' => $email,
            
            'position' =>  $this->position,
            'division' =>  $this->division,
            'section' =>  $this->section,
            
            'is_admin' => $this->userRole,
            'is_user_mgt' =>  $this->isUserMgt,
            'is_ballot_tracking' =>  $this->isBallot,
            'is_dr' =>  $this->isDr,
            'is_gazette' =>  $this->isGazette,
            'is_motorpool' =>  $this->isMotorpool,
            
            'comelec_role' =>  $this->comelecRole,
            'barcoded_receiver' =>  $this->barcodedReceiver,
            
            'created_by_id' => Auth::user()->id,
            'created_by_name' => Auth::user()->name,
            
            'password' => Hash::make('12345678'),
            'password_string' => '12345678',
            ]);
            
            session()->flash('messageSaveNewUser', 'User Saved Successfully!');
            $this->refreshTrick();
            $this->emit('newUserAdded');
        }
        
        public function mount(){
            $this->divisionsList = Division::all();
            $this->comelecRolesList = ComelecRoles::all();
            $this->allUserCount = User::all()->count();
        }
        
        public function updated($propertyName){
            $validator = $this->validateOnly($propertyName);
            
            if( $this->isDr == true ){
                $this->isBallot = true;
            }
        }
        
        public function render()
        {
            return view('livewire.rr-user-management.rr-user-management');
        }
    }
    