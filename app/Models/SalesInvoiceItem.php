<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoiceItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'sales_invoice_code', 
        'quantity',
        'unit',
        'item_description',
        'additional_description',
        'price',
        'total',
        'created_by_id',
        'created_by_name',
    ];
}
