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
    ];
}
