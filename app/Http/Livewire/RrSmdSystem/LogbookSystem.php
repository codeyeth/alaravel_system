<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use App\Models\LogbookParent;
use App\Models\LogbookChildren;
use Auth;
use Illuminate\Support\Str;
use DB;
use Livewire\WithPagination;

class LogbookSystem extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    
    //SAVE LOGBOOK DETAILS
    public $agencyName;
    public $agencyAddress;
    public $visitingNature;
    public $clientName;
    public $logbookChildList = [];
    
    //UPDATE LOGBOOK DETAILS
    public $updateAgencyName;
    public $updateAgencyAddress;
    public $updateClientName;
    public $updateVisitingNature;
    public $updateUuid;
    
    //GET LOGBOOK CHILDREN
    public $getlogbookChildrenFor = [];
    
    public function clearSearch(){
        $this->search = '';
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }    
    
    public function refreshTrick(){
        $this->agencyName = '';
        $this->agencyAddress = '';
        $this->visitingNature = '';
        $this->clientName = '';
    }
    
    public function savetoLogbook(){
        $logbookCount = LogbookParent::count() + 1;
        $ctrlNumber = str_pad($logbookCount,6,'0',STR_PAD_LEFT);
        $saveLogbookParent = LogbookParent::create([
            'uuid' => "SMD-LOG-" . $ctrlNumber,
            'agency_name' => Str::upper($this->agencyName),
            'agency_address' => Str::upper($this->agencyAddress),
            ]
        );
        
        $saveLogbookChildren = LogbookChildren::create([
            'uuid' => $saveLogbookParent->uuid,
            'visiting_nature' => Str::upper($this->visitingNature),
            'client_name' => Str::upper($this->clientName),
            ]
        );
        
        session()->flash('messageLogbook', 'CONTROL NUMBER : ' . $saveLogbookParent->uuid .' - Details Saved Successfully!');
        $this->refreshTrick();
        $this->logbookChildList = LogbookChildren::all()->sortByDesc('id');
    }
    
    public function getChildLogbookDetails($id){
        $logbookParent = LogbookParent::find($id);
        $this->updateAgencyName = $logbookParent->agency_name;
        $this->updateAgencyAddress = $logbookParent->agency_address;
        $this->updateUuid = $logbookParent->uuid;
    }   
    
    public function updateLogbookChild(){
        $updateLogbookChildren = LogbookChildren::create([
            'uuid' => $this->updateUuid,
            'visiting_nature' => Str::upper($this->updateVisitingNature),
            'client_name' => Str::upper($this->updateClientName),
            ]
        );
        
        session()->flash('messageUpdateLogbook', 'Details Saved Successfully!');
        
        $this->updateVisitingNature = '';
        $this->updateClientName = '';
        $this->logbookChildList = LogbookChildren::all()->sortByDesc('id');
    }
    
    public function getLogbookChildren($id){
        $logbookParent = LogbookParent::find($id);
        $this->getlogbookChildrenFor = LogbookChildren::where('uuid', $logbookParent->uuid)->orderBy('id', 'DESC')->get();
    }
    
    public function mount(){
        $this->logbookChildList = LogbookChildren::all()->sortByDesc('id');
    }
    
    public function render()
    {
        return view('livewire.rr-smd-system.logbook-system', [
            'logbookList' => LogbookParent::where('uuid', 'like', '%'.$this->search.'%')
            ->orWhere('agency_name', 'like', '%'.$this->search.'%')
            ->orWhere('agency_address', 'like', '%'.$this->search.'%')
            ->orderBy('created_at', 'DESC')
            ->paginate(20),
            'logbookListCount' => LogbookParent::where('uuid', 'like', '%'.$this->search.'%')
            ->orWhere('agency_name', 'like', '%'.$this->search.'%')
            ->orWhere('agency_address', 'like', '%'.$this->search.'%')
            ->count(),
            ]);
        }
    }