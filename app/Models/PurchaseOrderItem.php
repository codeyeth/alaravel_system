<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_order_no', 
        'quantity',
        'unit',
        'item_description',
        'additional_description',
        'price',
        'total',
        'created_by_id',
        'created_by_name',
        'form_type',
    ];
}
