<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'ip',
        'hostname',
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

    /**
     * Resolve IP to hostname and country code.
     * Uses gethostbyaddr for reverse DNS + ip-api.com for geolocation.
     * Results are cached per IP for 24h.
     */
    public static function resolveIp(string $ip): array
    {
        $cacheKey = "ip_resolve_{$ip}";

        return \Illuminate\Support\Facades\Cache::remember($cacheKey, 86400, function () use ($ip) {
            $result = ['hostname' => null, 'country' => null];

            // Reverse DNS
            try {
                $host = gethostbyaddr($ip);
                if ($host && $host !== $ip) {
                    $result['hostname'] = $host;
                }
            } catch (\Throwable) {}

            // GeoIP via ip-api.com (free, no key, 45 req/min)
            try {
                $ctx = stream_context_create(['http' => ['timeout' => 2]]);
                $json = @file_get_contents("http://ip-api.com/json/{$ip}?fields=countryCode", false, $ctx);
                if ($json) {
                    $data = json_decode($json, true);
                    if (!empty($data['countryCode'])) {
                        $result['country'] = strtolower($data['countryCode']);
                    }
                }
            } catch (\Throwable) {}

            return $result;
        });
    }

    /**
     * Convert a 2-letter country code to a flag emoji.
     */
    public static function countryFlag(?string $code): string
    {
        if (!$code || strlen($code) !== 2) {
            return '';
        }
        $code = strtoupper($code);
        $flag = mb_chr(0x1F1E6 + ord($code[0]) - ord('A'))
              . mb_chr(0x1F1E6 + ord($code[1]) - ord('A'));
        return $flag;
    }

    /**
     * Country code to name.
     */
    public static function countryName(?string $code): string
    {
        if (!$code) return '';
        $countries = [
            'fr' => 'France', 'us' => 'United States', 'gb' => 'United Kingdom', 'de' => 'Germany',
            'es' => 'Spain', 'it' => 'Italy', 'nl' => 'Netherlands', 'be' => 'Belgium', 'ch' => 'Switzerland',
            'ca' => 'Canada', 'br' => 'Brazil', 'jp' => 'Japan', 'cn' => 'China', 'in' => 'India',
            'au' => 'Australia', 'ru' => 'Russia', 'pl' => 'Poland', 'pt' => 'Portugal', 'se' => 'Sweden',
            'no' => 'Norway', 'dk' => 'Denmark', 'fi' => 'Finland', 'ie' => 'Ireland', 'at' => 'Austria',
            'mx' => 'Mexico', 'ar' => 'Argentina', 'cl' => 'Chile', 'co' => 'Colombia', 'za' => 'South Africa',
            'kr' => 'South Korea', 'sg' => 'Singapore', 'hk' => 'Hong Kong', 'tw' => 'Taiwan',
            'ma' => 'Morocco', 'tn' => 'Tunisia', 'dz' => 'Algeria', 'sn' => 'Senegal', 'ci' => 'Ivory Coast',
            'ro' => 'Romania', 'cz' => 'Czech Republic', 'hu' => 'Hungary', 'bg' => 'Bulgaria',
            'lu' => 'Luxembourg', 'ua' => 'Ukraine', 'il' => 'Israel', 'ae' => 'UAE', 'tr' => 'Turkey',
        ];
        return $countries[strtolower($code)] ?? strtoupper($code);
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
