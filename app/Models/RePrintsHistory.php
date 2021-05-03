<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RePrintsHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'ballot_id',
        'unique_number',
        'description',
        'action',
        'created_by_id',
        'created_by_name',
        'date',
    ];
}
