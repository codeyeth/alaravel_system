<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'sales_invoice_code', 
        'code',
        'agency_code',
        'agency_name',
        'agency_address',
        'region',
        'contact_person',
        'contact_no',
        'email',
        'payment_type',
        'transaction_type',
        'work_order_no',
        'stock_no',
        'issued_by',
        'created_by_id',
        'created_by_name',
    ];
}
