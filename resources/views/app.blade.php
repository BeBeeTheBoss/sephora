<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="https://iconape.com/wp-content/png_logo_vector/shopping-and-ecommerce-28.png"
        type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <title inertia>{{ config('app.name', 'Sephora') }}</title> --}}
    <title>Sephora</title>

    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
