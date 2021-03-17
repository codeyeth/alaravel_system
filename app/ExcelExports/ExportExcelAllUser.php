<?php

namespace App\ExcelExports;

use App\Models\User;
use App\Models\LoginHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class ExportExcelAllUser implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function query()
    {
        $user_details = User::query()->orderBy('id', 'ASC');
        return $user_details;
    }
    
    public function headings(): array
    {
        return [
            ['ID', 'UUID', 'NAME', 'EMAIL', 'POSITION', 'DIVISION', 'SECTION', 'CREATED_AT' ],
        ];
    }
    
    public function map($user_details): array
    {
        return [
            $user_details->id,
            $user_details->user_id,
            $user_details->name,
            $user_details->email,
            $user_details->position,
            $user_details->division,
            $user_details->section,
            $user_details->created_at->toDayDateTimeString(),
        ];
    }
    
}