<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierInfoDbsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('courier_info_dbs', function (Blueprint $table) {
            $table->id();
            //COURIER DETAILS
            $table->string('name');
            $table->string('contact_no');
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('vehicle_type');
            $table->string('file_id');
            
            //CLAIMED PRODUCT DETAILS
            $table->string('dr_no');
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
        Schema::dropIfExists('courier_info_dbs');
    }
}
