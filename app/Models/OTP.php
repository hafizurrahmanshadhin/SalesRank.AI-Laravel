<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class OTP extends Model {
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'operation',
        'number',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function casts(): array {
        return [
            'id'         => 'integer',
            'user_id'    => 'integer',
            'operation'  => 'string',
            'number'     => 'integer',
            'status'     => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
