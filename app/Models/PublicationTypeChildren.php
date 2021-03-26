<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationTypeChildren extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'publication_parent_id', 'publication_type_child', 'created_by_id', 'created_by_name',
    ];
    
}
