<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'ip',
        'url',
        'path',
        'referrer',
        'referrer_host',
        'user_agent',
        'device',
        'browser',
        'browser_version',
        'os',
        'country',
        'is_bounce',
        'duration',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'is_bounce' => 'boolean',
    ];

    public static function parseUserAgent(?string $ua): array
    {
        if (!$ua) {
            return ['browser' => null, 'browser_version' => null, 'os' => null, 'device' => 'desktop'];
        }

        // Browser detection
        $browser = null;
        $browserVersion = null;

        if (preg_match('/Edg[e\/]([\d.]+)/i', $ua, $m)) {
            $browser = 'Edge';
            $browserVersion = $m[1];
        } elseif (preg_match('/OPR\/([\d.]+)/i', $ua, $m)) {
            $browser = 'Opera';
            $browserVersion = $m[1];
        } elseif (preg_match('/Chrome\/([\d.]+)/i', $ua, $m)) {
            $browser = 'Chrome';
            $browserVersion = $m[1];
        } elseif (preg_match('/Firefox\/([\d.]+)/i', $ua, $m)) {
            $browser = 'Firefox';
            $browserVersion = $m[1];
        } elseif (preg_match('/Safari\/([\d.]+)/i', $ua) && preg_match('/Version\/([\d.]+)/i', $ua, $m)) {
            $browser = 'Safari';
            $browserVersion = $m[1];
        } elseif (preg_match('/MSIE ([\d.]+)/i', $ua, $m) || preg_match('/Trident.*rv:([\d.]+)/i', $ua, $m)) {
            $browser = 'IE';
            $browserVersion = $m[1];
        }

        // OS detection
        $os = null;
        if (str_contains($ua, 'Windows')) $os = 'Windows';
        elseif (str_contains($ua, 'Macintosh') || str_contains($ua, 'Mac OS')) $os = 'macOS';
        elseif (str_contains($ua, 'Linux') && !str_contains($ua, 'Android')) $os = 'Linux';
        elseif (str_contains($ua, 'Android')) $os = 'Android';
        elseif (str_contains($ua, 'iPhone') || str_contains($ua, 'iPad')) $os = 'iOS';
        elseif (str_contains($ua, 'CrOS')) $os = 'ChromeOS';

        // Device detection
        $device = 'desktop';
        if (preg_match('/Mobile|Android.*Mobile|iPhone|iPod/i', $ua)) {
            $device = 'mobile';
        } elseif (preg_match('/iPad|Android(?!.*Mobile)|Tablet/i', $ua)) {
            $device = 'tablet';
        }

        // Truncate version
        if ($browserVersion && str_contains($browserVersion, '.')) {
            $browserVersion = implode('.', array_slice(explode('.', $browserVersion), 0, 2));
        }

        return compact('browser', 'browserVersion', 'os', 'device');
    }

    public static function parseReferrerHost(?string $referrer): ?string
    {
        if (!$referrer) return null;
        $host = parse_url($referrer, PHP_URL_HOST);
        if (!$host) return null;
        // Remove www.
        return preg_replace('/^www\./i', '', $host);
    }

    // ─── Scopes ───

    public function scopeToday($q)
    {
        return $q->whereDate('created_at', today());
    }

    public function scopeYesterday($q)
    {
        return $q->whereDate('created_at', today()->subDay());
    }

    public function scopeThisWeek($q)
    {
        return $q->where('created_at', '>=', now()->startOfWeek());
    }

    public function scopeThisMonth($q)
    {
        return $q->where('created_at', '>=', now()->startOfMonth());
    }

    public function scopeLast30Days($q)
    {
        return $q->where('created_at', '>=', now()->subDays(30));
    }

    public function scopePeriod($q, string $from, string $to)
    {
        return $q->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
    }
}
