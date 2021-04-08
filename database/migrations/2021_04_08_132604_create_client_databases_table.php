<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDatabasesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('client_databases', function (Blueprint $table) {
            $table->id();
            $table->string('agency_code');
            $table->string('agency_name');
            $table->string('agency_address');
            $table->string('contact_person');
            $table->string('contact_no');
            $table->string('email');
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
        Schema::dropIfExists('client_databases');
    }
}