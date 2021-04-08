<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_configs', function (Blueprint $table) {
            $table->id();
            $table->string('copies')->nullable();
            $table->string('personnel')->nullable();
            $table->string('authorization')->nullable();
            $table->string('title')->nullable();
            $table->string('title_list')->nullable();
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
        Schema::dropIfExists('delivery_configs');
    }
}
