<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('DR_NO')->nullable();
            $table->string('BALLOT_ID')->nullable();
            $table->string('CLUSTERED_PREC')->nullable();
            $table->integer('CLUSTER_TOTAL')->default('0');
            $table->string('CITY_MUN_PROV')->nullable();
            $table->string('curr_stat')->nullable();
            $table->timestamps();
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
