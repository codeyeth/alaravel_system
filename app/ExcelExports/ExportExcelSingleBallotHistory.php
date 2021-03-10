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

class ExportExcelSingleBallotHistory implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public $ballotIdToExcel;
    
    public function __construct($ballotIdToExcel)
    {
        $this->ballotIdToExcel = $ballotIdToExcel;
    }
    
    public function query()
    {
        $single_history = BallotHistory::query()->where('ballot_id', $this->ballotIdToExcel);
        return $single_history;
    }
    
    public function headings(): array
    {
        return [
            ['ID', 'BALLOT ID', 'OLD_STATUS', 'TYPE', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
        ];
    }
    
    public function map($single_history): array
    {
        $status_by_at = Carbon::create($single_history->status_by_at);
        
        if( $single_history->old_status == 'PRINTER' ){
            $old_status = 'SHEETER';
        }else{
            $old_status = $single_history->old_status;
        }

        return [
            $single_history->id,
            $single_history->ballot_id,
            $old_status,
            $single_history->new_status_type,
            $single_history->status_by_id,
            $single_history->status_by_name,
            $status_by_at->toDayDateTimeString(),
        ];
    }
    
}