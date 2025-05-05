<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Profile extends Model {
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id',
        'phone_number',
        'linkedin_profile_url',
        'revenue_generated_year',
        'revenue_generated',
        'industry_experience',
        'present_club_experience',
        'lead_close_ratio',
        'working_role',
        'country',
        'bio',
        'status',
    ];

    protected function casts(): array {
        return [
            'id'                      => 'integer',
            'user_id'                 => 'integer',
            'phone_number'            => 'string',
            'linkedin_profile_url'    => 'string',
            'revenue_generated_year'  => 'integer',
            'revenue_generated'       => 'decimal:2',
            'industry_experience'     => 'float',
            'present_club_experience' => 'float',
            'lead_close_ratio'        => 'decimal:2',
            'working_role'            => 'string',
            'country'                 => 'string',
            'bio'                     => 'string',
            'status'                  => 'string',
            'created_at'              => 'datetime',
            'updated_at'              => 'datetime',
            'deleted_at'              => 'datetime',
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
