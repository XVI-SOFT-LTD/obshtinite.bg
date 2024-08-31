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
        <div class="flex items-center justify-between px-5 py-3 headline">
            <div class="flex items-center text-sm gap-1 text-stone-400">
                <a class="text-black">Начало</a>/
                <a class="text-black">Общини</a>/
                <a class="text-stone-400">Община Пловид</a>
            </div>
        </div>
    </header>
    <!-- header -->


    <!-- grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-30 mt-10">
        <!-- left side -->
        <div class="flex flex-col gap-5 lg:col-span-2">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-3 px-5">
                <div class="bg-red-600 w-full">
                    <img alt="obshtina-snimka" src="{{ asset('theme/images/sidenews-2.jpg') }}"
                        class="w-full h-full object-cover" />

                </div>
                <div class="flex flex-col gap-10 lg:col-span-2 px-5">
                    <div class="p-3 uppercase flex-center slanted-border-container shadow-xl w-full">
                        <h1 class="text-center text-lg">Община Пловдив</h1>
                    </div>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-phone"></i>
                            <p>(+359) 87 6342755/ (+359) 87 6342755/</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-map-pin"></i>
                            <p>Пловдив, бул. "Цар Борис 3-ти Обединител</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-envelope"></i>
                            <p>antique teatre@mail.mail</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-globe"></i>
                            <p>www.antique teatre.bg</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-share-nodes"></i>
                            <i class="fa-brands fa-facebook-f"></i>
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                    </div>
                </div>
            </div>


            <!-- multiple pictures swiper component -->
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
            <!-- multiple pictures swiper component -->


            <!-- custom navbar component -->
            <ul class="bg-green hidden lg:flex justify-start gap-20 items-center custom-navbar-component">
                <li class="active">За Фирмата</li>
                <li>Кмества</li>
                <li>Европроекти</li>
                <li>Запитване</li>
            </ul>
            <div class="flex flex-col gap-3 px-5">
                <h1 class="font-bold">Александър Василиевич Суворов е велик руски пълководец, един от основоположниците
                    на руското военно изкуство, княз Италийски (1799), граф Римникски (1789) и на Свещената Римска
                    империя, генералисимус на руските сухопътни и морски</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt temporibus numquam dicta doloribus
                    totam est. Consequatur rem exercitationem vero velit, quae, voluptatibus culpa animi ipsum ipsam
                    aspernatur amet, aut praesentium et. Vero veniam aut totam reiciendis ducimus dolore odit
                    perspiciatis ad aliquid sunt minus, repellat debitis deleniti fugiat unde quidem!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nihil quis dolorem repudiandae atque
                    consequatur, eum delectus illum quae odio numquam maxime distinctio magnam eveniet exercitationem.
                    Officia cum quam, similique illum a sapiente iusto quidem dolores quis assumenda explicabo nisi
                    omnis rem nam provident placeat. Beatae incidunt voluptatem expedita eaque nulla nobis. Accusamus
                    dolorem quasi commodi at alias iure quam eligendi blanditiis doloremque illum recusandae quibusdam
                    voluptatum sint, quisquam veniam animi repellat asperiores nesciunt ab eos sed ipsam repudiandae.
                    Quos iusto dignissimos, qui deleniti numquam officiis obcaecati fuga! Enim illum ratione rerum
                    maxime velit repellat voluptatum consequatur incidunt impedit optio?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut eligendi cum provident corrupti tenetur
                    veritatis blanditiis ea repellat eius quae!</p>
            </div>


            <iframe
                src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d5914.955480934349!2d24.745847623028343!3d42.16146152997191!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sbg!2sbg!4v1721156789591!5m2!1sbg!2sbg"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>


            <div class="flex flex-col gap-3 text-center white-bg-gradient py-3">
                <div class="relative bg-red w-full text-center text-white px-5 lg:px-0">
                    <button
                        class="absolute left-0 white-button-bg-gradient text-black h-[100%] px-5">Забележителности</button>
                    <p class="max-w-[1500px] mx-auto  py-5">Община Айтос | Община Айтос | Община Айтос | Община Айтос |
                        Община Айтос |
                    </p>
                </div>
                <h1 class="lg:text-lg">Природни Забележителности | Aрхитектурни забележителности | Музии</h1>
            </div>

        </div>


        <!-- left side -->


        <!-- right side -->
        <div class="flex flex-col gap-5">
            <div class="flex items-center justify-between px-5 bg-green w-full p-3 text-white uppercase text-xl">
                <h1>Полезно</h1>
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
