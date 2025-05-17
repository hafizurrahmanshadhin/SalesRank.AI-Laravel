<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIPrompt extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
    ];

    protected $casts = [
        'id'         => 'integer',
        'title'      => 'string',
        'image'      => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
