<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubParent extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',  'product_sub_code', 'product_name', 
    ];
}
