<?php

namespace App\Http\Livewire\RrBallotTracking;

use Livewire\Component;
use App\Models\Ballots;
use App\Models\BallotHistory;
use App\Models\BadBallots;
use App\Models\RePrintBatch;
use App\Models\RePrintsHistory;
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
    
    public $batchListMode = false;
    
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
        $this->batchCount = RePrintBatch::count() + 1;
    }
    
    public function removeFromBatchList($index, $id)
    {
        unset($this->batchList[$index]);
        $this->batchList = array_values($this->batchList);
        
        $this->dispatchBrowserEvent('removeFromBatchList', ['btnID' => $id]);
    }
    
    //RESET THE BATCH LIST CONTENT
    public function resetRePrints(){
        foreach( $this->batchList as $batch_list ){
            $this->dispatchBrowserEvent('removeFromBatchList', ['btnID' => $batch_list['id']]);
        }
        $this->batchList = [];
        $this->batchMode = false;
        $this->resetPage();
    }
    
    //SET THE BATCH ID TO THE BAD BALLOTS
    public function saveRePrint(){
        if(count( $this->batchList ) > 0){
            $this->batchCount = RePrintBatch::count() + 1;
            
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
                
                $unique_number = $updateBadBallots->unique_number;
                if( $updateBadBallots->re_encoded_count != null ){
                    $unique_number = $updateBadBallots->unique_number . ' - ' . $updateBadBallots->re_encoded_count;
                }
                
                //LOG TO REPRINTS HISTORY
                $reprintsHistory = RePrintsHistory::create([
                    'ballot_id' => $updateBadBallots->ballot_id,
                    'unique_number' => $unique_number,
                    'description' => $updateBadBallots->description,
                    'action' => 'ADDED TO RE-PRINT BATCH NO. ' . $this->batchCount ,
                    'date' => $now->toDateString(),
                    'created_by_id' => Auth::user()->id,
                    'created_by_name' => Auth::user()->name,
                    ]
                );
            }
            
            session()->flash('messageReprint', 'Batch No. ' . $this->batchCount . ' Successfully Created.');
            $this->resetRePrints();
        }else{
            session()->flash('error', 'EMPTY BATCH!');
            $this->resetRePrints();
        }
    }
    
    //START RE-PRINT
    public function startRePrint($id){
        $now = Carbon::now();
        
        $updateReprintBatch = RePrintBatch::find($id);
        $updateReprintBatch->update([
            'is_reprint_batch_start' => true,
            'is_reprint_batch_start_by_id' => Auth::user()->id,
            'is_reprint_batch_start_by' => Auth::user()->name,
            'is_reprint_batch_start_at' => $now,
            ]
        );
        
        $updateBadBallots = BadBallots::where('reprint_batch', $updateReprintBatch->batch_count)->get();
        foreach( $updateBadBallots as $updated_bad_ballots){
            $updateSingleBadBallots = BadBallots::find($updated_bad_ballots->id);
            $updateSingleBadBallots->update([
                'is_reprint_batch_start' => true,
                'is_reprint_batch_start_by_id' => Auth::user()->id,
                'is_reprint_batch_start_by' => Auth::user()->name,
                'is_reprint_batch_start_at' => $now,
                ]
            );
            
            $unique_number = $updated_bad_ballots->unique_number;
            if( $updated_bad_ballots->re_encoded_count != null ){
                $unique_number = $updated_bad_ballots->unique_number . ' - ' . $updated_bad_ballots->re_encoded_count;
            }
            
            //LOG TO REPRINTS HISTORY
            $reprintsHistory = RePrintsHistory::create([
                'ballot_id' => $updated_bad_ballots->ballot_id,
                'unique_number' => $unique_number,
                'description' => $updated_bad_ballots->description,
                'action' => 'STARTED THE RE-PRINT BATCH NO. ' . $updated_bad_ballots->reprint_batch ,
                'date' => $now->toDateString(),
                'created_by_id' => Auth::user()->id,
                'created_by_name' => Auth::user()->name,
                ]
            );
        }
        
        session()->flash('messageReprint', 'Batch No. ' . $updateReprintBatch->batch_count . ' Successfully Started.');
    }
    
    //REPRINT DONE
    public function doneRePrint($id){
        $now = Carbon::now();
        
        $updateReprintBatch = RePrintBatch::find($id);
        $updateReprintBatch->update([
            'is_reprint_done' => true,
            'is_reprint_done_by_id' => Auth::user()->id,
            'is_reprint_done_by' => Auth::user()->name,
            'is_reprint_done_at' => $now,
            ]
        );
        
        $updateBadBallots = BadBallots::where('reprint_batch', $updateReprintBatch->batch_count)->get();
        foreach( $updateBadBallots as $updated_bad_ballots){
            $updateSingleBadBallots = BadBallots::find($updated_bad_ballots->id);
            $updateSingleBadBallots->update([
                'is_reprint_done' => true,
                'is_reprint_done_by_id' => Auth::user()->id,
                'is_reprint_done_by' => Auth::user()->name,
                'is_reprint_done_at' => $now,
                ]
            );
            
            $unique_number = $updated_bad_ballots->unique_number;
            if( $updated_bad_ballots->re_encoded_count != null ){
                $unique_number = $updated_bad_ballots->unique_number . ' - ' . $updated_bad_ballots->re_encoded_count;
            }
            
            //LOG TO REPRINTS HISTORY
            $reprintsHistory = RePrintsHistory::create([
                'ballot_id' => $updated_bad_ballots->ballot_id,
                'unique_number' => $unique_number,
                'description' => $updated_bad_ballots->description,
                'action' => 'SET AS RE-PRINT DONE BATCH NO. ' . $updated_bad_ballots->reprint_batch ,
                'date' => $now->toDateString(),
                'created_by_id' => Auth::user()->id,
                'created_by_name' => Auth::user()->name,
                ]
            );
        }
        
        session()->flash('messageReprint', 'Batch No. ' . $updateReprintBatch->batch_count . ' Re-Print Done Successfully.');
    }
    
    //REPRINT OUTPUT GOOD
    public function successfulRePrint($id){
        $now = Carbon::now();
        
        $updateSingleBadBallots = BadBallots::find($id);
        $updateSingleBadBallots->update([
            'is_reprint_done_successful' => true,
            'is_reprint_done_successful_by_id' => Auth::user()->id,
            'is_reprint_done_successful_by' => Auth::user()->name,
            'is_reprint_done_successful_at' => $now,
            ]
        );
        
        $updateAllSameUniqueNumber = BadBallots::where( 'unique_number', $updateSingleBadBallots->unique_number )->get();
        if( count($updateAllSameUniqueNumber) > 0 ){
            foreach( $updateAllSameUniqueNumber as $same_unique_number ){
                $updateSingleUniqueNumber = BadBallots::find($same_unique_number->id);
                $updateSingleUniqueNumber->update([
                    'is_all_successful' => true,
                    ]
                );
            }
        }
        // dd( $updateAllSameUniqueNumber );
        
        $unique_number = $updateSingleBadBallots->unique_number;
        if( $updateSingleBadBallots->re_encoded_count != null ){
            $unique_number = $updateSingleBadBallots->unique_number . ' - ' . $updateSingleBadBallots->re_encoded_count;
        }
        
        //LOG TO REPRINTS HISTORY
        $reprintsHistory = RePrintsHistory::create([
            'ballot_id' => $updateSingleBadBallots->ballot_id,
            'unique_number' => $unique_number,
            'description' => $updateSingleBadBallots->description,
            'action' => 'SET AS RE-PRINT OUTPUT SUCCESSFUL BATCH NO. ' . $updateSingleBadBallots->reprint_batch ,
            'date' => $now->toDateString(),
            'created_by_id' => Auth::user()->id,
            'created_by_name' => Auth::user()->name,
            ]
        );
        
        session()->flash('messageReprint', 'Re-Printing of ' . $updateSingleBadBallots->unique_number . ' Done Successfully.');
    }
    
    //REPRINT OUTPUT BAD
    public function unsuccessfulRePrint($id){
        $now = Carbon::now();
        
        $updateSingleBadBallots = BadBallots::find($id);
        $updateSingleBadBallots->update([
            'is_reprint_done_successful' => false,
            'is_reprint_done_successful_by_id' => Auth::user()->id,
            'is_reprint_done_successful_by' => Auth::user()->name,
            'is_reprint_done_successful_at' => $now,
            ]
        );
        

        $unique_number = $updateSingleBadBallots->unique_number;
        if( $updateSingleBadBallots->re_encoded_count != null ){
            $unique_number = $updateSingleBadBallots->unique_number . ' - ' . $updateSingleBadBallots->re_encoded_count;
        }

        //LOG TO REPRINTS HISTORY
        $reprintsHistory = RePrintsHistory::create([
            'ballot_id' => $updateSingleBadBallots->ballot_id,
            'unique_number' => $unique_number,
            'description' => $updateSingleBadBallots->description,
            'action' => 'SET AS RE-PRINT OUTPUT UNSUCCESSFUL BATCH NO. ' . $updateSingleBadBallots->reprint_batch ,
            'date' => $now->toDateString(),
            'created_by_id' => Auth::user()->id,
            'created_by_name' => Auth::user()->name,
            ]
        );
        
        session()->flash('error', 'Re-Printing of ' . $updateSingleBadBallots->unique_number . ' Not Successful.');
    }
    
    public function reEncode($id){
        $getReEncodeBadBallot = BadBallots::find($id);
        $getReEncodeBadBallot->update([
            'is_re_encoded' => true,
            ]
        );
        $reEncodeCount = $getReEncodeBadBallot->re_encoded_count + 1;
        
        if( $getReEncodeBadBallot->re_encoded_count == null){
            $description = $getReEncodeBadBallot->description . ' - ' . 'RE-ENCODED';
        }else{
            $description = $getReEncodeBadBallot->description;
        }
        
        BadBallots::create([
            'ballot_id' => $getReEncodeBadBallot->ballot_id,
            'unique_number' => $getReEncodeBadBallot->unique_number,
            'description' => $description,
            're_encoded_count' => $reEncodeCount,
            'created_by_id' => Auth::user()->id,
            'created_by_name' => Auth::user()->name,
            'created_by_comelec_role' => Auth::user()->comelec_role,
            ]
        );
        
        session()->flash('messageReprint', 'Bad Ballots Re-Encoded Successfully!');
    }
    
    public function mount(){
    }
    
    public function render()
    {
        if( $this->batchListMode ==  false ){
            
            if( $this->batchMode ==  true ){
                return view('livewire.rr-ballot-tracking.reprints-module', [
                    'reprintBallotList' => BadBallots::where('reprint_batch', null)->
                    orderBy('id', 'DESC')->get(),
                    'reprintBallotListCount' =>  BadBallots::where('reprint_batch', null)->
                    orderBy('id', 'DESC')->
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
                    orderBy('id', 'DESC')->
                    paginate(10),
                    'reprintBallotListCount' =>  BadBallots::where('ballot_id', 'like', '%'.$this->search.'%')->
                    orWhere('unique_number', 'like', '%'.$this->search.'%')->
                    orWhere('description', 'like', '%'.$this->search.'%')->
                    orWhere('created_by_name', 'like', '%'.$this->search.'%')->
                    orWhere('reprint_batch', 'like', '%'.$this->search.'%')->
                    orderBy('id', 'DESC')->
                    count(),
                    ]
                );

            }
            
        }
        
        if( $this->batchListMode ==  true ){
            return view('livewire.rr-ballot-tracking.reprints-module', [
                'reprintBatchList' => RePrintBatch::where('batch_count', 'like', '%'.$this->search.'%')->
                orWhere('created_by_name', 'like', '%'.$this->search.'%')->
                orderBy('id', 'DESC')->
                paginate(10),
                'reprintBatchListCount' => RePrintBatch::where('batch_count', 'like', '%'.$this->search.'%')->
                orWhere('created_by_name', 'like', '%'.$this->search.'%')->
                orderBy('id', 'DESC')->
                count(),
                ]
            );
        }
        
        
    }
}