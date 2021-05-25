<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BbDescriptionDatabase extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'description',
        'created_by_id',
        'created_by_name',
    ];
}
