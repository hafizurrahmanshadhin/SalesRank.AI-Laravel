<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRankAI extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    protected $casts = [
        'id'          => 'integer',
        'title'       => 'string',
        'description' => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];
}
