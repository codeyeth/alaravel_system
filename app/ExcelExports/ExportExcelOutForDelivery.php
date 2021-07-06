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
            ['ID', 'BALLOT CONTROL #', 'AGENCY/COMPANY NAME', 'ADDRESS', 'CONTACT NO', 'CONTACT PERSON', 'OR NO', 'QUANTITY', 'UNIT', 'DESCRIPTION', 'DELIVERED BY', 'DELIVERED AT' ],
        ];
    }
    
    public function map($all_out_for_delivery): array
    {
        $out_for_delivery_at = Carbon::create($all_out_for_delivery->is_out_for_delivery_at);
        
        return [
            $all_out_for_delivery->id,
            $all_out_for_delivery->ballot_id,
            $all_out_for_delivery->agency_name,
            $all_out_for_delivery->complete_address,
            $all_out_for_delivery->contact_no,
            $all_out_for_delivery->contact_person,
            $all_out_for_delivery->or_no,
            $all_out_for_delivery->quantity,
            $all_out_for_delivery->unit_of_measure,
            $all_out_for_delivery->description,            
            $all_out_for_delivery->is_out_for_delivery_by,
            $out_for_delivery_at->toDayDateTimeString(),
        ];
    }
}