@props(['pageTitle'])
@props(['pageDescription'])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@php echo $pageTitle @endphp</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

@include('layouts.header')

<div class="mx-auto max-w-7xl px-6 lg:px-8" style="margin-bottom:  3rem">
    <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl">
        @php echo $pageTitle @endphp
    </h1>
    @isset($pageDescription)
        <h3 content="text-5xl font-bold text-gray-900 sm:text-4xl">@php echo $pageDescription; @endphp</h3>
    @endisset

    @include('components.message')

</div>


{{ $slot }}


</body>
</html>
