<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Portfolio extends Model {
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id',
        'project_path',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array {
        return [
            'id'           => 'integer',
            'user_id'      => 'integer',
            'project_path' => 'string',
            'status'       => 'boolean',
            'created_at'   => 'datetime',
            'updated_at'   => 'datetime',
            'deleted_at'   => 'datetime',
        ];
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
