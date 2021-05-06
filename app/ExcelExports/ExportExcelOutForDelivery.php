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

class ExportExcelOutForDelivery implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function query()
    {
        $all_out_for_delivery = Ballots::query()->where('is_out_for_delivery', true)->orderBy('ballot_id', 'ASC');
        return $all_out_for_delivery;
    }
    
    public function headings(): array
    {
        return [
            ['ID', 'BALLOT ID', 'REGION', 'PROVINCE', 'MUNICIPALITY', 'BARANGAY', 'POLLPLACE', 'POLLSTREET', 'CLUSTER NO', 'CLUSTERED PREC', 'CLUSTER TOTAL', 'GROUP NO', 'OUT FOR DELIVERY BY', 'OUT FOR DELIVERY AT' ],
        ];
    }
    
    public function map($all_out_for_delivery): array
    {
        $out_for_delivery_at = Carbon::create($all_out_for_delivery->is_out_for_delivery_at);
        
        return [
            $all_out_for_delivery->id,
            $all_out_for_delivery->ballot_id,
            $all_out_for_delivery->region,
            $all_out_for_delivery->prov_name,
            $all_out_for_delivery->mun_name,
            $all_out_for_delivery->bgy_name,
            $all_out_for_delivery->pollplace,
            $all_out_for_delivery->pollstreet,
            $all_out_for_delivery->cluster_no,
            $all_out_for_delivery->clustered_prec,
            $all_out_for_delivery->cluster_total,
            $all_out_for_delivery->group_no,
            $all_out_for_delivery->is_out_for_delivery_by,
            $out_for_delivery_at->toDayDateTimeString(),
        ];
    }
}