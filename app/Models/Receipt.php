<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Delivery;

class Receipt extends Model
{
    use HasFactory;
    protected $fillable = ['id','DR_NO','company','address','contact','created_at','updated_at'];

    public function deliveries(){
        return $this->hasMany(Delivery::class,'DR_NO','DR_NO');
    }
}
