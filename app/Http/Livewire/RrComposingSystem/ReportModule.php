<?php

namespace App\Http\Livewire\RrComposingSystem;

use Livewire\Component;
use App\Models\OgSoftcopy;

use Illuminate\Support\Str;
use DB;
use Auth;
use Carbon\Carbon;

use Maatwebsite\Excel\Facades\Excel;
use App\ExcelExports\ExportExcelMonthlyPublication;
use App\ExcelExports\ExportExcelDatePublication;

class ReportModule extends Component
{
    public $monthSelected = '';
    public $monthSelector = [];
    
    //DATE RANGE REPORT
    public $dateFrom;
    public $dateTo;
    
    public function refreshTrick(){
        $this->monthSelected = '';
        $this->dateFrom = '';
        $this->dateTo = '';
    }
    
    public function selectMonthly(){
        $dateFrom = Carbon::parse($this->monthSelected)->startOfMonth();
        $dateTo = Carbon::parse($this->monthSelected)->endOfMonth();
        
        $monthCount = Carbon::parse($this->monthSelected)->month;
        
        if($monthCount <= 9){
            $monthCount = '-0' . $monthCount;
        }else{
            $monthCount = '-' . $monthCount;
        }
        
        $year_month = Carbon::parse($this->monthSelected)->year . $monthCount;
        $export = new ExportExcelMonthlyPublication($dateFrom, $dateTo);
        return Excel::download($export, 'Monthly Report' . ' - ' . $this->monthSelected . '.xlsx');
    }
    
    public function selectDateRange(){
        if($this->dateFrom != null &&  $this->dateTo != null){
            $export = new ExportExcelDatePublication($this->dateFrom, $this->dateTo);
            $dateFromFormatted = Carbon::create($this->dateFrom)->toFormattedDateString();
            $dateToFormatted = Carbon::create($this->dateTo)->toFormattedDateString();
            return Excel::download($export, 'Publication Report' . ' From ' . $dateFromFormatted . ' To ' . $dateToFormatted . '.xlsx');
        }else{
            session()->flash('messageDateRangeRequired', 'Date From - To Required.');
        }
    }
    
    public function mount(){
        $now = Carbon::now();
        // $now = Carbon::now()->format('F');
        
        $data = array();
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
            array_push($data, array(
                'monthNumber' => $month->month,
                'monthName' => $month->monthName,
                'year' => $year
            ));
        }
        $this->monthSelector = $data;
    }
    
    public function render()
    {
        return view('livewire.rr-composing-system.report-module');
    }
}