<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CourierInfoDb;
use App\Models\CourierFiles;
use Illuminate\Support\Str;
use DB;
use Auth;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class CourierInfoDatabase extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    
    public $courierAddMode = true;
    public $courierId;
    public $search = '';
    
    //FILE UPLOAD WHEN EDITING
    public $edit_currentFileUpload = [];
    public $hasFile = false;
    
    // COURIER DETAILS
    public $courierName;
    public $contactNo;
    public $vehicleType;
    public $companyName;
    public $companyAddress;
    public $drNo;
    public $fileUpload;
    
    public function clearSearch(){
        $this->search = '';
    }
    
    public function refreshTrick(){
        $this->courierName = '';
        $this->contactNo = '';
        $this->vehicleType = '';
        $this->companyName = '';
        $this->companyAddress = '';
        $this->drNo = '';
        $this->fileUpload = '';
        
        $this->courierAddMode = true;
        $this->courierId = '';
        $this->hasFile = false;
        $this->edit_currentFileUpload = [];
        
        $this->dispatchBrowserEvent('clear-file');
    }
    
    public function updatedFileUpload(){
        $validated = $this->validate([
            'fileUpload' => 'mimes:pdf|max:20480', // 50MB Max 1024 * 50 = 51200
            ]
        );
    }
    
    public function saveCourierData(){
        $now = Carbon::now();
        
        $validated = $this->validate([
            'fileUpload' => 'mimes:pdf|max:20480', // 50MB Max 1024 * 20 = 20480
            ]
        );
        
        $updateCourierData = CourierInfoDb::create([
            'name' => Str::upper($this->courierName),
            'contact_no' => Str::upper($this->contactNo),
            'company_name' => Str::upper($this->companyName),
            'company_address' => Str::upper($this->companyAddress),
            'vehicle_type' => Str::upper($this->vehicleType),
            'dr_no' => $this->drNo,
            'file_id' => Str::uuid(),
            'created_by_id' => Auth::user()->id,
            'created_by_name' => Auth::user()->name,
            ]
        );
        
        $addCourierFiles = CourierFiles::create([
            'belongs_to' => $updateCourierData->file_id,
            'original_filename' => $this->fileUpload->getClientOriginalName(),
            'converted_filename' => Str::slug($updateCourierData->name) . '-' . $updateCourierData->file_id  . '.pdf',
            'filetype' => $this->fileUpload->getClientOriginalExtension(),
            'filesize' => $this->fileUpload->getSize(),
            ]
        );
        
        $this->fileUpload->storeAs('public/courier_files', $addCourierFiles->converted_filename);
        
        session()->flash('messageCourier', 'Courier Details Saved Successfully!');
        $this->refreshTrick();
    }
    
    public function editCourierData($id){
        $this->courierAddMode = false;
        $this->courierId = $id;
        $courierData = CourierInfoDb::find($id);
        $this->courierName = $courierData->name;
        $this->contactNo = $courierData->contact_no;
        $this->companyName = $courierData->company_name;
        $this->companyAddress = $courierData->company_address;
        $this->vehicleType = $courierData->vehicle_type;
        $this->drNo = $courierData->dr_no;
        
        $postEditFile = CourierFiles::where('belongs_to', $courierData->file_id)->get();
        $this->edit_currentFileUpload = $postEditFile;
    }
    
    public function updateCourierData($id){
        if( $this->hasFile == true ){
            $validated = $this->validate([
                'fileUpload' => 'mimes:pdf|max:20480', // 50MB Max 1024 * 20 = 20480
                ]
            );
        }
        
        $updateCourierData = CourierInfoDb::find($id);
        $updateCourierData->update([
            'name' => Str::upper($this->courierName),
            'contact_no' => Str::upper($this->contactNo),
            'company_name' => Str::upper($this->companyName),
            'company_address' => Str::upper($this->companyAddress),
            'vehicle_type' => Str::upper($this->vehicleType),
            'dr_no' => $this->drNo,
            ]
        );
        
        if ($this->fileUpload != null) {
            $deleteCurrentFile = CourierFiles::where('belongs_to', $updateCourierData->file_id)->value('id');
            if($deleteCurrentFile != null){
                $deleteCurrentFile = CourierFiles::find($deleteCurrentFile);
                $deleteCurrentFile->delete();
            }
            
            $addCourierFiles = CourierFiles::create([
                'belongs_to' => $updateCourierData->file_id,
                'original_filename' => $this->fileUpload->getClientOriginalName(),
                'converted_filename' => Str::slug($updateCourierData->name) . '-' . $updateCourierData->file_id  . '.pdf',
                'filetype' => $this->fileUpload->getClientOriginalExtension(),
                'filesize' => $this->fileUpload->getSize(),
                ]
            );
            
            $this->fileUpload->storeAs('public/courier_files', $addCourierFiles->converted_filename);
        }
        session()->flash('messageCourier', 'Courier Details Updated Successfully!');
        $this->refreshTrick();
    }
    
    public function deleteCourierData($id){
        $postDelete = CourierInfoDb::find($id);
        $postDelete->delete();
        
        session()->flash('messageCourier', 'Deleted Successfully!');
        $this->refreshTrick();
    }
    
    public function render()
    {
        return view('livewire.rr-smd-system.courier-info-database', [
            'courierList' => CourierInfoDb::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('contact_no', 'like', '%'.$this->search.'%')
            ->orWhere('company_name', 'like', '%'.$this->search.'%')
            ->orWhere('company_address', 'like', '%'.$this->search.'%')
            ->orWhere('vehicle_type', 'like', '%'.$this->search.'%')
            ->orWhere('file_id', 'like', '%'.$this->search.'%')
            ->orWhere('dr_no', 'like', '%'.$this->search.'%')
            ->orWhere('created_by_name', 'like', '%'.$this->search.'%')
            ->orderBy('created_at', 'DESC')
            ->paginate(20),
            'courierListCount' => CourierInfoDb::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('contact_no', 'like', '%'.$this->search.'%')
            ->orWhere('company_name', 'like', '%'.$this->search.'%')
            ->orWhere('company_address', 'like', '%'.$this->search.'%')
            ->orWhere('vehicle_type', 'like', '%'.$this->search.'%')
            ->orWhere('file_id', 'like', '%'.$this->search.'%')
            ->orWhere('dr_no', 'like', '%'.$this->search.'%')
            ->orWhere('created_by_name', 'like', '%'.$this->search.'%')
            ->orderBy('created_at', 'DESC')
            ->count(),
            ]);
            
        }
    }
    