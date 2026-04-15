<?php

if (!function_exists('lroute')) {
    /**
     * Generate a localized route URL.
     * French (default) has no prefix, other locales get /en/, /es/, etc.
     */
    function lroute(string $name, array $parameters = [], bool $absolute = true): string
    {
        $url = route($name, $parameters, $absolute);
        $locale = app()->getLocale();

        if ($locale === 'fr') {
            return $url;
        }

        if ($absolute) {
            return preg_replace('#^(https?://[^/]+)#', '$1/' . $locale, $url);
        }

        return '/' . $locale . $url;
    }
}
