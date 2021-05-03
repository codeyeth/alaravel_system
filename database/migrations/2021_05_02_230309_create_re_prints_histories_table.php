<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRePrintsHistoriesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('re_prints_histories', function (Blueprint $table) {
            $table->id();
            $table->string('ballot_id');
            $table->string('unique_number');
            $table->text('description');
            $table->text('action');
            $table->string('created_by_id');
            $table->string('created_by_name');
            $table->string('date');
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
        Schema::dropIfExists('re_prints_histories');
    }
}
