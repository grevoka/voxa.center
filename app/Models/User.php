<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'locale'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_PARTNER = 'partner';
    const ROLE_EDITOR = 'editor';

    const ROLES = [
        self::ROLE_ADMIN => 'Administrateur',
        self::ROLE_PARTNER => 'Partenaire',
        self::ROLE_EDITOR => 'Editeur',
    ];

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isPartner(): bool
    {
        return $this->role === self::ROLE_PARTNER;
    }

    public function isEditor(): bool
    {
        return $this->role === self::ROLE_EDITOR;
    }

    public function roleName(): string
    {
        return self::ROLES[$this->role] ?? $this->role;
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function sharedFiles(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'file_shares')->withPivot('created_at');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
