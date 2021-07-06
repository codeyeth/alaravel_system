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
            ['ID', 'BALLOT CONTROL #', 'AGENCY/COMPANY NAME', 'ADDRESS', 'CONTACT NO', 'CONTACT PERSON', 'OR NO', 'QUANTITY', 'UNIT', 'DESCRIPTION', 'DELIVERED BY', 'DELIVERED AT' ],
        ];
    }
    
    public function map($all_delivered): array
    {
        $delivered_at = Carbon::create($all_delivered->is_delivered_at);
        
        return [
            $all_delivered->id,
            $all_delivered->ballot_id,
            $all_delivered->agency_name,
            $all_delivered->complete_address,
            $all_delivered->contact_no,
            $all_delivered->contact_person,
            $all_delivered->or_no,
            $all_delivered->quantity,
            $all_delivered->unit_of_measure,
            $all_delivered->description,
            $all_delivered->is_delivered_by,
            $delivered_at->toDayDateTimeString(),
        ];
    }
}