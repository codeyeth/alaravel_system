<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = ['id','BALLOT_ID','CLUSTERED_PREC','DR_NO','REGION','PROV_NAME','MUN_NAME','BGY_NAME','CLUSTER_TOTAL','created_at','updated_at'];

}
