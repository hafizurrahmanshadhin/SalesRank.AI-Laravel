<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerSpotlight extends Model {
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
    ];

    protected $casts = [
        'id'          => 'integer',
        'title'       => 'string',
        'description' => 'string',
        'image'       => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];
}
