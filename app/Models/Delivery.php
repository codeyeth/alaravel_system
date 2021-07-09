<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receipt;


class Delivery extends Model
{
    use HasFactory;
    protected $fillable = ['id','BALLOT_ID','CLUSTERED_PREC','DR_NO','CITY_MUN_PROV','CLUSTER_TOTAL','description','agency_name','created_at','updated_at','contact_no','complete_address'];

    public function receipts(){
        return $this->belongsTo(Receipt::class,'DR_NO');
    }
}
