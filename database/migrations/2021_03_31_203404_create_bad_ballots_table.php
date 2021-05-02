<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadBallotsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('bad_ballots', function (Blueprint $table) {
            $table->id();
            $table->string('ballot_id');
            $table->string('unique_number');
            $table->text('description');
            $table->string('created_by_id');
            $table->string('created_by_name');
            $table->string('created_by_comelec_role');
            
            $table->string('reprint_batch')->nullable();       
            $table->string('reprint_batch_by_id')->nullable();       
            $table->string('reprint_batch_by')->nullable();       
            $table->string('reprint_batch_at')->nullable();  
            
            $table->boolean('is_reprint_batch_start')->nullable()->default(false);       
            $table->string('is_reprint_batch_start_by_id')->nullable();       
            $table->string('is_reprint_batch_start_by')->nullable();       
            $table->string('is_reprint_batch_start_at')->nullable();  
            
            $table->boolean('is_reprint_done')->nullable()->default(false);       
            $table->string('is_reprint_done_by_id')->nullable();       
            $table->string('is_reprint_done_by')->nullable();       
            $table->string('is_reprint_done_at')->nullable();  
            
            $table->boolean('is_reprint_done_successful')->nullable()->default(false);       
            $table->string('is_reprint_done_successful_by_id')->nullable();       
            $table->string('is_reprint_done_successful_by')->nullable();       
            $table->string('is_reprint_done_successful_at')->nullable();  
            
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
        Schema::dropIfExists('bad_ballots');
    }
}
