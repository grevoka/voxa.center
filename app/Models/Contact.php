<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'profile',
        'interests',
        'message',
        'preferred_date',
        'preferred_time',
        'read',
        'archived_at',
        'client_id',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ContactMessage::class)->orderBy('created_at');
    }

    public function appointment(): HasOne
    {
        return $this->hasOne(Appointment::class)->where('status', 'confirmed');
    }

    protected $casts = [
        'interests' => 'array',
        'preferred_date' => 'date',
        'read' => 'boolean',
        'archived_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->whereNull('archived_at');
    }

    public function scopeArchived($query)
    {
        return $query->whereNotNull('archived_at');
    }

    public function isArchived(): bool
    {
        return $this->archived_at !== null;
    }
}
