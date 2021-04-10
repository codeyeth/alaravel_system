<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use App\Models\ClientDatabase;
use Illuminate\Support\Str;
use DB;
use Auth;

class ClientDatabaseModule extends Component
{
    public $clientAddMode = true;
    public $clientId;
    public $search = '';
    
    //CLIENT DETAILS
    public $agencyName;
    public $agencyAddress;
    public $region;
    public $contactPerson;
    public $contactNo;
    public $emailAddress;
    
    public function clearSearch(){
        $this->search = '';
    }
    
    public function refreshTrick(){
        $this->agencyName = '';
        $this->agencyAddress = '';
        $this->contactPerson = '';
        $this->contactNo = '';
        $this->emailAddress = '';
        $this->clientAddMode = true;
    }
    
    public function saveClientData(){
        $clientCount = ClientDatabase::count() + 1;
        $ctrlNumber = str_pad($clientCount,6,'0',STR_PAD_LEFT);
        $saveLogbookParent = ClientDatabase::create([
            'agency_code' => "CLIENT-" . $ctrlNumber,
            'agency_name' => Str::upper($this->agencyName),
            'agency_address' => Str::upper($this->agencyAddress),
            'region' => Str::upper($this->region),
            'contact_person' => Str::upper($this->contactPerson),
            'contact_no' => $this->contactNo,
            'email' => Str::upper($this->emailAddress),
            'created_by_id' => Auth::user()->id,
            'created_by_name' => Str::upper(Auth::user()->name),
            ]);
            
            session()->flash('messageClient', 'Client Data Saved Successfully!');
            $this->refreshTrick();
        }
        
        public function editClientData($clientId){
            $this->clientAddMode = false;
            $this->clientId = $clientId;
            $clientData = ClientDatabase::find($clientId);
            $this->agencyName = $clientData->agency_name;
            $this->agencyAddress = $clientData->agency_address;
            $this->region = $clientData->region;
            $this->contactPerson = $clientData->contact_person;
            $this->contactNo = $clientData->contact_no;
            $this->emailAddress = $clientData->email;
        }
        
        public function updateClientData($clientId){
            $updateClientData = ClientDatabase::find($clientId);
            $updateClientData->update([
                'agency_name' => Str::upper($this->agencyName),
                'agency_address' => Str::upper($this->agencyAddress),
                'region' => Str::upper($this->region),
                'contact_person' => Str::upper($this->contactPerson),
                'contact_no' => $this->contactNo,
                'email' => Str::upper($this->emailAddress),
                ]);
                
                session()->flash('messageClient', 'Client Data Updated Successfully!');
                $this->refreshTrick();
            }
            
            public function deleteClientData($clientId){
                $postDelete = ClientDatabase::find($clientId);
                $postDelete->delete();
                
                session()->flash('messageClient', 'Deleted Successfully!');
                $this->refreshTrick();
            }
            
            public function render()
            {
                return view('livewire.rr-smd-system.client-database-module', [
                    'clientList' => ClientDatabase::where('agency_code', 'like', '%'.$this->search.'%')
                    ->orWhere('agency_name', 'like', '%'.$this->search.'%')
                    ->orWhere('agency_address', 'like', '%'.$this->search.'%')
                    ->orWhere('region', 'like', '%'.$this->search.'%')
                    ->orWhere('contact_person', 'like', '%'.$this->search.'%')
                    ->orWhere('contact_no', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10),
                    'clientListCount' => ClientDatabase::where('agency_code', 'like', '%'.$this->search.'%')
                    ->orWhere('agency_name', 'like', '%'.$this->search.'%')
                    ->orWhere('agency_address', 'like', '%'.$this->search.'%')
                    ->orWhere('region', 'like', '%'.$this->search.'%')
                    ->orWhere('contact_person', 'like', '%'.$this->search.'%')
                    ->orWhere('contact_no', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orderBy('created_at', 'DESC')
                    ->count(),
                    ]);
                }
            }