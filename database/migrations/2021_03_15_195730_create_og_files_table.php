<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOgFilesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('og_files', function (Blueprint $table) {
            $table->id();
            $table->string('belongs_to'); //UUID
            $table->string('original_filename')->nullable();
            $table->string('converted_filename')->nullable();
            $table->string('filetype')->nullable();
            $table->string('filesize')->nullable();
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
        Schema::dropIfExists('og_files');
    }
}
