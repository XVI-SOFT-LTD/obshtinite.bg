<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">

<head>
    @include('layouts.partials._head')
</head>

<body id="top">
    @include('layouts.partials._header')

    @include('layouts.partials._before_header')

    @include('layouts.partials._below_header')

    @include('layouts.partials._before_footer')

    @include('layouts.partials._footer')

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
    @stack('scripts')
</body>

</html>
