<?php

namespace App\Http\Livewire\RrUserManagement;

use Livewire\Component;
use App\Models\User;
use App\Models\LoginHistory;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\ExcelExports\ExportExcelUserLoginHistory;
use App\ExcelExports\ExportExcelAllUser;
use App\Models\ComelecRoles;
use App\Models\Division;
use App\Models\Section;
use Illuminate\Support\Str;

class UserList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    //FOR SEARCH FUNCTION
    public $search = '';
    public $keywordMode = true;
    
    //CONFIRM DELETE
    public $deleteId;
    public $deleteName;
    public $isDeleteSuccess = false;
    
    //EDIT USER PROPERTIES
    public $editId;
    public $Editfname;
    public $Editmname;
    public $Editlname;
    public $Editposition;
    public $Editdivision = '';
    public $Editsection = '';
    public $EdituserRole = '';
    
    public $EditisUserMgt = false;
    public $EditisBallot = false;
    public $EditisDr = false;
    public $EditisSmdSystem = false;
    public $EditisGazette = false;
    public $EditisMotorpool = false;
    
    public $EditcomelecRole = '';
    public $EditbarcodedReceiver = '';
    
    public $EditdivisionsList = [];
    public $EditsectionsList = [];
    public $EditcomelecRolesList = [];
    public $EditbarcodedReceiverList = [];
    
    //VIEW USER PROPERTIES
    public $viewEmail;
    public $viewFname;
    public $viewMname;
    public $viewLname;
    public $viewPosition;
    public $viewDivision;
    public $viewSection;
    public $viewUserRole;
    
    public $viewIsUserMgt = false;
    public $viewIsBallot = false;
    public $viewIsDr = false;
    public $viewIsSmdSystem = false;
    public $viewIsGazette = false;
    public $viewIsMotorpool = false;
    
    public $viewComelecRole;
    public $viewBarcodedReceiver;
    
    //DISPLAY IN TABLE
    public $divisionListLoop = [];
    public $sectionListLoop = [];
    
    //REFRESH TABLES WHEN A NEW USER IS ADDED
    protected $listeners = ['refreshTable'];
    
    public $viewUserParent = [];
    
    public function clearSearch(){
        $this->search = '';
        $this->keywordMode = true;
    }
    
    public function refreshTrick(){
        $this->Editfname;
        $this->Editmname;
        $this->Editlname;
        $this->Editposition;
        $this->Editdivision = '';
        $this->Editsection = '';
        $this->EdituserRole = "";
        
        $this->EditisUserMgt = false;
        $this->EditisBallot = false;
        $this->EditisDr = false;
        $this->EditisSmdSystem = false;
        $this->EditisGazette = false;
        $this->EditisMotorpool = false;
        
        $this->EditcomelecRole = '';
        $this->EditbarcodedReceiver = '';
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function refreshTable(){
        $this->resetPage();
    }
    
    public function spitBarcodedReceiverList($comelecRole){
        $this->EditbarcodedReceiverList = ComelecRoles::where('comelec_role', '!=', $comelecRole)->get();
        $this->EditbarcodedReceiver = '';
    }

    //DIVISION - SECTION
    public function spitMatchedSection($selectedDivision){
        $this->EditsectionsList = Section::where('division_id', $selectedDivision)->get();
        $this->Editsection = '';
    }
    
    public function viewUser($userID){
        $viewUser = User::find($userID);
        
        $division = Division::where('id', $viewUser->division)->value('division');
        $section = Section::where('id', $viewUser->section)->value('section');
        
        if( $viewUser->is_admin == true){
            $viewUserRole = 'ADMINISTRATOR';
        }else{
            $viewUserRole = 'USER';
        }
        
        $this->viewEmail = Str::upper($viewUser->email);
        $this->viewFname = $viewUser->fname;
        $this->viewMname = $viewUser->mname;
        $this->viewLname = $viewUser->lname;
        $this->viewPosition = $viewUser->position;
        $this->viewDivision = Str::upper($division);
        $this->viewSection = Str::upper($section);
        $this->viewUserRole = $viewUserRole;
        $this->viewIsUserMgt = $viewUser->is_user_mgt;
        $this->viewIsBallot = $viewUser->is_ballot_tracking;
        $this->viewIsDr = $viewUser->is_dr;
        $this->viewIsSmdSystem = $viewUser->is_smd_system;
        $this->viewIsGazette = $viewUser->is_gazette;
        $this->viewIsMotorpool = $viewUser->is_motorpool;
        $this->viewComelecRole = $viewUser->comelec_role;
        $this->viewBarcodedReceiver = $viewUser->barcoded_receiver;
    }
    
    //EXPORT USER LOGIN/LOGOUT HISTORY
    public function exportUserLoginHistory($userId){
        $userResult = User::find($userId);   
        $export = new ExportExcelUserLoginHistory($userId);
        return Excel::download($export, $userResult->name . '_login_history.xlsx');
    }
    
    //EXPORT ALL USER DETAILS
    public function exportAllUser(){
        $export = new ExportExcelAllUser();
        return Excel::download($export, 'all_users.xlsx');
    }
    
    //RETRIEVE USER DETAILS FOR EDITING
    public function modalEdit($userID){
        $modalEdit = User::find($userID);   
        $this->EditsectionsList = Section::where('division_id', $modalEdit->division)->get();
        $this->EditbarcodedReceiverList = ComelecRoles::where('comelec_role', '!=', $this->EditcomelecRole)->get();
        
        $this->editId = $userID;
        $this->Editfname = $modalEdit->fname;
        $this->Editmname = $modalEdit->mname;
        $this->Editlname = $modalEdit->lname;
        
        $this->Editposition = $modalEdit->position;
        $this->Editdivision = $modalEdit->division;
        $this->Editsection = $modalEdit->section;
        $this->EdituserRole = $modalEdit->is_admin;
        
        $this->EditisUserMgt = $modalEdit->is_user_mgt;
        $this->EditisBallot = $modalEdit->is_ballot_tracking;
        $this->EditisDr = $modalEdit->is_dr;
        $this->EditisSmdSystem = $modalEdit->is_smd_system;
        $this->EditisGazette = $modalEdit->is_gazette;
        $this->EditisMotorpool = $modalEdit->is_motorpool;
        
        $this->EditcomelecRole = $modalEdit->comelec_role;
        $this->EditbarcodedReceiver = $modalEdit->barcoded_receiver;
    }
    
    //UPDATE USER DETAILS
    public function updateUser($userID){
        $updateUser = User::find($userID);
        
        if( $this->Editmname == ''){
            $name = $this->Editfname . ' ' . $this->Editlname;
            $this->Editmname = '';
        }else{
            $name = $this->Editfname . ' ' . $this->Editmname . ' ' . $this->Editlname;
        }
        
        if( $this->EditisBallot == false){
            $this->EditcomelecRole = "";
            $this->EditbarcodedReceiver = "";
        }
        
        if($this->EdituserRole == 2){
            $userRoleSA = true;
            $userRole = true;
        }else{
            $userRoleSA = false;
            $userRole = $this->EdituserRole;
        }
        
        $updateUser->update([
            'fname' =>  Str::upper($this->Editfname),
            'mname' => Str::upper($this->Editmname),
            'lname' => Str::upper($this->Editlname),
            'name' => Str::upper($name),
            'position' => $this->Editposition,
            'division' => $this->Editdivision,
            'section' => $this->Editsection,
            
            'is_super_admin' => $userRoleSA,
            'is_admin' => $userRole,
            
            'is_user_mgt' => $this->EditisUserMgt,
            'is_ballot_tracking' => $this->EditisBallot,
            'is_dr' => $this->EditisDr,
            'is_smd_system' => $this->EditisSmdSystem,
            'is_gazette' => $this->EditisGazette,
            'is_motorpool' => $this->EditisMotorpool,
            
            'comelec_role' => Str::upper($this->EditcomelecRole),
            'barcoded_receiver' => Str::upper($this->EditbarcodedReceiver),
            ]
        );
        
        session()->flash('messageEditUser', 'User Updated Successfully!');
    }
    
    //CONFIRM USER DELETE
    public function confirmDeleteUser($id){
        $this->deleteId = '';
        $this->deleteName = '';
        $this->isDeleteSuccess = false;
        $userDelete = User::find($id);
        $this->deleteId = $id;
        $this->deleteName = $userDelete->name;
    }
    
    // DELETE USER
    public function deleteUser($userID){
        $userDelete = User::find($userID);
        $userDelete->delete();
        session()->flash('messageDeleteUser', 'User Deleted Successfully!');
        $this->isDeleteSuccess = true;
        $this->refreshTrick();
        $this->resetPage();
    }
    
    public function mount(){
        //EDIT USER DETAILS
        $this->EditdivisionsList = Division::all();
        $this->EditsectionsList = Section::all();
        $this->EditcomelecRolesList = ComelecRoles::all();
        
        //DISPLAY IN TABLE
        $this->divisionListLoop = Division::all();
        $this->sectionListLoop = Section::all();
    }
    
    public function render()
    {
        if($this->keywordMode == true){
            
            return view('livewire.rr-user-management.user-list', [
                'userList' => User::where('name', 'like', '%'.$this->search.'%')
                ->orWhere('position', 'like', '%'.$this->search.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
                'userListCount' => User::where('name', 'like', '%'.$this->search.'%')
                ->orWhere('position', 'like', '%'.$this->search.'%')
                ->orderBy('created_at', 'DESC')
                ->count(),
                ]
            );
        }
        
        if($this->keywordMode == false){
            return view('livewire.rr-user-management.user-list', [
                'userList' => User::where('created_at', 'like', '%'.$this->search.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
                'userListCount' => User::where('created_at', 'like', '%'.$this->search.'%')
                ->orderBy('created_at', 'DESC')
                ->count(),
                ]
            );
        }
        
    }
}