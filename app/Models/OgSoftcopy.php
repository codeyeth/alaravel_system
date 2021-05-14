<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OgSoftcopy extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'article_title', 'petitioner_id', 'petitioner_name', 'petitioner_address', 
        'amount_paid', 'date_paid', 'is_payment_complete', 
        'petitioner_encoded_by_id', 'petitioner_encoded_by_name', 'petitioner_encoded_at', 
        'encoded_by_id', 'encoded_by_name',
        'publication_type', 'publication_sub_type', 'date_published', 'is_downloadable', 'is_searchable', 'file_id', 'date',
    ];
}