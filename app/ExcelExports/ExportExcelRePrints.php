<?php

namespace App\ExcelExports;

use App\Models\BallotHistory;
use App\Models\Ballots;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;

class ExportExcelRePrints implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function query()
    {
        $all_re_prints = Ballots::query()->where('is_re_print', true)->orderBy('ballot_id', 'ASC');
        return $all_re_prints;
    }
    
    public function headings(): array
    {
        return [
            [
                'ID', 'BALLOT ID', 'REGION', 'PROVINCE', 'MUNICIPALITY', 'BARANGAY', 'POLLPLACE', 'POLLSTREET', 'CLUSTER NO', 'CLUSTERED PREC', 'CLUSTER TOTAL', 'GROUP NO', 'REPRINT STATUS BY', 'REPRINT STATUS AT', 
                'REPRINT DONE BY', 'REPRINT DONE AT', 
            ],
        ];
    }
    
    public function map($all_re_prints): array
    {
        $is_re_print_at = Carbon::create($all_re_prints->is_re_print_at);
        $is_re_print_done_at = Carbon::create($all_re_prints->is_re_print_done_at);
        
        return [
            $all_re_prints->id,
            $all_re_prints->ballot_id,
            $all_re_prints->region,
            $all_re_prints->prov_name,
            $all_re_prints->mun_name,
            $all_re_prints->bgy_name,
            $all_re_prints->pollplace,
            $all_re_prints->pollstreet,
            $all_re_prints->cluster_no,
            $all_re_prints->clustered_prec,
            $all_re_prints->cluster_total,
            $all_re_prints->group_no,
            $all_re_prints->is_re_print_by,
            $is_re_print_at->toDayDateTimeString(),
            $all_re_prints->is_re_print_done_by,
            $is_re_print_done_at->toDayDateTimeString(),
        ];
    }
}