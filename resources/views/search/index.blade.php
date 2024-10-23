@include('layouts.partials._head')

<body class="flex flex-col min-h-screen bg-gray-100">
    @include('layouts.partials._header')

    <main class="container mx-auto mt-10 flex-grow max-w-screen-xl">
        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1 class="text-3xl font-bold">{{ trans('app.search', ['word' => $word]) }}</h1>
            </div>
        </div>

        <!-- News list -->
        @include('search._list', ['models' => $results])
    </main>

    <footer>
        @include('layouts.partials._footer')
    </footer>
</body>
