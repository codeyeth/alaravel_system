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
                'ID', 'BALLOT CONTROL #', 'AGENCY/COMPANY NAME', 'ADDRESS', 'CONTACT NO', 'CONTACT PERSON', 'OR NO', 'QUANTITY', 'UNIT', 'DESCRIPTION', 'REPRINT STATUS BY', 'REPRINT STATUS AT', 
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
            $all_re_prints->agency_name,
            $all_re_prints->complete_address,
            $all_re_prints->contact_no,
            $all_re_prints->contact_person,
            $all_re_prints->or_no,
            $all_re_prints->quantity,
            $all_re_prints->unit_of_measure,
            $all_re_prints->description,      
            $all_re_prints->is_re_print_by,
            $is_re_print_at->toDayDateTimeString(),
            $all_re_prints->is_re_print_done_by,
            $is_re_print_done_at->toDayDateTimeString(),
        ];
    }
}