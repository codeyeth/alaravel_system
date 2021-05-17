<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SalesInvoiceItem;

class SmdDeliveryReceipt extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'dr_no', 
        'agency_id',
        'agency_code',
        'agency_name',
        'agency_address',
        'region',
        'contact_person',
        'contact_no',
        'email',
        'sales_invoice_id',
        'sales_invoice_code', 
        'stock_no', 
        'or_no', 
        'issued_by',
        'received_by',
        'no_of_bundles',
        'remarks',
        'is_delivered',
        'is_delivered_by_id',
        'is_delivered_by_name',
        'is_delivered_at',
        'created_by_id',
        'created_by_name',
    ];
    public function sales_invoice_items(){
        return $this->hasMany(SalesInvoiceItem::class,'sales_invoice_code');
    }
    
}
