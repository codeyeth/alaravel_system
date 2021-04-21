<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierFiles extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'belongs_to', 'original_filename', 'converted_filename', 'filetype', 'filesize',
    ];
    
}
