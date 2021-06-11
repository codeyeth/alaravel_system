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

class ExportExcelSingleBallotHistory implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public $ballotIdToExcel;
    
    public function __construct($ballotIdToExcel)
    {
        $this->ballotIdToExcel = $ballotIdToExcel;
    }
    
    public function query()
    {
        $single_history = BallotHistory::query()->where('ballot_id', $this->ballotIdToExcel);
        return $single_history;
    }
    
    public function headings(): array
    {
        return [
            // ['ID', 'BALLOT ID', 'ACTION', 'OLD STATUS', 'TYPE', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
            ['ID', 'BALLOT CONTROL #', 'ACTION', 'OLD STATUS', 'TYPE', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
        ];
    }
    
    public function map($single_history): array
    {
        $status_by_at = Carbon::create($single_history->status_by_at);
        
        if( $single_history->old_status == 'PRINTER' ){
            // $old_status = 'SHEETER';
            $old_status = 'PAPER CUTTER SECTION';           
        }else{
            // $old_status = $single_history->old_status;
            
            $old_status = '';
            
            if( $single_history->old_status == 'SHEETER' ){
                $old_status = 'PAPER CUTTER SECTION';           
            }
            
            if( $single_history->old_status == 'TEMPORARY STORAGE' ){
                $old_status = 'STORAGE SECTION';           
            }
            
            if(  $single_history->old_status == 'VERIFICATION' ){
                $old_status = 'VALIDITY VERIFICATION SECTION';           
            }
            
            if( $single_history->old_status == 'QUARANTINE' ){
                $old_status = 'REJECTED SECTION';           
            }
            
            if( $single_history->old_status == 'COMELEC DELIVERY' ){
                // $old_status = 'DELIVERY SECTION';           
                $old_status = 'OUTGOING DELIVERY SECTION';           
            }
            
            if( $single_history->old_status == 'NPO SMD' ){
                // $old_status = 'BILLING SECTION';           
                $old_status = 'DELIVERY MANAGEMENT SECTION';           
            }
            
            if( $single_history->old_status == 'OUT FOR DELIVERY' ){
                $old_status = 'OUT FOR DELIVERY';           
            }
            
            if( $single_history->old_status == 'DELIVERED' ){
                $old_status = 'DELIVERED';           
            }
            
        }
        
        return [
            $single_history->id,
            $single_history->ballot_id,
            $single_history->action,
            $old_status,
            $single_history->new_status_type,
            $single_history->status_by_id,
            $single_history->status_by_name,
            $status_by_at->toDayDateTimeString(),
        ];
    }
    
}