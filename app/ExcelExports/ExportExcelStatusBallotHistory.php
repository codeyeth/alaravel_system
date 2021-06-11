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

class ExportExcelStatusBallotHistory implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public $statusSelected;
    public $statusType;
    
    public function __construct($statusSelected, $statusType)
    {
        $this->statusSelected = $statusSelected;
        $this->statusType = $statusType;
    }
    
    public function query()
    {
        if( $this->statusType == "OUT" ){
            $status_history = BallotHistory::query()->where('old_status', $this->statusSelected)->where('new_status_type', $this->statusType);
        }elseif( $this->statusType == "ALL" ){
            $status_history = BallotHistory::query()->where('old_status', $this->statusSelected);
        }else{
            $status_history = BallotHistory::query()->where('old_status', $this->statusSelected)->where('new_status_type', $this->statusType);
        }
        
        return $status_history;
    }
    
    public function headings(): array
    {
        return [
              // ['ID', 'BALLOT ID', 'ACTION', 'OLD STATUS', 'TYPE', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
              ['ID', 'BALLOT CONTROL #', 'ACTION', 'OLD STATUS', 'TYPE', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
        ];
    }
    
    public function map($status_history): array
    {
        $status_by_at = Carbon::create($status_history->status_by_at);
        
        if( $status_history->old_status == 'PRINTER' ){
            // $old_status = 'SHEETER';

            $old_status = 'PAPER CUTTER SECTION';           
        }else{
            // $old_status = $status_history->old_status;

            $old_status = '';
            
            if( $status_history->old_status == 'SHEETER' ){
                $old_status = 'PAPER CUTTER SECTION';           
            }
            
            if( $status_history->old_status == 'TEMPORARY STORAGE' ){
                $old_status = 'STORAGE SECTION';           
            }
            
            if(  $status_history->old_status == 'VERIFICATION' ){
                $old_status = 'VALIDITY VERIFICATION SECTION';           
            }
            
            if( $status_history->old_status == 'QUARANTINE' ){
                $old_status = 'REJECTED SECTION';           
            }
            
            if( $status_history->old_status == 'COMELEC DELIVERY' ){
                // $old_status = 'DELIVERY SECTION';           
                $old_status = 'OUTGOING DELIVERY SECTION';           
            }
            
            if( $status_history->old_status == 'NPO SMD' ){
                // $old_status = 'BILLING SECTION';           
                $old_status = 'DELIVERY MANAGEMENT SECTION';           
            }

        }
        
        return [
            $status_history->id,
            $status_history->ballot_id,
            $status_history->action,
            $old_status,
            $status_history->new_status_type,
            $status_history->status_by_id,
            $status_history->status_by_name,
            $status_by_at->toDayDateTimeString(),
        ];
    }
    
}