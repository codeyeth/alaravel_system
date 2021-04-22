<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldOutForDeliveryInBallotsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('ballots', function (Blueprint $table) {
            //BALLOT IS DONE AND DELIVERED TO THE BALLOT LOCATION THIS WILL BE UPDATED BY THE COMELEC DELIVERY
            $table->boolean('is_out_for_delivery')->nullable()->default(false);   
            $table->string('is_out_for_delivery_by_id')->nullable();       
            $table->string('is_out_for_delivery_by')->nullable();       
            $table->string('is_out_for_delivery_at')->nullable();   
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('ballots', function (Blueprint $table) {
            //
        });
    }
}
