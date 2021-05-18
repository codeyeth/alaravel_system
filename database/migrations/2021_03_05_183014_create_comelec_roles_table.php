<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComelecRolesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('comelec_roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_id');
            $table->string('comelec_role');
            $table->string('demo_role');
            $table->string('added_by_id');
            $table->string('added_by_name');
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
        Schema::dropIfExists('comelec_roles');
    }
}
