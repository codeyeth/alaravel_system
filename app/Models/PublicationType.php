<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationType extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'publication_type', 'created_by_id', 'created_by_name',
    ];
    
}
