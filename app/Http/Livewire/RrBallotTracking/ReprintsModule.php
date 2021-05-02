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

class ReprintsModule extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    public $keywordMode = true;
    
    public function mount(){
        
    }
    
    public function render()
    {
        // return view('livewire.rr-ballot-tracking.reprints-module');
        
        // IF KEYWORD MODE IS TRUE SPIT THE INPUT TYPE=TEXT FOR SEARCHING KEYWORDS
        if( $this->keywordMode == true ){
            return view('livewire.rr-ballot-tracking.reprints-module', [
                'reprintBallotList' => BadBallots::where('ballot_id', 'like', '%'.$this->search.'%')->
                orWhere('unique_number', 'like', '%'.$this->search.'%')->
                orWhere('description', 'like', '%'.$this->search.'%')->
                orWhere('created_by_name', 'like', '%'.$this->search.'%')->
                orWhere('reprint_batch', 'like', '%'.$this->search.'%')->
                orderBy('created_at', 'DESC')->
                paginate(20),
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
        
        // if($this->keywordMode == false){
            //     return view('livewire.rr-smd-system.sales-invoice-list', [
                //         'salesInvoiceList' => SalesInvoice::where('created_at', 'like', '%'.$this->searchSalesInvoice.'%')
                //         ->orderBy('created_at', 'DESC')
                //         ->paginate(10),
                //         'salesInvoiceListCount' => SalesInvoice::where('created_at', 'like', '%'.$this->searchSalesInvoice.'%')
                //         ->orderBy('created_at', 'DESC')
                //         ->count(),
                //         ]
                //     );
                // }
                
            }
        }
        