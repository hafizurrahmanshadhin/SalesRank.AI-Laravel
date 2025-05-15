<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Newsletter extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'text',
        'status',
    ];

    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'email'      => 'string',
        'text'       => 'string',
        'status'     => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * When saving email, always lowercase
     */
    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
    }
}
