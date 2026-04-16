<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;

class TrackVisit
{
    /**
     * Bots to ignore.
     */
    private const BOT_PATTERNS = [
        'bot', 'crawl', 'spider', 'slurp', 'mediapartners', 'facebookexternalhit',
        'bingpreview', 'lighthouse', 'pingdom', 'uptimerobot', 'curl', 'wget',
        'python', 'go-http', 'java/', 'headlesschrome', 'phantomjs',
    ];

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only track GET requests with successful HTML responses
        if (!$request->isMethod('GET') || $response->getStatusCode() !== 200) {
            return $response;
        }

        // Skip assets, API, admin, espace-client
        $path = $request->path();
        if (preg_match('#^(admin|espace-client|api/|storage/|_debugbar|up)#', $path)) {
            return $response;
        }

        // Skip bots
        $ua = $request->userAgent() ?? '';
        $uaLower = strtolower($ua);
        foreach (self::BOT_PATTERNS as $pattern) {
            if (str_contains($uaLower, $pattern)) {
                return $response;
            }
        }

        // Skip if no user agent (likely a bot)
        if (strlen($ua) < 10) {
            return $response;
        }

        try {
            $sessionId = $request->session()->getId() ?: md5($request->ip() . $ua);
            $parsed = Visit::parseUserAgent($ua);
            $referrer = $request->headers->get('referer');
            $referrerHost = Visit::parseReferrerHost($referrer);

            // Don't count self-referrals
            $siteHost = $request->getHost();
            if ($referrerHost && $referrerHost === $siteHost) {
                $referrerHost = null;
                $referrer = null;
            }

            // Check if this is a bounce (only page in session)
            $sessionPageCount = Visit::where('session_id', $sessionId)
                ->where('created_at', '>=', now()->subMinutes(30))
                ->count();

            // Update previous page's bounce status if this is a second page
            if ($sessionPageCount > 0) {
                Visit::where('session_id', $sessionId)
                    ->where('is_bounce', true)
                    ->where('created_at', '>=', now()->subMinutes(30))
                    ->update(['is_bounce' => false]);
            }

            // Calculate duration from last pageview in session
            $lastVisit = Visit::where('session_id', $sessionId)
                ->where('created_at', '>=', now()->subMinutes(30))
                ->latest('created_at')
                ->first();

            if ($lastVisit) {
                $duration = (int) now()->diffInSeconds($lastVisit->created_at);
                if ($duration > 0 && $duration < 1800) {
                    $lastVisit->update(['duration' => $duration]);
                }
            }

            Visit::create([
                'session_id' => $sessionId,
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'path' => '/' . ltrim($path, '/'),
                'referrer' => $referrer ? substr($referrer, 0, 2048) : null,
                'referrer_host' => $referrerHost,
                'user_agent' => substr($ua, 0, 1024),
                'device' => $parsed['device'],
                'browser' => $parsed['browser'],
                'browser_version' => $parsed['browserVersion'],
                'os' => $parsed['os'],
                'country' => null,
                'is_bounce' => $sessionPageCount === 0,
            ]);
        } catch (\Throwable) {
            // Never break the request for analytics
        }

        return $response;
    }
}
