<?php

namespace App\Http\Livewire\RrUserManagement;

use Livewire\Component;
use App\Models\User;
use App\Models\LoginHistory;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\ExcelExports\ExportExcelUserLoginHistory;
use App\ExcelExports\ExportExcelAllUser;

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
    public $is_admin;
    public $is_user_mgt;
    public $is_ballot_tracking;
    public $is_dr;
    public $is_gazette;
    public $is_motorpool;
    
    public $comelec_role;
    public $barcoded_receiver;
    
    public function modalUserDetail($userID){
        $modalUser = User::find($userID);   
        $this->userID = $userID;
        $this->name = $modalUser->name;
        $this->position = $modalUser->position;
        $this->division = $modalUser->division;
        $this->section = $modalUser->section;
        $this->is_admin = $modalUser->is_admin;
        $this->is_user_mgt = $modalUser->is_user_mgt;
        $this->is_ballot_tracking = $modalUser->is_ballot_tracking;
        $this->is_dr = $modalUser->is_dr;
        $this->is_gazette = $modalUser->is_gazette;
        $this->is_motorpool = $modalUser->is_motorpool;
        $this->comelec_role = $modalUser->comelec_role;
        $this->barcoded_receiver = $modalUser->barcoded_receiver;
    }
    
    //Export User Login/Logout History
    public function exportUserLoginHistory($userId){
        $userResult = User::find($userId);   
        $export = new ExportExcelUserLoginHistory($userId);
        return Excel::download($export, $userResult->name . '_login_history.xlsx');
    }
    
    //Export All User Details
    public function exportAllUser(){
        $export = new ExportExcelAllUser();
        return Excel::download($export, 'all_users.xlsx');
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