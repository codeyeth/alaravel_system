<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadBallots extends Model
{
    use HasFactory;
    protected $fillable = [
        'ballot_id',
        'unique_number',
        'description',
        'created_by_id',
        'created_by_name',
        'created_by_comelec_role',
        
        'reprint_batch',
        'reprint_batch_by_id',
        'reprint_batch_by',
        'reprint_batch_at',
        
        'is_reprint_batch_start',
        'is_reprint_batch_start_by_id',
        'is_reprint_batch_start_by',
        'is_reprint_batch_start_at',
        
        'is_reprint_done',
        'is_reprint_done_by_id',
        'is_reprint_done_by',
        'is_reprint_done_at',
        
        'is_reprint_done_successful',
        'is_reprint_done_successful_by_id',
        'is_reprint_done_successful_by',
        'is_reprint_done_successful_at',
        
    ];
}
