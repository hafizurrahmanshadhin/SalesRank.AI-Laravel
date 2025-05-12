<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageVideoBannerSection extends Model {
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'video',
        'video_thumbnail',
    ];

    protected $casts = [
        'id'              => 'integer',
        'title'           => 'string',
        'description'     => 'string',
        'video'           => 'string',
        'video_thumbnail' => 'string',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
    ];
}
