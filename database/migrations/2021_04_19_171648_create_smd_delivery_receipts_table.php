<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmdDeliveryReceiptsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('smd_delivery_receipts', function (Blueprint $table) {
            $table->id();
            
            $table->string('dr_no');
            
            $table->string('agency_id');
            $table->string('agency_code');
            $table->string('agency_name');
            $table->string('agency_address');
            $table->string('region');
            $table->string('contact_person');
            $table->string('contact_no');
            $table->string('email');
            
            $table->string('sales_invoice_id');
            $table->string('sales_invoice_code');
            
            $table->string('stock_no');
            $table->string('or_no')->nullable();
            
            $table->string('issued_by')->nullable();
            $table->string('received_by')->nullable();
            $table->string('no_of_bundles')->nullable();
            $table->string('remarks')->nullable();
            
            $table->boolean('is_delivered')->nullable()->default(false);
            $table->string('is_delivered_by_id')->nullable();
            $table->string('is_delivered_by_name')->nullable();
            $table->string('is_delivered_at')->nullable();
            
            $table->string('created_by_id')->nullable();
            $table->string('created_by_name')->nullable();
            
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
        Schema::dropIfExists('smd_delivery_receipts');
    }
}
