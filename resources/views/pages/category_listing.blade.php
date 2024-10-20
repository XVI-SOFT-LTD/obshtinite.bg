@include('layouts.partials._head')
<!DOCTYPE html>
<html lang="bg">


@include('layouts.partials._before_header')
<header class="flex flex-col overflow-x-hidden ">
    <div class="grid gird-cols-1 lg:grid-cols-3">
        <div class="flex justify-center items-center p-5">
            <img alt="bg" src="{{ asset('theme/images/logo.png') }}" class="mx-auto" />
        </div>
        <div class="swiper mySwiper lg:col-span-2 max-h-[40vh]">
            <div class="swiper-wrapper" id="swiper-wrapper-header"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
   <div class="flex items-center justify-start gap-10 headline">
    <h1 class="uppercase font-light text-black bg-white px-10 py-6 white-button-bg-gradient">
        {{ trans('app.' . $categoryName) }}
    </h1>
</div>
</header>

<main class="container mx-auto mt-10">
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach ($models as $model)
            <div class="border rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow p-4">
                <img src="{{ $model->getLogo() }}" alt="{{ $model->i18n->name }}" class="w-full h-48 object-cover">
                <div class="p-3">
                    <h2 class="text-lg font-bold mb-1">{{ $model->i18n->name }}</h2>
                    <p class="text-sm mb-3">
                        {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($model->i18n->description)), 100) }}
                    </p>
                    <a href="{{ route($routeName, $model->slug) }}"
                        class="inline-block bg-blue-600 text-white py-2 px-3 rounded hover:bg-blue-700">Виж още</a>
                </div>
            </div>
        @endforeach
    </section>

    <div class="mt-10 flex justify-center">
        <nav class="block">
            <ul class="flex pl-0 list-none rounded my-2">
                @if ($models->onFirstPage())
                    <li class="disabled"><span
                            class="relative block py-2 px-3 rounded leading-tight text-gray-500 bg-white border border-gray-300 cursor-not-allowed">Назад</span>
                    </li>
                @else
                    <li><a href="{{ $models->previousPageUrl() }}"
                            class="relative block py-2 px-3 rounded leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-200">Назад</a>
                    </li>
                @endif

                @php
                    $start = max(1, $models->currentPage() - 5);
                    $end = min($models->lastPage(), $models->currentPage() + 4);
                @endphp

                @if ($start > 1)
                    <li><a href="{{ $models->url(1) }}"
                            class="relative block py-2 px-3 rounded leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-200">1</a>
                    </li>
                    @if ($start > 2)
                        <li class="disabled"><span
                                class="relative block py-2 px-3 rounded leading-tight text-gray-700 bg-white border border-gray-300">...</span>
                        </li>
                    @endif
                @endif

                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $models->currentPage())
                        <li><span
                                class="relative block py-2 px-3 rounded leading-tight text-white bg-blue-600 border border-gray-300">{{ $i }}</span>
                        </li>
                    @else
                        <li><a href="{{ $models->url($i) }}"
                                class="relative block py-2 px-3 rounded leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-200">{{ $i }}</a>
                        </li>
                    @endif
                @endfor

                @if ($end < $models->lastPage())
                    @if ($end < $models->lastPage() - 1)
                        <li class="disabled"><span
                                class="relative block py-2 px-3 rounded leading-tight text-gray-700 bg-white border border-gray-300">...</span>
                        </li>
                    @endif
                    <li><a href="{{ $models->url($models->lastPage()) }}"
                            class="relative block py-2 px-3 rounded leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-200">{{ $models->lastPage() }}</a>
                    </li>
                @endif

                @if ($models->hasMorePages())
                    <li><a href="{{ $models->nextPageUrl() }}"
                            class="relative block py-2 px-3 rounded leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-200">Напред</a>
                    </li>
                @else
                    <li class="disabled"><span
                            class="relative block py-2 px-3 rounded leading-tight text-gray-500 bg-white border border-gray-300 cursor-not-allowed">Напред</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</main>


@include('layouts.partials._footer')

</html>
