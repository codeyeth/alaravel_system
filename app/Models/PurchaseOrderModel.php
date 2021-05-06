<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_order_no', 
        'agency_id',
        'agency_code',
        'agency_name',
        'agency_address',
        'region',
        'contact_person',
        'contact_no',
        'email',

        'goods_type',
        'po_source',
        
        'is_posted',
        'is_posted_by_id',
        'is_posted_by_name',
        'is_posted_at',

        'created_by_id',
        'created_by_name',  
        'date',

    ];
}
