<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = ['id','BALLOT_ID','CLUSTERED_PREC','DR_NO','CITY_MUN_PROV','CLUSTER_TOTAL','description','agency_name','created_at','updated_at','contact_no'];

}
