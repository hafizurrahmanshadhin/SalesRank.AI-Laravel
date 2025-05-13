<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'title',
        'image',
        'description',
        'status',
    ];

    protected $casts = [
        'id'          => 'integer',
        'name'        => 'string',
        'title'       => 'string',
        'image'       => 'string',
        'description' => 'string',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];
}
