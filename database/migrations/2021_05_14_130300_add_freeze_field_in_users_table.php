<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFreezeFieldInUsersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_freezed')->nullable()->default(false);
            $table->string('is_freezed_by_id')->nullable();
            $table->string('is_freezed_by')->nullable();
            $table->string('is_freezed_at')->nullable();
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
