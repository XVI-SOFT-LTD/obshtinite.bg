@include('layouts.partials._head')
<!DOCTYPE html>
<html lang="en">

<body class="bg-gray-100">
    @include('layouts.partials._header')

    <div class="flex items-center justify-start gap-10 headline">
        <h1 class="uppercase font-light text-black bg-white px-10 py-6 white-button-bg-gradient">
            <a href="{{ url('/') }}" class="text-black">{{ trans('app.homepage') }}</a> /
            {{ $page->i18n->title }}
        </h1>
    </div>
    <main class="container mx-auto px-4 mt-10">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main content area -->
            <div class="lg:col-span-3">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="mb-4">
                        <h1 class="text-2xl font-semibold text-gray-800">{!! $page->i18n->title !!}</h1>
                    </div>
                    <div class="text-base text-gray-600 leading-relaxed">
                        {!! str_replace(
                            ['<p>', '<ol>', '<li>', '<ul>', '</p>', '</ol>', '</ul>'],
                            [
                                '<p class="mb-4 text-gray-800 leading-normal">',
                                '<ol class="list-decimal ml-6 mb-4">',
                                '<li class="mb-2">',
                                '<ul class="list-disc ml-6 mb-4">',
                                '</p>',
                                '</ol>',
                                '</ul>',
                            ],
                            $page->i18n->description,
                        ) !!}
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.partials._footer')

    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="{{ config('app.paths.js') }}/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/90bafb394a.js" crossorigin="anonymous"></script>
</body>

</html>
