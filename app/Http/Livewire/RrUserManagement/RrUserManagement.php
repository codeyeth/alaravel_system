<?php

namespace App\Http\Livewire\RrUserManagement;

use Livewire\Component;
use App\Models\Division;
use App\Models\Section;

class RrUserManagement extends Component
{
    public $fname;
    public $mname;
    public $lname;
    public $position;
    
    public $divisionsList = [];
    public $sectionsList = [];
    public $selectedDivision = null;
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
    }
    
    public function updated($propertyName){
        $validator = $this->validateOnly($propertyName);
    }
    
    public function render()
    {
        return view('livewire.rr-user-management.rr-user-management');
    }
}
