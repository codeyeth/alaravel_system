<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOgSoftcopiesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('og_softcopies', function (Blueprint $table) {
            $table->id();
            $table->string('article_title');
            $table->string('petitioner_id')->nullable();
            
            // PPCD SIDE
            $table->string('petitioner_name')->nullable();
            $table->string('petitioner_address')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('date_paid')->nullable();
            $table->boolean('is_payment_complete')->nullable()->default(false);
            
            $table->string('petitioner_encoded_by_id')->nullable();
            $table->string('petitioner_encoded_by_name')->nullable();
            $table->string('petitioner_encoded_at')->nullable();
            
            $table->string('encoded_by_id')->nullable();
            $table->string('encoded_by_name')->nullable();
            
            $table->string('publication_type');
            $table->string('publication_sub_type');
            $table->string('date_published');
            $table->string('file_id');
            $table->boolean('is_downloadable')->nullable()->default(false);
            $table->boolean('is_searchable')->nullable()->default(false);
            
            $table->string('date');
            
            // $table->boolean('is_printed')->nullable()->default(false);
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
        Schema::dropIfExists('og_softcopies');
    }
}
