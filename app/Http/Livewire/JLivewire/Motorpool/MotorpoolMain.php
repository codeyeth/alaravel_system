<?php

namespace App\Http\Livewire\JLivewire\Motorpool;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Motorpool;
use App\Models\Division;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;



class MotorpoolMain extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    // public $requestCount;
    public $pendingRequestList = [];
    
    public $search = '';
    public $statusfilter = '';
    public $datefilter = '';
    public $accessTable;
    public $status_letter, $user_id_letter;

    public $user_id, $file;
    public $reason, $action, $status;
    public $output;
    public $divisionsList = [];
    public $sectionsList = [];

    public function edit($id)
    {
        $user = Motorpool::where('id',$id)->first();
        $this->user_id = $id;
    }
    public function editletter($id)
    {
        $user = Motorpool::where('id',$id)->first();
        $this->user_id_letter = $id;
    }
    public function spitMatchedSection($selectedDivision){
        $this->sectionsList = Section::where('division_id', $selectedDivision)->get();
    }

    public function ChangeStatusBasedOnValue($value){
        if ($value == 2){
            $this->status = 'APPROVED';
        }else{
            $this->status = 'DISSAPPROVED' ;
        }
    }  
   

    private function resetInputFields(){
        $this->reason = '';
        $this->action = '0';
        $this->status = 'PENDING';
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
       
  
        $user = Motorpool::find($this->user_id);
            $user->update([
                'reason' => $this->reason,
                'is_approved' => $this->action,
                'status' => $this->status,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Request Updated Successfully.');
            $this->resetInputFields();
            
    }
    public function updateletter()
    {
        $this->validate([
            'file' => 'required|mimes:pdf,png,jpg|max:2048',
        ]);
        
        $filenameWithExt = $this->file->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $this->file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;

        
        $this->file->storeAs('public/motorpool_letter',$fileNameToStore);
       
            $user = Motorpool::find($this->user_id_letter);
            $user->update([
                'is_approved' => 1,
                'status' => 'WAITING',
                'reason' => 'Signed Copy has been Submitted. Please Wait for the Approval',
                'signature_file' => $fileNameToStore,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Request Updated Successfully.');
            $this->resetInputFields();
            
    }
    
    
    public function mount(){
        $this->divisionsList = Division::all();
        $this->status = 'PENDING';
        $this->action = '0';
        
    
        // $this->requestList = AddRequest::where('is_approved', false)->orderBy('created_at', 'desc')->get();
        // dd(count($this->requestList));
        
        if($this->accessTable == false){
            // $this->pendingRequestList = AddRequest::where('is_approved', 0)->orderBy('created_at', 'DESC')->paginate(10);
            $this->pendingRequestList = Motorpool::all();
        }
        // $this->requestCount = AddRequest::count();
        // dd($this->requestList);
    }


    public function render()
    {
        $select_all_motorpool_query = DB::table('motorpools');

     


        if($this->search == '' && $this->statusfilter == '' && $this->datefilter == ''){
            $requestList = DB::table('motorpools')->paginate(5);
            $requestthis = '';
          
         
        }elseif($this->search != '' && $this->statusfilter == '' && $this->datefilter == '' ){
            $querystring = Motorpool::Where('request_id', 'like', '%'.$this->search.'%')->
            orWhere('emp_name', 'like', '%'.$this->search.'%')->
            orWhere('division_chief', 'like', '%'.$this->search.'%')->
            orWhere('destination', 'like', '%'.$this->search.'%')->
            orWhere('purpose', 'like', '%'.$this->search.'%')->
            orWhere('division', 'like', '%'.$this->search.'%')->
            orWhere('section', 'like', '%'.$this->search.'%');
            $requestList = (clone $querystring)->paginate(5);
            $requestthis = 'Search Result Found: '. (clone $querystring)->count();
        }elseif($this->search != '' && $this->statusfilter != '' && $this->datefilter == '' ){
            $querystring= Motorpool::where(function ($query) { 
                $query->where('is_approved',$this->statusfilter); 
            })->where(function ($query) {$query->Where('request_id', 'like', '%'.$this->search.'%')->
                orWhere('emp_name', 'like', '%'.$this->search.'%')->
                orWhere('division_chief', 'like', '%'.$this->search.'%')->
                orWhere('destination', 'like', '%'.$this->search.'%')->
                orWhere('purpose', 'like', '%'.$this->search.'%')->
                orWhere('division', 'like', '%'.$this->search.'%')->
                orWhere('section', 'like', '%'.$this->search.'%');});
                $requestList = (clone $querystring)->paginate(5);
                $requestthis = 'Search Result Found: '. (clone $querystring)->count();
        }elseif($this->search != '' && $this->statusfilter == '' && $this->datefilter != '' ){
            $querystring = Motorpool::where(function ($query) { 
                $query->where('date',$this->datefilter); 
            })->where(function ($query) {$query->Where('request_id', 'like', '%'.$this->search.'%')->
                orWhere('emp_name', 'like', '%'.$this->search.'%')->
                orWhere('division_chief', 'like', '%'.$this->search.'%')->
                orWhere('destination', 'like', '%'.$this->search.'%')->
                orWhere('purpose', 'like', '%'.$this->search.'%')->
                orWhere('division', 'like', '%'.$this->search.'%')->
                orWhere('section', 'like', '%'.$this->search.'%');});
                $requestList = (clone $querystring)->paginate(5);
                $requestthis = 'Search Result Found: '. (clone $querystring)->count();
        }elseif($this->search == '' && $this->statusfilter != '' && $this->datefilter == '' ){
            $querystring = Motorpool::where('is_approved', $this->statusfilter);
            $requestList = (clone $querystring)->paginate(5);
            $requestthis = 'Search Result Found: '. (clone $querystring)->count();
        }elseif($this->search == '' && $this->statusfilter == '' && $this->datefilter != '' ){
            $querystring = Motorpool::where('date', $this->datefilter);
            $requestList = (clone $querystring)->paginate(5);
            $requestthis = 'Search Result Found: '. (clone $querystring)->count();
        }elseif($this->search == '' && $this->statusfilter != '' && $this->datefilter != '' ){
            $querystring = Motorpool::where('date', $this->datefilter)->where('is_approved', $this->statusfilter);
            $requestList = (clone $querystring)->paginate(5);
            $requestthis = 'Search Result Found: '. (clone $querystring)->count();
        }elseif($this->search == '' && $this->statusfilter != '' && $this->datefilter != '' ){
            $querystring = Motorpool::where('date', $this->datefilter)->where('is_approved', $this->statusfilter);
            $requestList = (clone $querystring)->paginate(5);
            $requestthis = 'Search Result Found: '. (clone $querystring)->count();
        }else{
            $querystring = Motorpool::where(function ($query) { 
                $query->where('date',$this->datefilter)->where('is_approved',$this->statusfilter); 
            })->where(function ($query) {$query->Where('request_id', 'like', '%'.$this->search.'%')->
                orWhere('emp_name', 'like', '%'.$this->search.'%')->
                orWhere('division_chief', 'like', '%'.$this->search.'%')->
                orWhere('destination', 'like', '%'.$this->search.'%')->
                orWhere('purpose', 'like', '%'.$this->search.'%')->
                orWhere('division', 'like', '%'.$this->search.'%')->
                orWhere('section', 'like', '%'.$this->search.'%');});
                $requestList = (clone $querystring)->paginate(5);
                $requestthis = 'Search Result Found: '. (clone $querystring)->count();
        }
        return view('livewire.j-livewire.motorpool.motorpool-main',compact('select_all_motorpool_query','requestList','requestthis')); 
        }
   
}
