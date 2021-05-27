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
use DB;

class ExportExcelBallotDate implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public $dateFrom;
    public $dateTo;
    
    public function __construct($dateFrom, $dateTo)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }
    
    public function query()
    {
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;
        // $date_history = BallotHistory::query()->where('status_by_at_date', '>=', $dateFrom)->where('status_by_at_date', '<=', $dateTo);
        $date_history = BallotHistory::query()->whereRaw('created_at >= ? AND created_at <= ?', array($dateFrom, $dateTo))->orderBy('id', 'ASC');
        
        return $date_history;
    }
    
    public function headings(): array
    {
        return [
            // ['ID', 'BALLOT ID', 'OLD_STATUS', 'TYPE', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
            ['ID', 'BALLOT CONTROL #', 'OLD_STATUS', 'TYPE', 'STATUS BY ID', 'STATUS BY NAME', 'STATUS BY AT' ],
        ];
    }
    
    public function map($date_history): array
    {
        $status_by_at = Carbon::create($date_history->status_by_at);
        
        if( $date_history->old_status == 'PRINTER' ){
            // $old_status = 'SHEETER';
            
            $old_status = 'PAPER CUTTER SECTION';           
        }else{
            // $old_status = $date_history->old_status;
            
            $old_status = '';
            
            if( $date_history->old_status == 'SHEETER' ){
                $old_status = 'PAPER CUTTER SECTION';           
            }
            
            if( $date_history->old_status == 'TEMPORARY STORAGE' ){
                $old_status = 'STORAGE SECTION';           
            }
            
            if(  $date_history->old_status == 'VERIFICATION' ){
                $old_status = 'VALIDITY VERIFICATION SECTION';           
            }
            
            if( $date_history->old_status == 'QUARANTINE' ){
                $old_status = 'REJECTED SECTION';           
            }
            
            if( $date_history->old_status == 'COMELEC DELIVERY' ){
                $old_status = 'DELIVERY SECTION';           
            }
            
            if( $date_history->old_status == 'NPO SMD' ){
                $old_status = 'BILLING SECTION';           
            }
            
            if( $date_history->old_status == 'OUT FOR DELIVERY' ){
                $old_status = 'OUT FOR DELIVERY';           
            }
            
            if( $date_history->old_status == 'DELIVERED' ){
                $old_status = 'DELIVERED';           
            }
            
            
        }
        
        return [
            $date_history->id,
            $date_history->ballot_id,
            $old_status,
            $date_history->new_status_type,
            $date_history->status_by_id,
            $date_history->status_by_name,
            $status_by_at->toDayDateTimeString(),
        ];
    }
    
}