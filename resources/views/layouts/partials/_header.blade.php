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
                    {!! Form::open(['url' => route('search.post'), 'method' => 'POST', 'class' => 'flex items-center']) !!}
                    {{ Form::text('word', null, ['placeholder' => trans('app.searchValue'), 'class' => 'border p-2 rounded']) }}
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