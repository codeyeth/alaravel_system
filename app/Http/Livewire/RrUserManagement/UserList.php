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
    public $try;
    
    public $comelec_role;
    public $barcoded_receiver;
    
    //EDIT USER PROPERTIES
    public $editId;
    public $Editfname;
    public $Editmname;
    public $Editlname;
    public $Editposition;
    public $Editdivision = '';
    public $Editsection = '';
    public $EdituserRole = "";
    
    public $EditisUserMgt = false;
    public $EditisBallot = false;
    public $EditisDr = false;
    public $EditisGazette = false;
    public $EditisMotorpool = false;
    
    public $EditcomelecRole = '';
    public $EditbarcodedReceiver = '';
    
    public $EditdivisionsList = [];
    public $EditsectionsList = [];
    public $EditcomelecRolesList = [];
    
    public $divisionListLoop = [];
    public $sectionListLoop = [];
    
    protected $rules = [
        'Editfname' => 'required|max:15|regex:/^[\pL\s\-]+$/u',
        'Editmname' => 'max:15|regex:/^[\pL\s\-]+$/u',
        'Editlname' => 'required|max:15|regex:/^[\pL\s\-]+$/u',
        'Editposition' => 'required|max:50|regex:/^[a-zA-Z0-9\s]+$/',
        'Editdivision' => 'required',
        'Editsection' => 'required',
        'EdituserRole' => 'required',
        
        'EditisUserMgt' => 'max:10',
        'EditisBallot' => 'max:10',
        'EditisDr' => 'max:10',
        'EditisGazette' => 'max:10',
        'EditisMotorpool' => 'max:10',
        'EditcomelecRole' => 'max:30',
        'EditbarcodedReceiver' => 'max:30',
    ];
    
    protected $messages = [
        // FIRSTNAME
        'Editfname.required' => 'First name is required',
        'Editfname.max' => 'First name may not be greater than 15 characters',
        'Editfname.regex' => 'First name may only contain letters',
        // MIDDLENAME
        'Editmname.max' => 'Middle name may not be greater than 15 characters',
        'Editmname.regex' => 'Middle name may only contain letters',
        // LASTNAME
        'Editlname.required' => 'Last name is required',
        'Editlname.max' => 'Last name may not be greater than 15 characters',
        'Editlname.regex' => 'Last name may only contain letters',
        // POSITION
        'Editposition.required' => 'Position is required',
        'Editposition.max' => 'Position may not be greater than 50 characters',
        'Editposition.regex' => 'Position may only contain letters and numbers',
    ];
    
    protected $listeners = ['refreshTable'];
    
    public $viewUserParent = [];
    
    
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
        $this->EditisGazette = false;
        $this->EditisMotorpool = false;
        
        $this->EditcomelecRole = '';
        $this->EditbarcodedReceiver = '';
    }
    
    public function spitMatchedSection($selectedDivision){
        $this->EditsectionsList = Section::where('division_id', $selectedDivision)->get();
        $this->Editsection = '';
    }
    
    public function deleteUser($userID){
        $userDelete = User::find($userID);
        $userDelete->delete();
        session()->flash('messageDeleteUser', 'User Deleted Successfully!');
        $this->refreshTrick();
        $this->resetPage();
    }
    
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
    
    public function modalEdit($userID){
        $modalEdit = User::find($userID);   
        
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
        $this->EditisGazette = $modalEdit->is_gazette;
        $this->EditisMotorpool = $modalEdit->is_motorpool;
        
        $this->EditcomelecRole = $modalEdit->comelec_role;
        $this->EditbarcodedReceiver = $modalEdit->barcoded_receiver;
    }
    
    public function checkAlsoBallot(){
        if( $this->EditisDr == true ){
            $this->EditisBallot = true;
        }
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
        
        $this->viewUserParent = [
            'viewEmail' => $viewUser->email,
            'viewFname' => $viewUser->fname,
            'viewMname' => $viewUser->mname,
            'viewLname' => $viewUser->lname,
            'viewPosition' => $viewUser->position,
            'viewDivision' => Str::upper($division),
            'viewSection' => Str::upper($section),
            'viewUserRole' => $viewUserRole,
            'viewIsUserMgt' => $viewUser->is_user_mgt,
            'viewIsBallot' => $viewUser->is_ballot_tracking,
            'viewIsDr' => $viewUser->is_dr,
            'viewIsGazette' => $viewUser->is_gazette,
            'viewIsMotorpool' => $viewUser->is_motorpool,
            'viewComelecRole' => $viewUser->comelec_role,
            'viewBarcodedReceiver' => $viewUser->barcoded_receiver,
        ];
    }
    
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
        
        $this->validate();
        
        $updateUser->update(
            [
                'fname' =>  $this->Editfname,
                'mname' => $this->Editmname,
                'lname' => $this->Editlname,
                'name' => $name,
                'position' => $this->Editposition,
                'division' => $this->Editdivision,
                'section' => $this->Editsection,
                'is_admin' => $this->EdituserRole,
                
                'is_user_mgt' => $this->EditisUserMgt,
                'is_ballot_tracking' => $this->EditisBallot,
                'is_dr' => $this->EditisDr,
                'is_gazette' => $this->EditisGazette,
                'is_motorpool' => $this->EditisMotorpool,
                
                'comelec_role' => $this->EditcomelecRole,
                'barcoded_receiver' => $this->EditbarcodedReceiver,
                ]
            );
            
            session()->flash('messageEditUser', 'User Updated Successfully!');
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
        
        public function updatingSearch()
        {
            $this->resetPage();
        }
        
        public function refreshTable(){
            $this->resetPage();
        }
        
        public function mount(){
            $this->EditdivisionsList = Division::all();
            $this->EditsectionsList = Section::all();
            $this->EditcomelecRolesList = ComelecRoles::all();
            
            $this->divisionListLoop = Division::all();
            $this->sectionListLoop = Section::all();
        }
        
        public function updated($propertyName){
            $validator = $this->validateOnly($propertyName);
            
            if( $this->EditisDr == true ){
                $this->EditisBallot = true;
            }
        }
        
        public function render()
        {
            return view('livewire.rr-user-management.user-list', [
                'userList' => User::where('name', 'like', '%'.$this->search.'%')
                ->orWhere('position', 'like', '%'.$this->search.'%')
                ->orWhere('division', 'like', '%'.$this->search.'%')
                ->orWhere('section', 'like', '%'.$this->search.'%')
                ->paginate(10),
                ]);
            }
        }