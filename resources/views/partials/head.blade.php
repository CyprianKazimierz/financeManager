<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? 'Finance Manager' }}</title>

<link rel="icon" type="image/png" href="{{ asset('storage/logo.png') }}">

@vite(['resources/css/app.css', 'resources/js/app.ts'])
@fluxAppearance
