<?php

namespace App\ExcelExports;

use App\Models\BallotHistory;
use App\Models\Ballots;
use App\Models\BadBallots;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;

class ExportExcelBadBallots implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function query()
    {
        $all_bad_ballots = BadBallots::query()->orderBy('ballot_id', 'ASC');
        return $all_bad_ballots;
    }
    
    public function headings(): array
    {
        return [
            // [ 
            //     'ID', 'BALLOT ID', 'UNIQUE NUMBER', 'DESCRIPTION', 'CREATOR ID', 'CREATOR NAME', 'CREATED AT',
            //     'BATCH#', 'BY ID', 'BY NAME', 'AT',
            //     'IS REPRINT STARTED', 'BY ID', 'BY NAME', 'STARTED AT',
            //     'IS REPRINT DONE', 'BY ID', 'BY NAME', 'DONE AT',
            //     'IS REPRINT SUCCESSFUL', 'BY ID', 'BY NAME', 'AT',
            // ],
            [ 
                'ID', 'BALLOT CONTROL #', 'UNIQUE NUMBER', 'DESCRIPTION', 'CREATOR ID', 'CREATOR NAME', 'CREATED AT',
                'BATCH#', 'BY ID', 'BY NAME', 'AT',
                'IS REPRINT STARTED', 'BY ID', 'BY NAME', 'STARTED AT',
                'IS REPRINT DONE', 'BY ID', 'BY NAME', 'DONE AT',
                'IS REPRINT SUCCESSFUL', 'BY ID', 'BY NAME', 'AT',
            ],
        ];
    }
    
    public function map($all_bad_ballots): array
    {
        if( $all_bad_ballots->reprint_batch != null ){
            $batchAt = Carbon::create($all_bad_ballots->reprint_batch_at)->toDayDateTimeString();
        }else{
            $batchAt = '';
        }
        
        $isStarted = '';
        $isStartedAt = '';
        if( $all_bad_ballots->is_reprint_batch_start == true ){
            $isStarted = 'REPRINT STARTED';
            $isStartedAt = Carbon::create($all_bad_ballots->is_reprint_batch_start_at)->toDayDateTimeString();
        }elseif( $all_bad_ballots->is_reprint_batch_start == false && $all_bad_ballots->reprint_batch != null){
            $isStarted = 'REPRINT START PENDING';
            $isStartedAt = '';
        }
        
        $isDone = '';
        $isDoneAt = '';
        if( $all_bad_ballots->is_reprint_done == true ){
            $isDone = 'REPRINT DONE';
            $isDoneAt = Carbon::create($all_bad_ballots->is_reprint_done_at)->toDayDateTimeString();
        }elseif( $all_bad_ballots->is_reprint_done == false && $all_bad_ballots->is_reprint_batch_start == true){
            $isDone = 'REPRINT ONGOING';
            $isDoneAt = '';
        }
        
        $isSuccessful = '';
        $isSuccessfulAt = '';
        if( $all_bad_ballots->is_reprint_done == true && $all_bad_ballots->is_reprint_done_successful == true ){
            $isSuccessful = 'REPRINT OUTPUT SUCCESSFUL';
            $isSuccessfulAt = Carbon::create($all_bad_ballots->is_reprint_done_successful_at)->toDayDateTimeString();
        }
        
        if( $all_bad_ballots->is_reprint_done_successful == false && $all_bad_ballots->is_reprint_done_successful_by_id != null ){
            $isSuccessful = 'REPRINT OUTPUT FAILED';
            $isSuccessfulAt = Carbon::create($all_bad_ballots->is_reprint_done_successful_at)->toDayDateTimeString();
        }
        
        return [
            $all_bad_ballots->id,
            $all_bad_ballots->ballot_id,
            $all_bad_ballots->unique_number,
            $all_bad_ballots->description,
            $all_bad_ballots->created_by_id,
            $all_bad_ballots->created_by_name,
            $all_bad_ballots->created_at->toDayDateTimeString(),
            
            $all_bad_ballots->reprint_batch,
            $all_bad_ballots->reprint_batch_by_id,
            $all_bad_ballots->reprint_batch_by,
            $batchAt,
            
            $isStarted,
            $all_bad_ballots->is_reprint_batch_start_by_id,
            $all_bad_ballots->is_reprint_batch_start_by,
            $isStartedAt,
            
            $isDone,
            $all_bad_ballots->is_reprint_done_by_id,
            $all_bad_ballots->is_reprint_done_by,
            $isDoneAt,
            
            $isSuccessful,
            $all_bad_ballots->is_reprint_done_successful_by_id,
            $all_bad_ballots->is_reprint_done_successful_by,
            $isSuccessfulAt,
            
        ];
    }
}