<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'login',
        'password',
        'locale',
        'setup_token',
        'setup_token_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'setup_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'setup_token_expires_at' => 'datetime',
        ];
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function isSetup(): bool
    {
        return $this->password !== null && $this->login !== null;
    }

    public static function generateLogin(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name));
        $lastName = $parts[count($parts) - 1] ?? 'XXX';
        $firstName = $parts[0] ?? 'XXX';

        $prefix = 'VX-'
            . strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $lastName), 0, 3))
            . strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $firstName), 0, 3));

        $prefix = str_pad($prefix, 9, 'X');

        do {
            $suffix = strtoupper(bin2hex(random_bytes(2)));
            $login = $prefix . $suffix;
        } while (self::where('login', $login)->exists());

        return $login;
    }
}
