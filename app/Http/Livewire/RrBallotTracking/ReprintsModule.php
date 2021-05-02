<?php

namespace App\Http\Livewire\RrBallotTracking;

use Livewire\Component;
use App\Models\Ballots;
use App\Models\BallotHistory;
use App\Models\BadBallots;
use App\Models\RePrintBatch;
use App\Models\User;
use Auth;
use Livewire\WithPagination;
use Carbon\Carbon;
use DB;

class ReprintsModule extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    public $batchMode = false;
    public $batchList = [];
    public $batchCount;
    
    protected $listeners = ['refreshReprintModule'];
    
    public function refreshReprintModule(){
        $this->resetPage();
    }
    
    public function clearSearch(){
        $this->search = '';
    }
    
    public function updatedKeywordMode()
    {
        $this->search = '';
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function addToBatchList($id){
        $this->hideAddBtn = false;
        $batchDetails = BadBallots::find($id);
        $this->batchList[] =  ['id' => $batchDetails->id, 'ballot_id' => $batchDetails->ballot_id, 'unique_number' => $batchDetails->unique_number,];
        
        $this->dispatchBrowserEvent('addToBatchList', ['btnID' => $id]);
    }
    
    public function removeFromBatchList($index, $id)
    {
        unset($this->batchList[$index]);
        $this->batchList = array_values($this->batchList);
        
        $this->dispatchBrowserEvent('removeFromBatchList', ['btnID' => $id]);
    }
    
    public function resetRePrints(){
        foreach( $this->batchList as $batch_list ){
            $this->dispatchBrowserEvent('removeFromBatchList', ['btnID' => $batch_list['id']]);
        }
        $this->batchList = [];
        $this->batchMode = false;
        $this->resetPage();
    }
    
    public function saveRePrint(){
        $now = Carbon::now();
        $batchContent = count($this->batchList);
        $addBatchRecord = RePrintBatch::create([
            'batch_count' => $this->batchCount,
            'batch_content' => $batchContent,
            'created_by_id' => Auth::user()->id,
            'created_by_name' => Auth::user()->name,
            ]
        );
        
        foreach( $this->batchList as $batch_list ){
            $updateBadBallots = BadBallots::find($batch_list['id']);
            $updateBadBallots->update([
                'reprint_batch' => $this->batchCount,
                'reprint_batch_by_id' => Auth::user()->id,
                'reprint_batch_by' => Auth::user()->name,
                'reprint_batch_at' => $now,
                ]
            );
        }
        
        session()->flash('messageReprint', 'Batch No. ' . $this->batchCount . ' Successfully Created.');
        $this->resetRePrints();
    }
    
    public function mount(){
        $this->batchCount = RePrintBatch::count() + 1;
    }
    
    public function render()
    {
        
        if( $this->batchMode ==  true ){
            return view('livewire.rr-ballot-tracking.reprints-module', [
                'reprintBallotList' => BadBallots::where('reprint_batch', null)->
                orderBy('created_at', 'DESC')->get(),
                'reprintBallotListCount' =>  BadBallots::where('reprint_batch', null)->
                orderBy('created_at', 'DESC')->
                count(),
                ]
            );
        }
        
        
        if( $this->batchMode ==  false ){
            return view('livewire.rr-ballot-tracking.reprints-module', [
                'reprintBallotList' => BadBallots::where('ballot_id', 'like', '%'.$this->search.'%')->
                orWhere('unique_number', 'like', '%'.$this->search.'%')->
                orWhere('description', 'like', '%'.$this->search.'%')->
                orWhere('created_by_name', 'like', '%'.$this->search.'%')->
                orWhere('reprint_batch', 'like', '%'.$this->search.'%')->
                orderBy('created_at', 'DESC')->
                paginate(10),
                'reprintBallotListCount' =>  BadBallots::where('ballot_id', 'like', '%'.$this->search.'%')->
                orWhere('unique_number', 'like', '%'.$this->search.'%')->
                orWhere('description', 'like', '%'.$this->search.'%')->
                orWhere('created_by_name', 'like', '%'.$this->search.'%')->
                orWhere('reprint_batch', 'like', '%'.$this->search.'%')->
                orderBy('created_at', 'DESC')->
                count(),
                ]
            );
        }
        
        
    }
}