<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OgSoftcopy extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'article_title', 'petitioner_id', 'petitioner_name', 'petitioner_address', 'amount_paid', 'date_paid', 'is_payment_complete', 'publication_type', 'date_published', 'is_downloadable', 'file_id'
    ];
}