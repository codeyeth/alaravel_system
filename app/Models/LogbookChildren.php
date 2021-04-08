<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogbookChildren extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'visiting_nature', 'client_name',
    ];

}
