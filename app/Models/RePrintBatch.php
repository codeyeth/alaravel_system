<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RePrintBatch extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'batch_count', 
        'batch_content',
        'created_by_id',
        'created_by_name',
    ];
}
