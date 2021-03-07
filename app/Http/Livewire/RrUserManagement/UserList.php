<?php

namespace App\Http\Livewire\RrUserManagement;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    
    //USER DETAIL IN MODAL VIEW
    public $userID;
    public $name;
    public $position;
    public $division;
    public $section;
    public $is_user_mgt;
    public $is_ballot_tracking;
    public $is_dr;
    public $is_gazette;
    public $is_motorpool;
    
    public function modalUserDetail($userID){
        $modalUser = User::find($userID);   
        $this->name = $modalUser->name;
        $this->position = $modalUser->position;
        $this->division = $modalUser->division;
        $this->section = $modalUser->section;
        $this->is_user_mgt = $modalUser->is_user_mgt;
        $this->is_ballot_tracking = $modalUser->is_ballot_tracking;
        $this->is_dr = $modalUser->is_dr;
        $this->is_gazette = $modalUser->is_gazette;
        $this->is_motorpool = $modalUser->is_motorpool;
    }
    
    public function mount(){
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.rr-user-management.user-list', [
            'userList' => User::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('position', 'like', '%'.$this->search.'%')
            ->orWhere('division', 'like', '%'.$this->search.'%')
            ->orWhere('section', 'like', '%'.$this->search.'%')
            ->paginate(5),
            ]);
        }
    }