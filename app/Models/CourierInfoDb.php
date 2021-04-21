<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierInfoDb extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'contact_no', 'company_name', 'company_address', 'vehicle_type', 'file_id', 'dr_no', 'created_by_id', 'created_by_name',
    ];
    
}
