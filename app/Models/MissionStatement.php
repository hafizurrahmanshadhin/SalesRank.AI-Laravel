<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionStatement extends Model {
    use HasFactory;

    protected $fillable = [
        'image',
        'description',
    ];

    protected $casts = [
        'id'          => 'integer',
        'image'       => 'string',
        'description' => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];
}
