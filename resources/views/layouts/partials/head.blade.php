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

{{-- <link rel="icon" href="/favicon.ico" sizes="any"> --}}
{{-- <link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png"> --}}
<link rel="icon" href="{{ asset('logo/sim-ami.png') }}" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('logo/sim-ami.png') }}">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
