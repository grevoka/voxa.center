<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;

class TrackVisit
{
    private const BOT_PATTERNS = [
        'bot', 'crawl', 'spider', 'slurp', 'mediapartners', 'facebookexternalhit',
        'bingpreview', 'lighthouse', 'pingdom', 'uptimerobot', 'curl', 'wget',
        'python', 'go-http', 'java/', 'headlesschrome', 'phantomjs',
    ];

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!$request->isMethod('GET') || $response->getStatusCode() !== 200) {
            return $response;
        }

        $path = $request->path();
        if (preg_match('#^(admin|espace-client|api/|storage/|_debugbar|up)#', $path)) {
            return $response;
        }

        $ua = $request->userAgent() ?? '';
        $uaLower = strtolower($ua);
        foreach (self::BOT_PATTERNS as $pattern) {
            if (str_contains($uaLower, $pattern)) {
                return $response;
            }
        }

        if (strlen($ua) < 10) {
            return $response;
        }

        try {
            $sessionId = $request->session()->getId() ?: md5($request->ip() . $ua);
            $parsed = Visit::parseUserAgent($ua);
            $referrer = $request->headers->get('referer');
            $referrerHost = Visit::parseReferrerHost($referrer);

            // Check if self-referral
            $siteHost = $request->getHost();
            $isSelfReferral = $referrerHost && ($referrerHost === $siteHost || str_ends_with($referrerHost, '.' . $siteHost));

            if ($isSelfReferral) {
                $referrerHost = null;
                $referrer = null;
            }

            // For subsequent pages in the same session, inherit the original referrer
            if (!$referrerHost) {
                $firstVisit = Visit::where('session_id', $sessionId)
                    ->where('created_at', '>=', now()->subMinutes(30))
                    ->whereNotNull('referrer_host')
                    ->oldest('created_at')
                    ->first();

                if ($firstVisit) {
                    $referrerHost = $firstVisit->referrer_host;
                    $referrer = $firstVisit->referrer;
                }
            }

            // Detect source category
            $source = Visit::detectSource($referrerHost);

            // Bounce tracking
            $sessionPageCount = Visit::where('session_id', $sessionId)
                ->where('created_at', '>=', now()->subMinutes(30))
                ->count();

            if ($sessionPageCount > 0) {
                Visit::where('session_id', $sessionId)
                    ->where('is_bounce', true)
                    ->where('created_at', '>=', now()->subMinutes(30))
                    ->update(['is_bounce' => false]);
            }

            // Duration from last pageview
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

            // Resolve IP (cached 24h)
            $ip = $request->ip();
            $resolved = Visit::resolveIp($ip);

            Visit::create([
                'session_id' => $sessionId,
                'ip' => $ip,
                'hostname' => $resolved['hostname'],
                'url' => $request->fullUrl(),
                'path' => '/' . ltrim($path, '/'),
                'referrer' => $referrer ? substr($referrer, 0, 2048) : null,
                'referrer_host' => $referrerHost,
                'source' => $source,
                'user_agent' => substr($ua, 0, 1024),
                'device' => $parsed['device'],
                'browser' => $parsed['browser'],
                'browser_version' => $parsed['browserVersion'],
                'os' => $parsed['os'],
                'country' => $resolved['country'],
                'is_bounce' => $sessionPageCount === 0,
            ]);
        } catch (\Throwable) {
            // Never break the request for analytics
        }

        return $response;
    }
}
