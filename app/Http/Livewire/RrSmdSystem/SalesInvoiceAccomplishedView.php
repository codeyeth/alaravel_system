<?php

namespace App\Http\Livewire\RrSmdSystem;

use Livewire\Component;
use App\Models\SalesInvoice;

use Illuminate\Support\Str;
use DB;
use Auth;
use Carbon\Carbon;

class SalesInvoiceAccomplishedView extends Component
{
    //PASSED VARIABLE FROM ACCOMPLISHED SI MODAL SELECTOR
    public $monthSelected;
    
    public $preparedBy;
    public $prepPosition;
    public $submittedBy;
    public $subPosition;
    
    public $dateSiFrom;
    public $dateSiTo;
    // public $monthSelected = '';
    public $monthSelector = [];
    public $endOfMonth;
    
    public $getNames = [];
    public $getCount = [];
    public $accomplishedResult = [];
    public $getCountCollection = [];
    
    public function mount(){
        //FOR DISPLAYING DATES IN THE VIEW
        $this->dateSiFrom = Carbon::parse($this->monthSelected)->startOfMonth();
        $this->dateSiTo = Carbon::parse($this->monthSelected)->endOfMonth();
        
        $dateFrom = Carbon::parse($this->monthSelected)->startOfMonth();
        $dateTo = Carbon::parse($this->monthSelected)->endOfMonth();
        
        $this->endOfMonth = $dateTo->day;
        $year_month = Carbon::parse($this->monthSelected)->year . '-0' . Carbon::parse($this->monthSelected)->month;
        //GET THE NAMES OF THE SI CREATORS
        $this->getNames = SalesInvoice::where('created_at', '>=', $dateFrom)->where('created_at', '<=', $dateTo)->groupBy('created_by_name')->get();
        
        if(count($this->getNames) <= 0){
            session()->flash('messageNoAccomplished', 'No Accomplished S.I Found!');
            $this->accomplishedResult = [];
            $this->getCount = [];
        }
        
        if(count($this->getNames) > 0){
            
            $fixedDate = [ 
                'dateFrom1' => '-01', 'dateTo1' => '-07',
                'dateFrom2' => '-08', 'dateTo2' => '-15',
                'dateFrom3' => '-16', 'dateTo3' => '-22',
                'dateFrom4' => '-23', 'dateTo4' => '-31',
            ];
            //GET THE COUNT ACCOMPLISHED PER WEEK
            
            foreach ($this->getNames as $index => $get_name){
                $q = 0;
                for($w = 1; $w <= 4; $w++){
                    $this->getCount[] = [ 
                        'belongs_to' => $get_name->created_by_name, 
                        'count' => SalesInvoice::where('date', '>=', $year_month . $fixedDate['dateFrom'. $w])->where('date', '<=', $year_month . $fixedDate['dateTo'. $w]) ->where('created_by_name', $get_name->created_by_name)->count(), 
                    ];
                }
            }
            
            //COLLECTING THE ARRAY THRU LARVEL COLLECTION INSTANCE TO GET THE TOTAL OF COUNTS PER SAME KEY
            $this->getCountCollection = collect($this->getCount);
            
            //ASSIGNING THE NAMES TO AN ARRAY
            foreach ($this->getNames as $index => $get_name){
                $this->accomplishedResult[] = [ 'name' => $get_name->created_by_name ];
            }
        }
    }
    
    public function render()
    {
        return view('livewire.rr-smd-system.sales-invoice-accomplished-view');
    }
}
