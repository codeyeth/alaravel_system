<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItems extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_code', 
        'product_sub_code',
        'form_no',
        'description',
        'unit',
        'created_by_id',
        'created_by_name',
    ];
    
}
