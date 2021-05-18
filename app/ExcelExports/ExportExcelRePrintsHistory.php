<?php

namespace App\ExcelExports;

use App\Models\BallotHistory;
use App\Models\RePrintsHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;

class ExportExcelRePrintsHistory implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function query()
    {
        $all_re_prints = RePrintsHistory::query()->orderBy('unique_number', 'ASC');
        return $all_re_prints;
    }
    
    public function headings(): array
    {
        return [
            // [ 'ID', 'BALLOT ID', 'UNIQUE NUMBER', 'DESCRIPTION', 'ACTION', 'BY ID', 'BY NAME', 'CREATED AT', ],
            [ 'ID', 'BALLOT CONTROL #', 'UNIQUE NUMBER', 'DESCRIPTION', 'ACTION', 'BY ID', 'BY NAME', 'CREATED AT', ],
        ];
    }
    
    public function map($all_re_prints): array
    {
        return [
            $all_re_prints->id,
            $all_re_prints->ballot_id,
            $all_re_prints->unique_number,
            $all_re_prints->description,
            $all_re_prints->action,
            $all_re_prints->created_by_id,
            $all_re_prints->created_by_name,
            $all_re_prints->created_at->toDayDateTimeString(),
        ];
    }
}