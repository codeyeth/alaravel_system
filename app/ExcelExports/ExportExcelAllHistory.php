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

class ExportExcelAllHistory implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function query()
    {
        $all_history = BallotHistory::query()->orderBy('ballot_id', 'ASC');
        return $all_history;
    }
    
    public function headings(): array
    {
        return [
            ['ID', 'BALLOT ID', 'ACTION', 'OLD_STATUS', 'NEW STATUS', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
        ];
    }
    
    public function map($all_history): array
    {
        $status_by_at = Carbon::create($all_history->status_by_at);
        
        return [
            $all_history->id,
            $all_history->ballot_id,
            $all_history->action,
            $all_history->old_status,
            $all_history->new_status,
            $all_history->status_by_id,
            $all_history->status_by_name,
            $status_by_at->toDayDateTimeString(),
        ];
    }
    
}