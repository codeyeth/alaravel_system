<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogbookParent extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'uuid', 'agency_name', 'agency_address',
    ];
    
}
