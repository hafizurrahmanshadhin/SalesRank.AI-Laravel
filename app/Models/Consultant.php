<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Consultant extends Model {
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'user_id',
        'linkedin_url',
        'full_name',
        'job_title',
        'company',
        'industry',
        'total_experience',
        'tenure',
        'performance_keywords',
        'achievements',
        'revenue_closed',
        'college_degree',
        'location',
        'ai_score', // AI Generated
        'ranking_level', // AI Ranking
    ];

    protected $casts = [
        'id'                   => 'integer',
        'user_id'              => 'integer',
        'linkedin_url'         => 'string',
        'full_name'            => 'string',
        'job_title'            => 'string',
        'company'              => 'string',
        'industry'             => 'string',
        'total_experience'     => 'integer',
        'tenure'               => 'integer',
        'performance_keywords' => 'boolean',
        'achievements'         => 'string',
        'revenue_closed'       => 'string',
        'college_degree'       => 'boolean',
        'location'             => 'string',
        'ai_score'             => 'decimal:2', // AI Generated
        'ranking_level'        => 'string', // AI Ranking
    ];
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
