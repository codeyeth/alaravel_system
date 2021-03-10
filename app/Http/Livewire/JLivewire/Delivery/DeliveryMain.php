<?php

namespace App\Http\Livewire\JLivewire\Delivery;

use Livewire\Component;
use App\Models\Delivery;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class DeliveryMain extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public function render()
    {
        if ($this->search == ''){
            return view('livewire.j-livewire.delivery.delivery-main', [
                'ballotList' => DB::table('deliveries')->paginate(5),
                'ballotListCount' => DB::table('deliveries')->count(),
                'ballotListCountTitle' => 'Total Ballot ID of Delivery With DR No',
                ]);
            }else{
                return view('livewire.j-livewire.delivery.delivery-main', [
                    'ballotList' => Delivery::where('BALLOT_ID', $this->search)
                    ->orWhere('DR_NO', $this->search)
                    ->paginate(5),
                    'ballotListCount' => Delivery::where('BALLOT_ID', $this->search)
                    ->orWhere('DR_NO', $this->search)
                    ->count(),
                    'ballotListCountTitle' => 'Search Result Found:',
                    ]);
                }
                
      
     
    }
    
}
