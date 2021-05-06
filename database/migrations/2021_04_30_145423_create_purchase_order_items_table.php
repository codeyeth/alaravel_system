<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_order_no');
            
            $table->string('quantity');
            $table->string('unit');
            $table->string('item_description');
            $table->string('additional_description');
            $table->string('price');
            $table->string('total');
            $table->string('form_type');
            
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
        Schema::dropIfExists('purchase_order_items');
    }
}
