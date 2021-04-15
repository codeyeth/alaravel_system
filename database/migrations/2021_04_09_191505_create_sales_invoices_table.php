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
            
            $table->string('agency_id');
            $table->string('agency_code');
            $table->string('agency_name');
            $table->string('agency_address');
            $table->string('region');
            $table->string('contact_person');
            $table->string('contact_no');
            $table->string('email');
            
            $table->string('transaction_type');
            $table->string('payment_mode');
            $table->string('package_type');
            $table->string('work_order_no');
            $table->string('stock_no');
            $table->string('issued_by');
            
            $table->string('pr_no')->nullable();
            $table->string('dr_no')->nullable();
            $table->string('or_no')->nullable();
            
            $table->boolean('is_posted')->nullable()->default(false);
            $table->string('is_posted_by_id')->nullable();
            $table->string('is_posted_by_name')->nullable();
            $table->string('is_posted_at')->nullable();
            
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
