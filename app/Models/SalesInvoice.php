<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SalesInvoiceItem;

class SalesInvoice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'sales_invoice_code', 
        'code',
        'agency_id',
        'agency_code',
        'agency_name',
        'agency_address',
        'region',
        'contact_person',
        'contact_no',
        'email',
        'payment_mode',
        'package_type',
        'transaction_type',
        'work_order_no',
        'stock_no',
        'issued_by',
        'is_posted',
        'is_posted_by_id',
        'is_posted_by_name',
        'is_posted_at',
        'created_by_id',
        'created_by_name',
        'pr_no',
        'dr_no',
        'or_no',
        'date',
    ];
    //para di ko na kailangan magjoin query hehehe 
    public function sales_invoice_items(){
        return $this->hasMany(SalesInvoiceItem::class,'sales_invoice_code');
    }
}
