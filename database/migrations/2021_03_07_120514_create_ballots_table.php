<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBallotsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('ballots', function (Blueprint $table) {
            $table->id();
            $table->string('region');            
            $table->string('prov_name');            
            $table->string('mun_name');            
            $table->string('bgy_name');       
            $table->string('pollplace');       
            $table->string('pollstreet');       
            $table->string('cluster_no');       
            $table->string('clustered_prec');       
            $table->string('cluster_total');       
            $table->string('group_no');       
            $table->string('ballot_id'); 
            
            //CURRENT STATUS AND THE UPDATER
            $table->string('current_status')->nullable()->default(false);     
            $table->string('status_updated_by_id')->nullable()->default(false);       
            $table->string('status_updated_by')->nullable()->default(false);    
            $table->string('status_updated_at')->nullable()->default(false);    
            
            //IF BALLOT IS REPRINT
            $table->boolean('is_re_print')->nullable()->default(false);       
            $table->string('is_re_print_by_id')->nullable();       
            $table->string('is_re_print_by')->nullable();       
            $table->string('is_re_print_at')->nullable();       
            $table->string('re_print_id')->nullable();    
            
            // IF THIS REPRINT BALLOT IS DONE REPRINTING
            $table->boolean('is_re_print_done')->nullable()->default(false);       
            $table->string('is_re_print_done_by_id')->nullable();       
            $table->string('is_re_print_done_by')->nullable();       
            $table->string('is_re_print_done_at')->nullable();       
            
            //BALLOT IS DONE AND DELIVERED TO THE BALLOT LOCATION THIS WILL BE UPDATED BY THE COMELEC DELIVERY
            $table->boolean('is_delivered')->nullable()->default(false);   
            $table->string('is_delivered_by_id')->nullable();       
            $table->string('is_delivered_by')->nullable();       
            $table->string('is_delivered_at')->nullable();   
            
            //IF THE BALLOT HAS ASSOCIATED DR 
            $table->boolean('is_dr_done')->nullable()->default(false);   
            $table->string('is_dr_done_by_id')->nullable();       
            $table->string('is_dr_done_by')->nullable();       
            $table->string('is_dr_done_at')->nullable();  
            
            $table->string('new_status_type')->nullable();            

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
        Schema::dropIfExists('ballots');
    }
}
