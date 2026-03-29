<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title.' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
</title>

<meta name="description" content="Plataforma de registro deportivo para Fundación Deportiva San Sebastían">
<meta name="theme-color" content="#0056b3">

<meta property="og:title" content="FUNDESSE">
<meta property="og:description" content="Plataforma de registro deportivo para Fundación Deportiva San Sebastían">
<meta property="og:image" content="{{ asset('favicons/favicon-128x128.png') }}">

{{-- Favicon y PWA --}}
<link rel="manifest" href="{{ asset('manifest.json') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
<link rel="apple-touch-icon" href="{{ asset('favicons/favicon-128x128.png') }}">

<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
