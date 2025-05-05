<?php

namespace App\Models;

use App\Models\Portfolio;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject {
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'email',
        'email_verified_at',
        'password',
        'avatar',
        'cover_photo',
        'google_id',
        'role',
        'status',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array {
        return [
            'id'                => 'integer',
            'first_name'        => 'string',
            'last_name'         => 'string',
            'user_name'         => 'string',
            'email'             => 'string',
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'avatar'            => 'string',
            'cover_photo'       => 'string',
            'google_id'         => 'string',
            'role'              => 'string',
            'status'            => 'string',
            'remember_token'    => 'string',
            'created_at'        => 'datetime',
            'updated_at'        => 'datetime',
            'deleted_at'        => 'datetime',
        ];
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array {
        return [];
    }

    /**
     * When saving user_name, always lowercase
     */
    public function setUserNameAttribute($value) {
        $this->attributes['user_name'] = strtolower($value);
    }

    /**
     * When saving email, always lowercase
     */
    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * successor for avatar attribute
     *
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
            return asset('backend/images/users/user-dummy-img.jpg');
        }
    }

    public function profile(): HasOne {
        return $this->hasOne(Profile::class);
    }

    public function portfolios(): HasMany {
        return $this->hasMany(Portfolio::class);
    }
}
