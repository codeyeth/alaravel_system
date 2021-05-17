<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id', 'fname', 'mname', 'lname', 
        'name', 'email', 'position', 
        'division', 'section', 'is_user_mgt', 
        'is_ballot_tracking', 'is_dr',
        'is_gazette', 'is_motorpool', 'comelec_role', 'barcoded_receiver', 'created_by_id', 'created_by_name',
        'last_updated_by_id', 'last_updated_by_name', 'password', 'password_string', 'is_pw_changed', 'is_admin',
        'is_ballot_in', 'is_search_mode', 'is_verification_type_bad', 'is_smd_system',
        'is_delivered_mode', 'is_out_for_delivery_mode', 'is_super_admin',
        'is_freezed', 'is_freezed_by_id', 'is_freezed_by', 'is_freezed_at',
    ];
    
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
