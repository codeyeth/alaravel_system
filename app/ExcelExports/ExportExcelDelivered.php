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

class ExportExcelDelivered implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function query()
    {
        $all_delivered = Ballots::query()->where('is_delivered', true)->orderBy('ballot_id', 'ASC');
        return $all_delivered;
    }
    
    public function headings(): array
    {
        return [
            ['ID', 'BALLOT ID', 'REGION', 'PROVINCE', 'MUNICIPALITY', 'BARANGAY', 'POLLPLACE', 'POLLSTREET', 'CLUSTER NO', 'CLUSTERED PREC', 'CLUSTER TOTAL', 'GROUP NO', 'DELIVERED STATUS BY', 'DELIVERED STATUS AT' ],
        ];
    }
    
    public function map($all_delivered): array
    {
        $delivered_at = Carbon::create($all_delivered->is_delivered_at);
        
        return [
            $all_delivered->id,
            $all_delivered->ballot_id,
            $all_delivered->region,
            $all_delivered->prov_name,
            $all_delivered->mun_name,
            $all_delivered->bgy_name,
            $all_delivered->pollplace,
            $all_delivered->pollstreet,
            $all_delivered->cluster_no,
            $all_delivered->clustered_prec,
            $all_delivered->cluster_total,
            $all_delivered->group_no,
            $all_delivered->is_re_print_by,
            $delivered_at->toDayDateTimeString(),
        ];
    }
}