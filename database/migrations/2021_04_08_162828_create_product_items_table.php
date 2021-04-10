<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductItemsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('product_items', function (Blueprint $table) {
            $table->id();
            $table->string('product_code');
            $table->string('product_sub_code');
            $table->string('form_no');
            $table->string('description');
            $table->string('unit');
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
        Schema::dropIfExists('product_items');
    }
}
