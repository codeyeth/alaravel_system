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

class ReportModule extends Component
{
    public $monthSelected = '';
    public $monthSelector = [];
    
    public function refreshTrick(){
        $this->monthSelected = '';
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
        return Excel::download($export, 'monthlyReport' . '-' . $this->monthSelected . ' ' . '.xlsx');
        // $resultSet = OgSoftcopy::where('created_at', '>=', $dateFrom)->where('created_at', '<=', $dateTo)->get();
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