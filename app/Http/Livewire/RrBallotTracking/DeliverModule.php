<?php

namespace App\Http\Livewire\RrBallotTracking;

use Livewire\Component;
use App\Models\Ballots;
use App\Models\BallotHistory;
use App\Models\BadBallots;
use App\Models\User;
use Auth;
use Livewire\WithPagination;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Validator;

//REALTIME functions
use App\Events\RefreshBallotList;

class DeliverModule extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    
    // MODE TOGGLED FROM BARCODE FUNCTION
    public $isOutForDeliveryMode;
    public $isDeliveredMode;
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    //CLEAR SEARCH
    public function clearSearch(){
        $this->search = '';
    }
    
    //UPDATE BALLOT STATUS
    public function updateBallotDeliveryStatus(){
        $now = Carbon::now();
        if($this->search != ''){
            
            if( Auth::user()->comelec_role == 'COMELEC DELIVERY' && $this->isOutForDeliveryMode == true && $this->isDeliveredMode == false){
                $updateBallotStatus = Ballots::where('ballot_id', $this->search)->where('is_dr_done', true )->first();
            }
            
            if( Auth::user()->comelec_role == 'COMELEC DELIVERY' && $this->isDeliveredMode == true && $this->isOutForDeliveryMode == false){
                $updateBallotStatus = Ballots::where('ballot_id', $this->search)->where('is_out_for_delivery', true )->first();
            }
            
            if( $this->isOutForDeliveryMode == true ){
                $oldStatus = "OUT FOR DELIVERY";
            }
            
            if( $this->isDeliveredMode == true ){
                $oldStatus = "DELIVERED";
            }
            
            if($updateBallotStatus != null){
                
                $addBallotHistory = BallotHistory::create([
                    'ballot_id' => $this->search,
                    'action' => 'Update',
                    'old_status' => $oldStatus,
                    'old_status_type' => "",
                    'new_status' => "",
                    'new_status_type' => "",
                    'for' => "",
                    'status_by_id' => Auth::user()->id,
                    'status_by_name' => Auth::user()->name,
                    'status_by_at' => $now,
                    'status_by_at_date' => $now->toDateString(),
                    ]
                );
                
                // SET THE STATUS TO OUT FOR DELIVERY
                if( $this->isOutForDeliveryMode == true ){
                    //OUT FOR DELIVERY MODE
                    $statusType = 'OFDM';
                    
                    $updateBallotStatus->update([
                        'current_status' => $oldStatus,
                        'new_status_type' => "",
                        'status_updated_by_id' => Auth::user()->id,
                        'status_updated_by' => Auth::user()->name,
                        'status_updated_at' => $now,
                        
                        'is_out_for_delivery' => true,
                        'is_out_for_delivery_by_id' => Auth::user()->id,
                        'is_out_for_delivery_by' => Auth::user()->name,
                        'is_out_for_delivery_at' => $now,
                        ]
                    );
                }
                
                //SET THE STATUS TO DELIVERED
                if( $this->isDeliveredMode == true ){
                    //DELIVERED MODE
                    $statusType = 'DM';
                    $updateBallotStatus->update([
                        'current_status' => $oldStatus,
                        'new_status_type' => "",
                        'status_updated_by_id' => Auth::user()->id,
                        'status_updated_by' => Auth::user()->name,
                        'status_updated_at' => $now,
                        
                        'is_delivered' => true,
                        'is_delivered_by_id' => Auth::user()->id,
                        'is_delivered_by' => Auth::user()->name,
                        'is_delivered_at' => $now,
                        ]
                    );
                }
                
                $userName = Auth::user()->name;
                $ballot_id = $this->search;
                $comelec_role = Auth::user()->comelec_role;
                $barcoded_receiver = Auth::user()->barcoded_receiver;
                
                broadcast(new RefreshBallotList($comelec_role, $ballot_id, $barcoded_receiver, $statusType, $userName));
                
                if( $this->isOutForDeliveryMode == true ){
                    session()->flash('success', $this->search . ' is Out For Delivery');
                }
                
                if( $this->isDeliveredMode == true ){
                    session()->flash('success', $this->search . ' is Delivered');
                }
                
                return redirect()->to('/ballot_tracking');
            }
        }
    }
    
    public function render()
    {
        if($this->isOutForDeliveryMode == true){
            return view('livewire.rr-ballot-tracking.deliver-module', [
                'ballotList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('is_out_for_delivery', false )->where('is_dr_done', true )->paginate(20),
                'ballotListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('is_dr_done', true )->count(),
                ]
            );
        }
        
        if($this->isDeliveredMode == true){
            return view('livewire.rr-ballot-tracking.deliver-module', [
                'ballotList' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('is_delivered', false )->where('is_out_for_delivery', true )->paginate(20),
                'ballotListCount' => Ballots::where('ballot_id', 'like', '%'.$this->search.'%')->where('is_out_for_delivery', true )->count(),
                ]
            );
        }
        
    }
}
