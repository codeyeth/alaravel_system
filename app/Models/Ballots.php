<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ballots extends Model
{
    use HasFactory;
    protected $fillable = [
        'current_status',
        'new_status_type',
        'status_updated_by_id',
        'status_updated_by',
        'status_updated_at',
        
        'is_re_print',
        'is_re_print_by_id',
        'is_re_print_by',
        'is_re_print_at',
        're_print_id',

        'is_re_print_done',
        'is_re_print_done_by_id',
        'is_re_print_done_by',
        'is_re_print_done_at',
        
        'is_delivered',
        'is_delivered_by_id',
        'is_delivered_by',
        'is_delivered_at',
        
        'is_dr_done',
        'is_dr_done_by_id',
        'is_dr_done_by',
        'is_dr_done_at',
        
        'is_out_for_delivery',
        'is_out_for_delivery_by_id',
        'is_out_for_delivery_by',
        'is_out_for_delivery_at',
        
    ];
}
