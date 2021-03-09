<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBallotHistoriesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('ballot_histories', function (Blueprint $table) {
            $table->id();
            $table->string('ballot_id');            
            $table->string('action');      
            $table->string('old_status')->nullable();            
            $table->string('new_status');            
            $table->string('status_by_id');            
            $table->string('status_by_name');
            $table->string('status_by_at');
            $table->string('status_by_at_date');
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
        Schema::dropIfExists('ballot_histories');
    }
}
