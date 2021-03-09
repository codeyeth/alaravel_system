<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ballots extends Model
{
    use HasFactory;
    protected $fillable = [
        'current_status',
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
    ];
}
