<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">

    <head>
        @include('layouts.partials._head')
    </head>

    <body id="top">
        <section class="s-pageheader @isset($homepage) s-pageheader--home @endisset">
            @include('layouts.partials._header')
        </section>

        <section class="s-content {{ isset($customClasses) ? 's-content s-content--narrow s-content--no-padding-bottom' : '' }}">
            @yield('content')
        </section>

        @include('layouts.partials._footer')

        <script src="{{ config('app.paths.js') }}/jquery-3.2.1.min.js"></script>
        <script src="{{ config('app.paths.js') }}/plugins.js"></script>
        <script src="{{ config('app.paths.js') }}/main.js"></script>
        @stack('scripts')
    </body>

</html>
