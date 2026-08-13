<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="referrer" content="no-referrer-when-downgrade" />
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">

<title>
  {{ filled($title ?? null) ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
</title>

<title>{{ $title ?? config('app.name') }}</title>
<link rel="icon" href="{{ asset('images/Logo-ITK.webp') }}">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
