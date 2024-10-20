@include('layouts.partials._before_header')
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
<header class="flex flex-col overflow-x-hidden">
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
    <div class="flex items-center justify-between px-5 py-3 headline">
        <h1 class="uppercase font-light text-black">Информационен блог</h1>
        <button class="h-full">Виж Всички</button>
    </div>
</header>

<script src="https://cdn.tailwindcss.com"></script>
<script type="module" src="{{ config('app.paths.js') }}/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://kit.fontawesome.com/90bafb394a.js" crossorigin="anonymous"></script>
