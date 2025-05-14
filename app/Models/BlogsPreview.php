<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsPreview extends Model {
    use HasFactory;

    protected $fillable = [
        'id',
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
