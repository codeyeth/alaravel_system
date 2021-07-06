<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWastageManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wastage_management', function (Blueprint $table) {
            $table->id();

            $table->string('ballot_id');
            $table->string('unique_number');
            $table->text('description');
            $table->string('created_by_id');
            $table->string('created_by_name');
            
            $table->boolean('is_from_bad_ballots')->nullable()->default(false);       

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
        Schema::dropIfExists('wastage_management');
    }
}
