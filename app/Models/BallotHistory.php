<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BallotHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'ballot_id',
        'action',
        'old_status',
        'old_status_type',
        'new_status',
        'new_status_type',
        'for',
        'status_by_id',
        'status_by_name',
        'status_by_at',
        'status_by_at_date',
    ];
}
