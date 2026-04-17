<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', __('meta.default_title'))</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
@php
$hreflangRoute = Route::currentRouteName();
if ($hreflangRoute && str_starts_with($hreflangRoute, 'l.')) {
    $hreflangRoute = substr($hreflangRoute, 2);
}
$frontendRoutes = ['home','contact.submit','fonctionnalites','tarifs','contact','scenarios','softphone','click-to-call','click-to-call.usecases','legal.cgu','legal.cgv','legal.confidentialite'];
$showHreflang = $hreflangRoute && in_array($hreflangRoute, $frontendRoutes);
@endphp
@if($showHreflang)
@php $baseUrl = route($hreflangRoute); @endphp
<link rel="alternate" hreflang="fr" href="{{ $baseUrl }}">
<link rel="alternate" hreflang="en" href="{{ preg_replace('#^(https?://[^/]+)#', '$1/en', $baseUrl) }}">
<link rel="alternate" hreflang="es" href="{{ preg_replace('#^(https?://[^/]+)#', '$1/es', $baseUrl) }}">
<link rel="alternate" hreflang="de" href="{{ preg_replace('#^(https?://[^/]+)#', '$1/de', $baseUrl) }}">
<link rel="alternate" hreflang="pl" href="{{ preg_replace('#^(https?://[^/]+)#', '$1/pl', $baseUrl) }}">
<link rel="alternate" hreflang="x-default" href="{{ $baseUrl }}">
@endif
@stack('styles')
</head>
<body>
@include('partials.navbar')
@yield('content')

@include('partials.footer')
@include('partials.cookie-banner')
@include('partials.visit-tracker')

@stack('scripts')
</body>
</html>
