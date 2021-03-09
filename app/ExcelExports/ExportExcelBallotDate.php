<?php

namespace App\ExcelExports;

use App\Models\BallotHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;

class ExportExcelBallotDate implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public $dateFrom;
    public $dateTo;
    
    public function __construct($dateFrom, $dateTo)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }
    
    public function query()
    {
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;
        $date_history = BallotHistory::query()->where('status_by_at_date', '>=', $dateFrom)->where('status_by_at_date', '<=', $dateTo);
        return $date_history;
    }
    
    public function headings(): array
    {
        return [
            ['ID', 'BALLOT ID', 'ACTION', 'OLD_STATUS', 'NEW STATUS', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
        ];
    }
    
    public function map($date_history): array
    {
        $status_by_at = Carbon::create($date_history->status_by_at);
        
        return [
            $date_history->id,
            $date_history->ballot_id,
            $date_history->action,
            $date_history->old_status,
            $date_history->new_status,
            $date_history->status_by_id,
            $date_history->status_by_name,
            $status_by_at->toDayDateTimeString(),
        ];
    }
    
}