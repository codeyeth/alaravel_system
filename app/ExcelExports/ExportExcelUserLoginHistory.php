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

class ExportExcelUserLoginHistory implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public $userId;
    
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    
    public function query()
    {
        $user_history = LoginHistory::query()->where('user_id', $this->userId);
        return $user_history;
    }
    
    public function headings(): array
    {
        return [
            ['ID', 'USER ID', 'NAME', 'EMAIL', 'ACTION', 'IP ADDRESS', 'ACTION AT' ],
        ];
    }
    
    public function map($user_history): array
    {
        // $created_at = Carbon::create($user_history->created_at);
        
        return [
            $user_history->id,
            $user_history->user_id,
            $user_history->name,
            $user_history->email,
            $user_history->action,
            $user_history->ip,
            $user_history->created_at->toDayDateTimeString(),
            // $created_at->toDayDateTimeString(),
        ];
    }
    
}