<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDatabase extends Model
{
    use HasFactory;
    protected $fillable = [
        'agency_code',
        'agency_name',
        'agency_address',
        'contact_person',
        'contact_no',
        'email',
        'created_by_id',
        'created_by_name',
    ];
}
