<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorpoolRequest extends Model
{
    use HasFactory;
    protected $fillable = ['reason','is_approved'];
}
