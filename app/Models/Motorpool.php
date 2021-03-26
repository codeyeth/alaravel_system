<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorpool extends Model
{
    use HasFactory;
    protected $fillable = ['reason','signature_file','is_approved','status','datetime','division','section'];
   
}
