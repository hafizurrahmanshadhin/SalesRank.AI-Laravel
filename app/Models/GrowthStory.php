<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrowthStory extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'image',
    ];

    protected $casts = [
        'id'         => 'integer',
        'title'      => 'string',
        'image'      => 'string',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
