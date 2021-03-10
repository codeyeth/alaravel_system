<?php

namespace App\Http\Livewire\RrUserManagement;

use Livewire\Component;
use App\Models\Division;
use App\Models\Section;
use App\Models\ComelecRoles;

class EditUser extends Component
{
    public $post;
    
    public $fname;
    public $mname;
    public $lname;
    public $position;
    public $userRole;
    //ROLES
    public $is_user_mgt;
    public $is_ballot_tracking;
    public $is_dr;
    public $is_gazette;
    public $is_motorpool;
    
    public $divisionsList = [];
    public $sectionsList = [];
    public $comelecRolesList = [];
    public $selectedDivision = null;
    public $selectedSection = null;
    public $selectedComelecRole = null;
    public $selectedBarcodedReceiver = null;
    public $selected = null;
    
    
    protected $rules = [
        'fname' => 'required|max:15|regex:/^[\pL\s\-]+$/u',
        'mname' => 'max:15|regex:/^[\pL\s\-]+$/u',
        'lname' => 'required|max:15|regex:/^[\pL\s\-]+$/u',
        'position' => 'required|max:25|regex:/^[a-zA-Z0-9\s]+$/',
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
        'position.max' => 'Position may not be greater than 15 characters',
        'position.regex' => 'Position may only contain letters and numbers',
    ];
    
    public function spitMatchedSection($selectedDivision){
        $this->sectionsList = Section::where('division_id', $selectedDivision)->get();
    }
    
    public function mount(){
        $this->divisionsList = Division::all();
        $this->fname = $this->post->fname;
        $this->mname = $this->post->mname;
        $this->lname = $this->post->lname;
        $this->position = $this->post->position;
        
        $this->selectedDivision = Division::where('division', $this->post->division)->value('id');
        $this->sectionsList = Section::where('division_id', $this->selectedDivision)->get();
        $this->comelecRolesList = ComelecRoles::all();
        $this->selectedComelecRole = $this->post->comelec_role ;
        $this->selectedBarcodedReceiver = $this->post->barcoded_receiver ;
        // dd($this->post->barcoded_receiver);
        
        $this->selectedSection = Section::where('division_id', $this->selectedDivision)->where('section', $this->post->section)->value('id');
        $this->userRole = $this->post->user_role;
        $this->is_user_mgt = $this->post->is_user_mgt;
        $this->is_ballot_tracking = $this->post->is_ballot_tracking;
        $this->is_dr = $this->post->is_dr;
        $this->is_gazette = $this->post->is_gazette;
        $this->is_motorpool = $this->post->is_motorpool;
    }
    
    public function updated($propertyName){
        $validator = $this->validateOnly($propertyName);
    }
    
    public function render()
    {
        return view('livewire.rr-user-management.edit-user');
    }
}