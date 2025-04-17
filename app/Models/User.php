<?php

namespace App\Models;

use App\Models\Portfolio;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject {
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array {
        return [
            'id'                => 'integer',
            'role_id'           => 'integer',
            'first_name'        => 'string',
            'last_name'         => 'string',
            'handle'            => 'string',
            'email'             => 'string',
            'email_verified_at' => 'datetime',
            'password'          => 'string',
            'avatar'            => 'string',
            'google_id'         => 'string',
            'status'            => 'boolean',
            'remember_token'    => 'string',
            'created_at'        => 'datetime',
            'updated_at'        => 'datetime',
            'deleted_at'        => 'datetime',
        ];
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    /**
     * successor for avatar attribute
     * @param mixed $url
     * @return string
     */
    public function getAvatarAttribute($url): string {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('storage/' . $url);
            }
        } else {
            return asset('assets/img/user_placeholder.png');
        }
    }

    public function profile(): HasOne {
        return $this->hasOne(Profile::class);
    }

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }

    public function portfolios(): HasMany {
        return $this->hasMany(Portfolio::class);
    }
}
