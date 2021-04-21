<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use App\Models\CourierInfoDb;
use App\Models\CourierFiles;
use Illuminate\Support\Str;
use DB;
use Auth;
use Carbon\Carbon;

class CourierView extends Component
{
    public $courierId;
    
    public $courierName;
    public $contactNo;
    public $vehicleType;
    public $companyName;
    public $companyAddress;
    public $drNo;
    public $fileUpload;
    
    public function mount(){
        $courierData = CourierInfoDb::find($this->courierId);
        $this->courierName = $courierData->name;
        $this->contactNo = $courierData->contact_no;
        $this->companyName = $courierData->company_name;
        $this->companyAddress = $courierData->company_address;
        $this->vehicleType = $courierData->vehicle_type;
        $this->drNo = $courierData->dr_no;
        
        $courierFileData = CourierFiles::where('belongs_to', $courierData->file_id)->first();
        $this->fileUpload = $courierFileData->converted_filename;
    }
    
    public function render()
    {
        return view('livewire.rr-smd-system.courier-view');
    }
}
