<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoicesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('sales_invoice_code');
            $table->string('code');
            
            $table->string('agency_code');
            $table->string('agency_name');
            $table->string('agency_address');
            $table->string('region');
            $table->string('contact_person');
            $table->string('contact_no');
            $table->string('email');
            
            $table->string('transaction_type');
            $table->string('payment_type');
            $table->string('work_order_no');
            $table->string('stock_no');
            $table->string('issued_by');
            
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
        Schema::dropIfExists('sales_invoices');
    }
}
