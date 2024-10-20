<!-- cards -->
@php
    // dd($news);
    $text =
        'Lorem ipsum dolor sit amet, morbi lacus posuere volutpat venenatis vitae, ipsum habitasse ante, tristique ante vestibulum nec. Maecenas at, mollis velit metus, dolor mollis justo arcu justo non. Eleifend vestibulum risus mattis lacinia magna, sem sollicitudin nec';
@endphp
<div class="grid gird-cols-1 lg:grid-cols-3">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:col-span-2 gap-5 p-5" id="blog-wrapper">
        @foreach ($popularNews as $item)
            <div class="flex flex-col lg:flex-row gap-3 w-full bg-[#E9E9E9] group hover:bg-[#383838] transition-all"
                key="{{ $loop->index }}">
                <img src="{{ $item->getLogo() }}" alt="{{ $item->i18n->title }}" />
                <div class="flex flex-col gap-1 py-2 px-2 lg:px-0">
                    <p class="font-light group-hover:text-white">{{ \Carbon\Carbon::parse($item->publish_date)->format('Y-m-d') }}</p>
                    <h1 class="font-bold text-lg group-hover:text-white">{{ $item->i18n->title }}</h1>
                    <p class="text-sm max-w-[350px] group-hover:text-white">{{ Str::limit(strip_tags($item->i18n->description), 70, '...') }}</p>
                     <a href="{{ $item->website }}" target="_blank" class="view">{{ trans('app.readMore') }}</a>
                    {{-- <button  class="w-max text-sm text-red group-hover:text-white">trans('app.readMore')</button> --}}
                </div>
            </div>
        @endforeach
    </div>
    <div class="hidden lg:flex flex-col gap-10">
        <div class="swiper mySwiperTwo w-full h-[250px] p-5">
            <div class="swiper-wrapper">
                <div class="swiper-slide relative"><img src="{{ asset('theme/images/swiper-2.jpg') }}" />
                    <div class="flex flex-col gap-5 absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
                        <h1 class="text-white drop-shadow-xl text-3xl bg-[#00000087]">
                            Nesto</h1>
                        <button class="primary-red-fill-btn shadow-lg">Виж</button>
                    </div>
                </div>
                <div class="swiper-slide relative"><img src="{{ asset('theme/images/swiper-3.jpg') }}" />
                    <div class="flex flex-col gap-5 absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
                        <h1 class="text-white drop-shadow-xl text-3xl bg-[#00000087]">
                            Nesto</h1>
                        <button class="primary-red-fill-btn shadow-lg">Виж</button>
                    </div>
                </div>
                <div class="swiper-slide relative"><img src="{{ asset('theme/images/swiper.png') }}" />
                    <div class="flex flex-col gap-5 absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
                        <h1 class="text-white drop-shadow-xl text-3xl bg-[#00000087]">
                            Nesto</h1>
                        <button class="primary-red-fill-btn shadow-lg">Виж</button>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div class="swiper mySwiperThree h-[250px] p-5">
            <div class="swiper-wrapper" id="swiper-wrapper-header">
                <div class="swiper-slide relative"><img src="{{ asset('theme/images/swiper-2.jpg') }}" />
                    <h1
                        class="text-white drop-shadow-xl text-3xl absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
                        Teatur</h1>
                </div>
                <div class="swiper-slide relative"><img src="{{ asset('theme/images/swiper-3.jpg') }}" />
                    <h1
                        class="text-white drop-shadow-xl text-3xl absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
                        Plovdiv</h1>
                </div>
                <div class="swiper-slide relative"><img src="{{ asset('theme/images/swiper.png') }}" />
                    <h1
                        class="text-white drop-shadow-xl text-3xl absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
                        Nesto</h1>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
<!-- cards -->
