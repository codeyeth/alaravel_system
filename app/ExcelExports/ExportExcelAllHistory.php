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

class ExportExcelAllHistory implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function query()
    {
        $all_history = BallotHistory::query()->orderBy('ballot_id', 'ASC');
        return $all_history;
    }
    
    public function headings(): array
    {
        return [
            // ['ID', 'BALLOT ID', 'OLD_STATUS', 'TYPE', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
            ['ID', 'BALLOT CONTROL #', 'OLD_STATUS', 'TYPE', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
        ];
    }
    
    public function map($all_history): array
    {
        $status_by_at = Carbon::create($all_history->status_by_at);
        
        if( $all_history->old_status == 'PRINTER' ){
            // $old_status = 'SHEETER';
            
            $old_status = 'PAPER CUTTER SECTION';           
        }else{
            // $old_status = $all_history->old_status;
            
            $old_status = '';
            
            if( $all_history->old_status == 'SHEETER' ){
                $old_status = 'PAPER CUTTER SECTION';           
            }
            
            if( $all_history->old_status == 'TEMPORARY STORAGE' ){
                $old_status = 'STORAGE SECTION';           
            }
            
            if(  $all_history->old_status == 'VERIFICATION' ){
                $old_status = 'VALIDITY VERIFICATION SECTION';           
            }
            
            if( $all_history->old_status == 'QUARANTINE' ){
                $old_status = 'REJECTED SECTION';           
            }
            
            if( $all_history->old_status == 'COMELEC DELIVERY' ){
                // $old_status = 'DELIVERY SECTION';           
                $old_status = 'OUTGOING DELIVERY SECTION';           
            }
            
            if( $all_history->old_status == 'NPO SMD' ){
                // $old_status = 'BILLING SECTION';           
                $old_status = 'DELIVERY MANAGEMENT SECTION';           
            }
            
            if( $all_history->old_status == 'OUT FOR DELIVERY' ){
                $old_status = 'OUT FOR DELIVERY';           
            }
            
            if( $all_history->old_status == 'DELIVERED' ){
                $old_status = 'DELIVERED';           
            }
            
        }
        
        return [
            $all_history->id,
            $all_history->ballot_id,
            $old_status,
            $all_history->new_status_type,
            $all_history->status_by_id,
            $all_history->status_by_name,
            $status_by_at->toDayDateTimeString(),
        ];
    }
}