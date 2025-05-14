<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
    ];

    protected $casts = [
        'id'          => 'integer',
        'title'       => 'string',
        'description' => 'string',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];
}
