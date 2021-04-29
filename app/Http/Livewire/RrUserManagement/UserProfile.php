<?php

namespace App\Http\Livewire\RrUserManagement;

use Livewire\Component;

use App\Models\User;
use App\Models\Division;
use App\Models\Section;
use App\Models\LoginHistory;
use Auth;

class UserProfile extends Component
{
    public $user_id;
    public $division;
    public $section;
    public $userRole;
    public $userDetails;
    public $lastSeenOnDate = [];
    
    public function mount(){
        $this->userDetails = User::find($this->user_id);
        
        //EDIT USER DETAILS
        $this->division = Division::where('id', $this->userDetails->division)->value('division');
        $this->section = Section::where('id', $this->userDetails->section)->value('section');
        
        if($this->userDetails->is_super_admin == true ){
            $this->userRole = 'SUPER ADMINISTRATOR';
        }else{
            if($this->userDetails->is_admin == true ){
                $this->userRole = 'ADMINISTRATOR';
            }
            
            if($this->userDetails->is_admin == false ){
                $this->userRole = 'USER';
            }
        }

        $this->lastSeenOnDate = LoginHistory::where('user_id', $this->user_id)->orderBy('id', 'DESC')->limit(1)->get();
    }
    
    public function render()
    {
        return view('livewire.rr-user-management.user-profile');
    }
}
