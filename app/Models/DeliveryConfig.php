<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryConfig extends Model
{
    use HasFactory;
    protected $fillable = ['copies','title_list'];
}
