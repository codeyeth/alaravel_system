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

class ExportExcelStatusBallotHistory implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public $statusSelected;
    
    public function __construct($statusSelected)
    {
        $this->statusSelected = $statusSelected;
    }
    
    public function query()
    {
        $status_history = BallotHistory::query()->where('new_status', $this->statusSelected);
        return $status_history;
    }
    
    public function headings(): array
    {
        return [
            ['ID', 'BALLOT ID', 'OLD_STATUS', 'TYPE', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
        ];
    }
    
    public function map($status_history): array
    {
        $status_by_at = Carbon::create($status_history->status_by_at);
        
        if( $status_history->old_status == 'PRINTER' ){
            $old_status = 'SHEETER';
        }else{
            $old_status = $status_history->old_status;
        }

        return [
            $status_history->id,
            $status_history->ballot_id,
            $old_status,
            $status_history->new_status_type,
            $status_history->status_by_id,
            $status_history->status_by_name,
            $status_by_at->toDayDateTimeString(),
        ];
    }
    
}