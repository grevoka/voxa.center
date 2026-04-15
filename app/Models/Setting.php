<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = 'key';
    protected $keyType = 'string';
    protected $fillable = ['key', 'value'];

    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = Cache::remember('app_settings', 3600, function () {
            return self::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    public static function set(string $key, ?string $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('app_settings');
    }

    public static function setMany(array $data): void
    {
        foreach ($data as $key => $value) {
            self::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        Cache::forget('app_settings');
    }

    public static function getSmtpConfig(): array
    {
        return [
            'smtp_enabled' => self::get('smtp_enabled', '0'),
            'smtp_host' => self::get('smtp_host', ''),
            'smtp_port' => self::get('smtp_port', '587'),
            'smtp_encryption' => self::get('smtp_encryption', 'tls'),
            'smtp_username' => self::get('smtp_username', ''),
            'smtp_password' => self::get('smtp_password', ''),
            'smtp_from_address' => self::get('smtp_from_address', ''),
            'smtp_from_name' => self::get('smtp_from_name', 'Voxa Center'),
        ];
    }
}
