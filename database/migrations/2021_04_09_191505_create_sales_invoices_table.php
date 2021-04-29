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
            
            $table->string('goods_type'); //IF GENERIC OR SPECIALIZED
            $table->string('transaction_type');
            $table->string('payment_mode');
            $table->string('package_type');
            $table->string('work_order_no');
            $table->string('stock_no');
            $table->string('issued_by');
            $table->string('received_by');
            
            $table->string('pr_no')->nullable();
            $table->string('dr_no')->nullable();
            $table->string('or_no')->nullable();
            $table->string('or_no_date')->nullable();
            
            //IS POSTED TO CLIENT LEDGER
            $table->boolean('is_posted')->nullable()->default(false);
            $table->string('is_posted_by_id')->nullable();
            $table->string('is_posted_by_name')->nullable();
            $table->string('is_posted_at')->nullable();
            
            // IS POSTED TO DR
            $table->boolean('is_posted_to_dr')->nullable()->default(false);
            $table->string('is_posted_to_dr_by_id')->nullable();
            $table->string('is_posted_to_dr_by_name')->nullable();
            $table->string('is_posted_to_dr_at')->nullable();
            
            //IF DELIVERED / OR NOT FOR UNCLAIMED AND CLAIMED GOODS
            $table->boolean('is_delivered')->nullable()->default(false);
            $table->string('is_delivered_by_id')->nullable();
            $table->string('is_delivered_by_name')->nullable();
            $table->string('is_delivered_at')->nullable();
            
            // FOR SELECTING MONTHLY ACCOMPLISHED S.I PER STAFF
            $table->string('date');
            
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
