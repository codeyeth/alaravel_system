<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SEComposing extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'is_on', 'status_by_id', 'status_by_name', 'status_at', 
    ];
}
