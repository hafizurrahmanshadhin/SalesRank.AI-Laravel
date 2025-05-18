<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultingPageHeroSection extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
    ];

    protected $casts = [
        'id'          => 'integer',
        'title'       => 'string',
        'image'       => 'string',
        'description' => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];
}
