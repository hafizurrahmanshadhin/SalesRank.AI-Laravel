<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AICoachPageHeroSection extends Model {
    use HasFactory;

    protected $table = 'a_i_coach_page_hero_sections';

    protected $fillable = [
        'title',
        'image',
        'description',
        'banner',
        'sub_title',
        'sub_description',
    ];

    protected $casts = [
        'id'              => 'integer',
        'title'           => 'string',
        'description'     => 'string',
        'banner'          => 'string',
        'sub_title'       => 'string',
        'sub_description' => 'string',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
    ];
}
