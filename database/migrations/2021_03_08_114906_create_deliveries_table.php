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
            $table->string('CLUSTER_TOTAL')->nullable();
            $table->string('REGION')->nullable();
            $table->string('PROV_NAME')->nullable();
            $table->string('MUN_NAME')->nullable();
            $table->string('BGY_NAME')->nullable();
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
