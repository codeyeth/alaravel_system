<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientLedger extends Model
{
    use HasFactory;
    protected $fillable = [
        'agency_id',
        'agency_code',
        
        'pr_no',
        'stock_no',
        'sales_invoice_created_at',
        'sales_invoice_code',
        'or_no',
        
        'remarks',
        
        'created_by_id',
        'created_by_name',
    ];
}