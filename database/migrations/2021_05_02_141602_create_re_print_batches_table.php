<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRePrintBatchesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('re_print_batches', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_count');
            $table->string('batch_content');
            
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
            
            $table->string('created_by_id');
            $table->string('created_by_name');
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
        Schema::dropIfExists('re_print_batches');
    }
}
