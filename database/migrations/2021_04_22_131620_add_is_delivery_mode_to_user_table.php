<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDeliveryModeToUserTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_delivered_mode')->nullable()->default(false);
            $table->boolean('is_out_for_delivery_mode')->nullable()->default(false);
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
}
