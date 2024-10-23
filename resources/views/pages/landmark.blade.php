@php
    $longitude = $landmark->longitude;
    $latitude = $landmark->latitude;
@endphp
@include('layouts.partials._head')
<!DOCTYPE html>
<html lang="en">

<body>
    @include('layouts.partials._header')
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
            <h1 class="uppercase font-light text-black bg-white px-10 py-6 white-button-bg-gradient">
                <a href="{{ url('/') }}" class="text-black">{{ trans('app.homepage') }}</a> /
                <a href="{{ url('/listing/landmarks') }}" class="text-black">{{ trans('app.landmarks') }}</a> /
                {{ $landmark->i18n->name }}
            </h1>
        </div>
    </header>
    <!-- header -->

    <!-- grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-30 mt-10">
        <!-- left side -->
        <div class="flex flex-col gap-5 lg:col-span-2">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-3 px-5">
                <div class="bg-red-600 w-full">
                    <img alt="partia-snimka" src="{{ $landmark->getLogo() }}" class="w-full h-full object-cover" />

                </div>
                <div class="flex flex-col gap-10 lg:col-span-2 px-5">
                    <div class="p-3 uppercase flex-center slanted-border-container shadow-xl w-full">
                        <h1 class="text-center text-lg">{{ $landmark->i18n->name }}</h1>
                    </div>
                    <div class="flex flex-col gap-3">

                        <div class="flex items-center gap-2">
                            <strong>{{ trans('app.workTime') }}:</strong>
                            <p>{{ $landmark->working_hours }}</p>
                        </div>

                        <div class="flex items-center gap-2">
                            <strong>{{ trans('app.municipality') }}:</strong>
                            <p>{{ $landmark->municipality->i18n->name }}</p>
                        </div>
                    </div>
                </div>
            </div>


            @if ($landmark->gallery->count() > 0)
                <!-- multiple pictures swiper component -->
                <div class="swiper mySwiperTwo w-full h-[250px]">
                    <div class="swiper-wrapper">
                        @foreach ($landmark->gallery as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset($image->getImage(445)) }}" alt="Gallery Image" />
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <!-- multiple pictures swiper component -->
            @endif


            <!-- custom navbar component -->
            <ul class="bg-green hidden lg:flex justify-start gap-20 items-center custom-navbar-component">
                <li class="active">{{ trans('app.info') }}</li>
            </ul>
            <div class="flex flex-col gap-3 px-5">
                <p>{!! html_entity_decode($landmark->i18n->description) !!}</p>
            </div>

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d5914.955480934349!2d{{ $longitude }}!3d{{ $latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sbg!2sbg!4v1721156789591!5m2!1sbg!2sbg"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- left side -->


        <!-- right side -->
        <div class="flex flex-col gap-5">
            <div class="flex items-center justify-between px-5 bg-green w-full p-3 text-white uppercase text-xl">
                <h1>{{ trans('app.useful') }}</h1>
            </div>

            <div class="2xl:px-14 flex flex-col gap-5">
                <div class="flex flex-col gap-5 px-5 xl:px-5">
                    <div class="group flex flex-col transition-all">
                        <div class="group-hover:bg-red p-2 text-white w-full bg-green">
                            <h1>Пловдив</h1>
                        </div>
                        <img class="h-[200px] object-cover" src="{{ asset('theme/images/box-image.png') }}" />
                    </div>
                </div>
                <div class="flex flex-col gap-5 px-5 xl:px-5">
                    <div class="group flex flex-col transition-all">
                        <div class="group-hover:bg-[#8b2c3e] p-2 text-white w-full bg-green">
                            <h1>Пловдив</h1>
                        </div>
                        <img class="h-[200px] object-cover" src="{{ asset('theme/images/box-image.png') }}" />
                    </div>
                </div>
                <div class="flex flex-col gap-5 px-5 xl:px-5">
                    <div class="group flex flex-col transition-all">
                        <div class="group-hover:bg-[#8b2c3e] p-2 text-white w-full bg-green">
                            <h1>Пловдив</h1>
                        </div>
                        <img class="h-[200px] object-cover" src="{{ asset('theme/images/box-image.png') }}" />
                    </div>
                </div>
                <div class="flex flex-col gap-5 px-5 xl:px-5">
                    <div class="group flex flex-col transition-all">
                        <div class="group-hover:bg-[#8b2c3e] p-2 text-white w-full bg-green">
                            <h1>Пловдив</h1>
                        </div>
                        <img class="h-[200px] object-cover" src="{{ asset('theme/images/box-image.png') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- grid -->

    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="{{ config('app.paths.js') }}/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/90bafb394a.js" crossorigin="anonymous"></script>

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
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
        });
    </script>
</body>

</html>
@include('layouts.partials._footer')
