@include('layouts.partials._head')
<!DOCTYPE html>
<html lang="en">

<body>
    @include('layouts.partials._before_header')

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
            <h1 class="uppercase font-light text-black bg-white px-10 py-6 white-button-bg-gradient">Oбласт Бургас</h1>
            <button class="h-full text-sm">Начало | Област Бургас</button>
        </div>
    </header>
    <!-- header -->

    <!-- green container -->
    <div class="bg-green w-full text-center py-3 mt-1 text-white px-5 lg:px-0">
        <p class="max-w-[1500px] mx-auto">Община Айтос | Община Айтос | Община Айтос | Община Айтос | Община Айтос |
            Община Айтос | Община Айтос |
            Община Айтос | Община Айтос | Община Айтос | Община Айтос | Община Айтос | Община Айтос | Община Айтос |
            Община Айтос | Община Айтос | Община Айтос | Община Айтос </p>
    </div>
    <!-- green container -->

    <!-- red container -->
    <div class="bg-red px-5 lg:px-10 py-3">
        <h1 class="text-2xl uppercase text-white">Област Бургас</h1>
    </div>
    <!-- red container -->

    <!-- grid -->
    <div class="flex flex-col gap-5 white-bg-gradient mt-5">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10 px-5">
            <div class="w-full">
                <img class="w-full" src="https://www.gotoburgas.com/uploads/post/c3a74ae86535188b917e615d751cbfb9.png"
                    alt="obshtina-burgas" />
            </div>
            <div class="lg:col-span-2 flex flex-col gap-5">
                <h1 class="text-xl uppercase">Бургас</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo cupiditate quisquam a at ullam
                    pariatur
                    autem molestiae eos harum libero eligendi, amet exercitationem, mollitia fuga, deserunt doloremque
                    numquam molestias? Sapiente esse molestias corrupti omnis distinctio quibusdam voluptas delectus
                    incidunt? Quibusdam!</p>

                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo cupiditate quisquam a at ullam
                    pariatur
                    autem molestiae eos harum libero eligendi, amet exercitationem, mollitia fuga, deserunt doloremque
                    numquam molestias? Sapiente esse molestias corrupti omnis distinctio quibusdam voluptas delectus
                    incidunt? Quibusdam!</p>
            </div>
        </div>
        <div class="swiper mySwiperTwo w-full h-[250px]">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('theme/images/swiper.png') }}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('theme/images/swiper.png') }}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('theme/images/swiper.png') }}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('theme/images/swiper.png') }}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('theme/images/swiper.png') }}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('theme/images/swiper.png') }}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('theme/images/swiper.png') }}" />
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('theme/images/swiper.png') }}" />
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <h1 class="text-2xl  p-5">Новините от област Бургас</h1>
    </div>

    <!-- grid -->

    <!-- green container -->
    <div class="flex flex-col gap-3 text-center white-bg-gradient py-3">
        <div class="relative bg-green w-full text-center text-white px-5 lg:px-0">
            <button class="absolute left-0 white-button-bg-gradient text-black h-[100%] px-5">Забележителности</button>
            <p class="max-w-[1500px] mx-auto py-5">Община Айтос | Община Айтос | Община Айтос | Община Айтос | Община
                Айтос |
            </p>
        </div>
        <h1 class="text-sm lg:text-lg">Природни Забележителности | Aрхитектурни забележителности | Музии</h1>
    </div>

    <!-- green container -->
    @include('layouts.partials._footer')

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
    </script>

</body>

</html>
