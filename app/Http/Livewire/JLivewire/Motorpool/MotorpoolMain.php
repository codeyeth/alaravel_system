<?php

namespace App\Http\Livewire\JLivewire\Motorpool;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Motorpool;
use Illuminate\Support\Facades\DB;

class MotorpoolMain extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    // public $requestCount;
    public $pendingRequestList = [];
    
    public $search = '';
    public $accessTable;

    public $user_id;
    public $reason, $action;
    public $output;

    public function edit($id)
    {
        $user = Motorpool::where('id',$id)->first();
        $this->user_id = $id;
        $this->reason = $user->reason;
     

    }


    private function resetInputFields(){
        $this->reason = '';
        $this->action = '';
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
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Request Updated Successfully.');
            $this->resetInputFields();
    }
    
    
    public function mount(){
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
        // return view('livewire.request-form.request-list');
        
        return view('livewire.j-livewire.motorpool.motorpool-main', [
            'requestList' => Motorpool::
            where('is_approved', true)->
            orWhere('request_id', 'like', '%'.$this->search.'%')->
            orWhere('emp_name', 'like', '%'.$this->search.'%')->
            orWhere('division_chief', 'like', '%'.$this->search.'%')->
            orWhere('destination', 'like', '%'.$this->search.'%')->
            orWhere('date', 'like', '%'.$this->search.'%')->
            orWhere('purpose', 'like', '%'.$this->search.'%')->
            where('is_approved', true)
            ->paginate(10),
            
            ]);
            
        }
   
}
