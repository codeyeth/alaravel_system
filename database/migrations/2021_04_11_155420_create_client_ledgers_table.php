<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientLedgersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('client_ledgers', function (Blueprint $table) {
            $table->id();
            //CLIENT DETAILS
            $table->string('agency_id');
            $table->string('agency_code');
            
            //SALES INVOICE DETAILS
            $table->string('pr_no')->nullable();
            $table->string('stock_no');
            
            $table->string('sales_invoice_created_at');
            $table->string('sales_invoice_code');
            $table->string('or_no')->nullable();
            
            //ITEM/S DETAILS
            // $table->string('item_description');
            // $table->string('quantity');
            // $table->string('overall_total');
            
            //
            $table->string('remarks')->nullable();
            
            //POSTED BY/AT
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
        Schema::dropIfExists('client_ledgers');
    }
}
