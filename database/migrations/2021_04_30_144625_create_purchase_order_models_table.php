<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderModelsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('purchase_order_models', function (Blueprint $table) {
            $table->id();
            
            $table->string('purchase_order_no');
            
            $table->string('agency_id');
            $table->string('agency_code');
            $table->string('agency_name');
            $table->string('agency_address');
            $table->string('region');
            $table->string('contact_person');
            $table->string('contact_no');
            $table->string('email');
            
            $table->string('goods_type'); //IF GENERIC OR SPECIALIZED
            $table->string('po_source');
            
            //IS POSTED TO SALES INVOICE
            $table->boolean('is_posted')->nullable()->default(false);
            $table->string('is_posted_by_id')->nullable();
            $table->string('is_posted_by_name')->nullable();
            $table->string('is_posted_at')->nullable();
            
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
        Schema::dropIfExists('purchase_order_models');
    }
}
