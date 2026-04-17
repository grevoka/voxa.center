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
        'source',
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
        return preg_replace('/^www\./i', '', $host);
    }

    /**
     * Detect the traffic source from a referrer host.
     */
    public static function detectSource(?string $referrerHost): string
    {
        if (!$referrerHost) {
            return 'direct';
        }

        // Search engines
        $searchEngines = [
            'google.com', 'google.fr', 'google.de', 'google.es', 'google.co.uk', 'google.it', 'google.pl', 'google.ca', 'google.be', 'google.ch',
            'bing.com',
            'yahoo.com', 'search.yahoo.com',
            'duckduckgo.com',
            'baidu.com',
            'yandex.ru', 'yandex.com',
            'ecosia.org',
            'qwant.com',
            'startpage.com',
            'brave.com', 'search.brave.com',
            'perplexity.ai',
        ];

        foreach ($searchEngines as $engine) {
            if ($referrerHost === $engine || str_ends_with($referrerHost, '.' . $engine)) {
                return 'search';
            }
        }

        // Social networks
        $socialNetworks = [
            'facebook.com', 'l.facebook.com', 'lm.facebook.com', 'm.facebook.com',
            'instagram.com', 'l.instagram.com',
            'twitter.com', 'x.com', 't.co',
            'linkedin.com', 'lnkd.in',
            'reddit.com', 'old.reddit.com',
            'youtube.com', 'm.youtube.com',
            'tiktok.com',
            'pinterest.com', 'pin.it',
            'threads.net',
            'mastodon.social',
            'bsky.app',
            'discord.com',
            'telegram.org', 't.me',
            'whatsapp.com',
        ];

        foreach ($socialNetworks as $social) {
            if ($referrerHost === $social || str_ends_with($referrerHost, '.' . $social)) {
                return 'social';
            }
        }

        return 'referral';
    }

    /**
     * Get a clean display name for known referrer hosts.
     */
    public static function cleanReferrerName(?string $host): ?string
    {
        if (!$host) return null;

        $names = [
            'google.com' => 'Google', 'google.fr' => 'Google', 'google.de' => 'Google', 'google.es' => 'Google', 'google.co.uk' => 'Google', 'google.it' => 'Google', 'google.pl' => 'Google', 'google.ca' => 'Google', 'google.be' => 'Google', 'google.ch' => 'Google',
            'bing.com' => 'Bing',
            'yahoo.com' => 'Yahoo', 'search.yahoo.com' => 'Yahoo',
            'duckduckgo.com' => 'DuckDuckGo',
            'baidu.com' => 'Baidu',
            'yandex.ru' => 'Yandex', 'yandex.com' => 'Yandex',
            'ecosia.org' => 'Ecosia',
            'qwant.com' => 'Qwant',
            'startpage.com' => 'Startpage',
            'search.brave.com' => 'Brave Search', 'brave.com' => 'Brave Search',
            'perplexity.ai' => 'Perplexity',
            'facebook.com' => 'Facebook', 'l.facebook.com' => 'Facebook', 'lm.facebook.com' => 'Facebook', 'm.facebook.com' => 'Facebook',
            'instagram.com' => 'Instagram', 'l.instagram.com' => 'Instagram',
            'twitter.com' => 'X (Twitter)', 'x.com' => 'X (Twitter)', 't.co' => 'X (Twitter)',
            'linkedin.com' => 'LinkedIn', 'lnkd.in' => 'LinkedIn',
            'reddit.com' => 'Reddit', 'old.reddit.com' => 'Reddit',
            'youtube.com' => 'YouTube', 'm.youtube.com' => 'YouTube',
            'tiktok.com' => 'TikTok',
            'pinterest.com' => 'Pinterest', 'pin.it' => 'Pinterest',
            'threads.net' => 'Threads',
            'bsky.app' => 'Bluesky',
            'discord.com' => 'Discord',
            't.me' => 'Telegram',
            'github.com' => 'GitHub',
        ];

        return $names[$host] ?? $host;
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
