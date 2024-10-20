@include('layouts.partials._head')
<!DOCTYPE html>
<html lang="en">

<body>
    @include('layouts.partials._before_header')
    {{-- @include('layouts.partials._header') --}}

    <!-- header -->
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
            <h1 class="uppercase font-light text-black bg-white px-10 py-6 white-button-bg-gradient">Oбласт
                {{ $area->i18n->name }}</h1>
            <button class="h-full text-sm">Начало | {{ $area->i18n->name }}</button>
        </div>
    </header>
    <!-- header -->

    <!-- green container -->
    <div class="bg-green w-full text-center py-3 mt-1 text-white px-5 lg:px-0">
        <p class="max-w-[1500px] mx-auto">
            @foreach ($area->municipality as $municipality)
                {{ $municipality->i18n->name }} @if (!$loop->last)
                    |
                @endif
            @endforeach
        </p>
    </div>
    <!-- green container -->


    <!-- red container -->
    <div class="bg-red px-5 lg:px-10 py-3">
        <h1 class="text-2xl uppercase text-white">Област {{ $area->i18n->name }}</h1>
    </div>
    <!-- red container -->

    <!-- grid -->
    <div class="flex flex-col gap-5 white-bg-gradient mt-5">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10 px-5">
            <div class="w-full">
                <img class="w-full" src="{{ $area->getLogo() }}" alt="obshtina-{{ $area->slug }}" />
            </div>
            <div class="lg:col-span-2 flex flex-col gap-5">
                <h1 class="text-xl uppercase">{{ $area->i18n->name }}</h1>
                <p>{{ html_entity_decode(strip_tags($area->i18n->description)) }}</p>
            </div>
        </div>
        @if ($area->gallery->count() > 0)
            <div class="swiper mySwiperTwo w-full h-[250px]">
                <div class="swiper-wrapper">
                    @foreach ($area->gallery as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset($image->getImage(445)) }}" alt="Gallery Image" />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        @endif
        <h1 class="text-2xl  p-5">Новините от област {{ $area->i18n->name }}</h1>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 lg:col-span-2 gap-5 p-5" id="blog-wrapper">
        @foreach ($area->news as $item)
            <div class="flex flex-col lg:flex-row gap-3 w-full bg-[#E9E9E9] group hover:bg-[#383838] transition-all"
                key="{{ $loop->index }}">
                <img src="{{ $item->getLogo() }}" alt="{{ $item->i18n->title }}" />
                <div class="flex flex-col gap-1 py-2 px-2 lg:px-0">
                    <p class="font-light group-hover:text-white">
                        {{ \Carbon\Carbon::parse($item->publish_date)->format('Y-m-d') }}</p>
                    <h1 class="font-bold text-lg group-hover:text-white">{{ $item->i18n->title }}</h1>
                    <p class="text-sm max-w-[350px] group-hover:text-white">
                        {{ Str::limit(strip_tags($item->i18n->description), 70, '...') }}</p>
                    <a href="{{ $item->website }}" target="_blank" class="view">{{ trans('app.readMore') }}</a>
                    {{-- <button  class="w-max text-sm text-red group-hover:text-white">trans('app.readMore')</button> --}}
                </div>
            </div>
        @endforeach
    </div>

    <!-- grid -->

    <!-- green container -->
    <div class="flex flex-col gap-3 text-center white-bg-gradient py-3">
        <div class="relative bg-green w-full text-center text-white px-5 lg:px-0">
            <button class="absolute left-0 white-button-bg-gradient text-black h-[100%] px-5">Забележителности</button>
            <p class="max-w-[1500px] mx-auto py-5">
                @foreach ($area->municipality as $municipality)
                    {{ $municipality->i18n->name }} @if (!$loop->last)
                        |
                    @endif
                @endforeach
            </p>
        </div>
        <h1 class="text-sm lg:text-lg">Природни Забележителности | Aрхитектурни забележителности | Музии</h1>
    </div>
    <div class="grid gird-cols-1 lg:grid-cols-2 gap-32">
        <!-- left side -->
        <div class="flex flex-col gap-5 lg:col-span-2">
            <div class="flex flex-col gap-3">

                <div class="swiper mySwiperFour">
                    <div class="swiper-wrapper xl:px-5">
                        @foreach ($area->landmarks as $landmark)
                            <div class="swiper-slide flex flex-col gap-3  group p-3 hover:shadow-xl transition-all">
                                <img src="{{ $landmark->getLogo() }}" class="h-[5px] object-cover">
                                <div class="flex flex-col gap-2 text-start px-2">
                                    <h1 class="font-bold">{{ $landmark->i18n->name }}</h1>
                                    <p class="text-sm">
                                        {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($landmark->i18n->description)), 50) }}
                                    </p>
                                    <button
                                        class="transition-all py-2 px-3 w-max text-sm text-red group-hover:text-white group-hover:w-full group-hover:flex group-hover:justify-between group-hover:items-center group-hover:bg-[#333333]">Виж
                                        още <i class="fa-solid fa-chevron-right"></i></button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- green container -->
    @include('layouts.partials._footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        var swiper = new Swiper(".mySwiperTwo", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                740: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                900: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1550: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                },
            },
        });

        var swiper = new Swiper(".mySwiperFour", {
            slidesPerView: 1,
            spaceBetween: 0,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                740: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                900: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1550: {
                    slidesPerView: 8,
                    spaceBetween: 30,
                },
            },
        });
    </script>

</body>

</html>
