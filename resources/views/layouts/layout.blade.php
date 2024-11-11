<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ config('app.paths.css') }}/output.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="//cdn.tailwindcss.com"></script>
    <script src="//kit.fontawesome.com/9ce6b7b7c4.js" crossorigin="anonymous"></script>

    @stack('css')
</head>

<body>
    @include('layouts.partials._nav')

    @include('layouts.partials._header_slider')

    @yield('content')

    @include('layouts.partials._footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ config('app.paths.js') }}Swiper.js"></script>
    @stack('scripts')

</body>

</html>
