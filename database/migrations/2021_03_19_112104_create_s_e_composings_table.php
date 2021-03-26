<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSEComposingsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('s_e_composings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_on')->nullable()->default(false);
            $table->string('status_by_id')->nullable();
            $table->string('status_by_name')->nullable();
            $table->string('status_at')->nullable();
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
        Schema::dropIfExists('s_e_composings');
    }
}
