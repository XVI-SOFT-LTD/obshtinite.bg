{{-- @include('layouts.partials._before_header') --}}
<!-- header -->
{{-- <header>
        <div class="main_wrapper w100 flex_between">
            <div class="logo">
                <a href="{{ asset('/') }}">
                    Общините в България
                </a>
            </div> <!-- ./ Logo -->

            <nav class="desktop-nav">
                <span class="mobile_button_nav display_none"><i class="fa fa-bars" aria-hidden="true"></i></span>

                <ul class="flex">
                    <li><a href="{{ asset('/') }}">{{ trans('app.homepage') }}</a></li>
                    @if (session('locale') != 'en')
                        <li><a href="{{ asset('news') }}">{{ trans('app.news') }}</a></li>
                    @endif
                    <li><a href="{{ asset('areas') }}">{{ trans('app.areas') }}</a></li>
                    <li><a href="{{ asset('parliamentary-groups') }}">{{ trans('app.parties') }}</a></li>
                    <li><a href="{{ asset('landmarks') }}">{{ trans('app.landmarks') }}</a></li>
                </ul>
                <div class="search"><span class="icon-search"></span></div>
                <div class="lang_switcher">
                    @if (config('app.locale') == 'bg')
                        <a href="{{ asset('lang/en') }}">EN</a>
                    @else
                        <a href="{{ asset('lang/bg') }}">BG</a>
                    @endif
                </div>
            </nav> <!-- ./ Nav -->

            <ul class="flex mobile_menu">
                <li><a href="{{ asset('/') }}">{{ trans('app.homepage') }}</a></li>
                @if (session('locale') != 'en')
                    <li><a href="{{ asset('news') }}">{{ trans('app.news') }}</a></li>
                @endif
                <li><a href="{{ asset('areas') }}">{{ trans('app.areas') }}</a></li>
                <li><a href="{{ asset('parliamentary-groups') }}">{{ trans('app.parties') }}</a></li>
                <li><a href="{{ asset('landmarks') }}">{{ trans('app.landmarks') }}</a></li>
            </ul> <!-- ./ Mobile Nav -->

            <div class="search_form">
                {!! Form::open(['url' => 'search', 'method' => 'POST']) !!}
                {{ Form::text('words', null, ['placeholder' => trans('app.searchValue')]) }}
                {{ Form::button('<i class="fa fa-search" aria-hidden="true"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
                {!! Form::close() !!}
            </div> <!-- ./ Search Form -->
        </div>
    </header> --}}

{{-- <header class="flex flex-col overflow-x-hidden">
    <div class="flex justify-between items-center shadow-xl ">
        <div class="px-10 p-2 lg:p-5 logo">
            <a href="{{ url('/') }}" class="text-lg lg:text-2xl text-green">
                <h1>Общините в България</h1>
            </a>
        </div><!-- ./ Logo -->

        <nav class="desktop-nav">
            <span class="mobile_button_nav display_none"><i class="fa fa-bars" aria-hidden="true"></i></span>

            <ul id="navbarlinks-wrapper" class="hidden lg:flex justify-center items-center gap-5 px-10 p-5 xl:-ml-56">
            </ul>

            <div class="search"><span class="icon-search"></span></div>
            <div class="lang_switcher">

                @if (config('app.locale') == 'bg')
                    <a href="{{ route('lang.switch', 'en') }}" class="h-full text-sm">EN</a>
                @else
                    <a href="{{ route('lang.switch', 'bg') }}" class="h-full text-sm">BG</a>
                @endif
            </div>
        </nav> <!-- ./ Nav -->

        <ul id="mobile-navbarlinks-wrapper" class="flex mobile_menu">
        </ul> <!-- ./ Mobile Nav -->

        <div class="search_form">
            {!! Form::open(['url' => 'search', 'method' => 'POST']) !!}
            {{ Form::text('words', null, ['placeholder' => trans('app.searchValue')]) }}
            {{ Form::button('<i class="fa fa-search" aria-hidden="true"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
            {!! Form::close() !!}
        </div> <!-- ./ Search Form -->
    </div>
</header> --}}

{{-- <body> --}}
<header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center p-5">
        <div class="logo">
            <a href="{{ url('/') }}" class="text-lg lg:text-2xl text-green font-bold">
                {{ trans('app.logo') }}
            </a>
        </div>

        <nav class="hidden lg:flex justify-center items-center gap-5">
            <ul id="navbarlinks-wrapper" class="flex space-x-6 text-gray-700">
                <!-- Add your nav links here -->
            </ul>
        </nav>

        <div class="flex items-center gap-4">
            <div class="lang_switcher">
                @if (config('app.locale') == 'bg')
                    <a href="{{ route('lang.switch', 'en') }}" class="text-sm text-gray-700">EN</a>
                @else
                    <a href="{{ route('lang.switch', 'bg') }}" class="text-sm text-gray-700">BG</a>
                @endif
            </div>
            <div class="search relative">
                <span class="icon-search cursor-pointer"><i class="fa fa-search text-gray-700"
                        aria-hidden="true"></i></span>
                <div
                    class="hidden absolute right-0 top-full mt-2 bg-white border border-gray-300 p-2 rounded shadow-lg z-50">
                    {!! Form::open(['url' => 'search', 'method' => 'POST', 'class' => 'flex items-center']) !!}
                    {{ Form::text('words', null, ['placeholder' => trans('app.searchValue'), 'class' => 'border p-2 rounded']) }}
                    {{ Form::button('<i class="fa fa-search" aria-hidden="true"></i>', ['class' => 'btn btn-primary ml-2', 'type' => 'submit']) }}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="lg:hidden">
                <span class="mobile_button_nav"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>

    <!-- Mobile Nav -->
    <ul id="mobile-navbarlinks-wrapper" class="flex flex-col lg:hidden space-y-2 p-5 text-gray-700">
        <!-- Add your mobile nav links here -->
    </ul>
</header>
<script>
    var swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    var swiper = new Swiper(".mySwiperTwo", {
        spaceBetween: 30,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    var swiper = new Swiper(".mySwiperThree", {
        spaceBetween: 30,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
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
                slidesPerView: 5,
                spaceBetween: 30,
            },
        },
    });
</script>
{{-- </body> --}}

{{-- <div class="grid gird-cols-1 lg:grid-cols-3">
        <div class="flex justify-center items-center p-5">
            <img alt="bg" src="{{ asset('theme/images/logo.png') }}" class="mx-auto" />
        </div>
        <div class="swiper mySwiper lg:col-span-2 max-h-[40vh]">
            <div class="swiper-wrapper" id="swiper-wrapper-header"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <div class="flex items-center justify-between px-5 py-3 headline">
        <h1 class="uppercase font-light text-black">Информационен блог</h1>
        <button class="h-full">Виж Всички</button>
    </div> --}}

{{-- <script src="https://cdn.tailwindcss.com"></script>
<script type="module" src="{{ config('app.paths.js') }}/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://kit.fontawesome.com/90bafb394a.js" crossorigin="anonymous"></script> --}}
