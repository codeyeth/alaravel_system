<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SalesInvoice;

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
    public function sales_invoices(){
        return $this->belongsTo(SalesInvoice::class,'sales_invoice_code','sales_invoice_code');
    }
}
