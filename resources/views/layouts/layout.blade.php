<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ config('app.paths.css') }}/output.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/9ce6b7b7c4.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- navbar -->
    <nav class="relative w-full flex-between p-6 px-10">
        <h1 class="text-xl text-mainColor z-10">Общините в България</h1>
        <ul class="hidden lg:flex lg:items-center gap-10 text-lg z-10">
            <li><a href="#">Начало</a></li>
            <li><a href="#">Области</a></li>
            <li><a href="#">Новини</a></li>
            <li><a href="#">Партии</a></li>
            <li><a href="#">Забележителности</a></li>
        </ul>

        <img src="{{ config('app.paths.img') }}/icons/search-icon.png" class="z-10" />

        <img src="{{ config('app.paths.img') }}/navbar.png" class="h-[100px] absolute right-0 top-0 z-[]" />
        <img src="{{ config('app.paths.img') }}/navbar-r.png" class="w-full h-[100px] absolute left-0 top-0 z-[2]" />
    </nav>
    <!-- navbar -->

    <!-- header -->
    <header class="grid-4 lg:gap-x-10">
        <div class="w-full p-10">
            <img src="{{ config('app.paths.img') }}/bg.png" class="w-full mx-auto" alt="logo" />
        </div>
        <div class="col-span-2">
            <div class="swiper headerSwiper max-h-[44vh]">
                <div class="swiper-wrapper">
                    <div class="swiper-slide relative">
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                            <h1 class="text-white text-5xl">Амфи Театър</h1>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Roman_Theatre_Plovdiv.jpg" class="" alt="image" />
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </header>
    <!-- header -->

    <!-- information blog -->
    <div class="relative">
        <div class="z-10 flex-between p-5">
            <h1 class="uppercase z-10">Информационен блог</h1>
            <button class="z-10">Виж Повече</button>
        </div>

        <img src="{{ config('app.paths.img') }}/info-blog.png" class="absolute h-[60px] w-full z-1 top-0" />
    </div>
    <!-- information blog -->

    <section class="grid-3 gap-10 p-5 lg:p-10">
        <!-- 3 grid cards -->
        <div class="grid-3 gap-5 lg:col-span-2">
            <!-- card -->
            <div class="flex flex-col lg:flex-row gap-3 w-full bg-[#E9E9E9] group hover:bg-[#383838] transition-all">
                <img class="w-full lg:w-[150px] h-auto object-cover" src="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
                    alt="Sample Title" />
                <div class="flex flex-col gap-1 py-2 px-2 lg:px-0">
                    <p class="font-light group-hover:text-white">2023-10-30</p>
                    <h1 class="font-bold text-lg group-hover:text-white">
                        Sample Title
                    </h1>
                    <p class="text-sm max-w-[350px] group-hover:text-white">
                        This is a sample description text to demonstrate the static
                        layout...
                    </p>
                    <a href="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D" target="_blank" class="view">Read More</a>
                    <!-- Optionally include button if needed -->
                    <!-- <button class="w-max text-sm text-red group-hover:text-white">Read More</button> -->
                </div>
            </div>
            <!-- card -->
            <!-- card -->
            <div class="flex flex-col lg:flex-row gap-3 w-full bg-[#E9E9E9] group hover:bg-[#383838] transition-all">
                <img class="w-full lg:w-[150px] h-auto object-cover" src="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
                    alt="Sample Title" />
                <div class="flex flex-col gap-1 py-2 px-2 lg:px-0">
                    <p class="font-light group-hover:text-white">2023-10-30</p>
                    <h1 class="font-bold text-lg group-hover:text-white">
                        Sample Title
                    </h1>
                    <p class="text-sm max-w-[350px] group-hover:text-white">
                        This is a sample description text to demonstrate the static
                        layout...
                    </p>
                    <a href="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D" target="_blank" class="view">Read More</a>
                    <!-- Optionally include button if needed -->
                    <!-- <button class="w-max text-sm text-red group-hover:text-white">Read More</button> -->
                </div>
            </div>
            <!-- card -->
            <!-- card -->
            <div class="flex flex-col lg:flex-row gap-3 w-full bg-[#E9E9E9] group hover:bg-[#383838] transition-all">
                <img class="w-full lg:w-[150px] h-auto object-cover" src="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
                    alt="Sample Title" />
                <div class="flex flex-col gap-1 py-2 px-2 lg:px-0">
                    <p class="font-light group-hover:text-white">2023-10-30</p>
                    <h1 class="font-bold text-lg group-hover:text-white">
                        Sample Title
                    </h1>
                    <p class="text-sm max-w-[350px] group-hover:text-white">
                        This is a sample description text to demonstrate the static
                        layout...
                    </p>
                    <a href="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D" target="_blank" class="view">Read More</a>
                    <!-- Optionally include button if needed -->
                    <!-- <button class="w-max text-sm text-red group-hover:text-white">Read More</button> -->
                </div>
            </div>
            <!-- card -->
            <!-- card -->
            <div class="flex flex-col lg:flex-row gap-3 w-full bg-[#E9E9E9] group hover:bg-[#383838] transition-all">
                <img class="w-full lg:w-[150px] h-auto object-cover" src="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
                    alt="Sample Title" />
                <div class="flex flex-col gap-1 py-2 px-2 lg:px-0">
                    <p class="font-light group-hover:text-white">2023-10-30</p>
                    <h1 class="font-bold text-lg group-hover:text-white">
                        Sample Title
                    </h1>
                    <p class="text-sm max-w-[350px] group-hover:text-white">
                        This is a sample description text to demonstrate the static
                        layout...
                    </p>
                    <a href="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D" target="_blank" class="view">Read More</a>
                    <!-- Optionally include button if needed -->
                    <!-- <button class="w-max text-sm text-red group-hover:text-white">Read More</button> -->
                </div>
            </div>
            <!-- card -->
            <!-- card -->
            <div class="flex flex-col lg:flex-row gap-3 w-full bg-[#E9E9E9] group hover:bg-[#383838] transition-all">
                <img class="w-full lg:w-[150px] h-auto object-cover" src="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
                    alt="Sample Title" />
                <div class="flex flex-col gap-1 py-2 px-2 lg:px-0">
                    <p class="font-light group-hover:text-white">2023-10-30</p>
                    <h1 class="font-bold text-lg group-hover:text-white">
                        Sample Title
                    </h1>
                    <p class="text-sm max-w-[350px] group-hover:text-white">
                        This is a sample description text to demonstrate the static
                        layout...
                    </p>
                    <a href="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D" target="_blank" class="view">Read More</a>
                    <!-- Optionally include button if needed -->
                    <!-- <button class="w-max text-sm text-red group-hover:text-white">Read More</button> -->
                </div>
            </div>
            <!-- card -->
            <!-- card -->
            <div class="flex flex-col lg:flex-row gap-3 w-full bg-[#E9E9E9] group hover:bg-[#383838] transition-all">
                <img class="w-full lg:w-[150px] h-auto object-cover" src="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D"
                    alt="Sample Title" />
                <div class="flex flex-col gap-1 py-2 px-2 lg:px-0">
                    <p class="font-light group-hover:text-white">2023-10-30</p>
                    <h1 class="font-bold text-lg group-hover:text-white">
                        Sample Title
                    </h1>
                    <p class="text-sm max-w-[350px] group-hover:text-white">
                        This is a sample description text to demonstrate the static
                        layout...
                    </p>
                    <a href="https://plus.unsplash.com/premium_photo-1664474619075-644dd191935f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aW1hZ2V8ZW58MHx8MHx8fDA%3D" target="_blank" class="view">Read More</a>
                    <!-- Optionally include button if needed -->
                    <!-- <button class="w-max text-sm text-red group-hover:text-white">Read More</button> -->
                </div>
            </div>
            <!-- card -->
        </div>
        <!-- 3 grid cards -->

        <div class="flex-col-5 col-span-1">
            <!-- swiper-two -->
            <div class="swiper swiperTwo max-h-[30vh] lg:max-h-[20vh]">
                <div class="swiper-wrapper">
                    <div class="swiper-slide relative">
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                            <h1 class="text-white text-5xl">Амфи Театър</h1>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Roman_Theatre_Plovdiv.jpg" class="" alt="image" />
                    </div>
                    <div class="swiper-slide relative">
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                            <h1 class="text-white text-5xl">Амфи Театър</h1>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Roman_Theatre_Plovdiv.jpg" class="" alt="image" />
                    </div>
                    <div class="swiper-slide relative">
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                            <h1 class="text-white text-5xl">Амфи Театър</h1>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Roman_Theatre_Plovdiv.jpg" class="" alt="image" />
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <!-- swiper two -->

            <!-- swiper three -->
            <div class="swiper swiperTwo max-h-[30vh] lg:max-h-[20vh]">
                <div class="swiper-wrapper">
                    <div class="swiper-slide relative">
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                            <h1 class="text-white text-5xl">Амфи Театър</h1>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Roman_Theatre_Plovdiv.jpg" class="" alt="image" />
                    </div>
                    <div class="swiper-slide relative">
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                            <h1 class="text-white text-5xl">Амфи Театър</h1>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Roman_Theatre_Plovdiv.jpg" class="" alt="image" />
                    </div>
                    <div class="swiper-slide relative">
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                            <h1 class="text-white text-5xl">Амфи Театър</h1>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Roman_Theatre_Plovdiv.jpg" class="" alt="image" />
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <!-- swiper three -->
        </div>
    </section>

    <!-- section -->
    <section class="grid-4 gap-10">
        <div class="flex-col-5 lg:col-span-3">
            <div class="relative text-white">
                <div class="z-10 flex-between p-5">
                    <h1 class="uppercase z-10">Общини</h1>
                    <button class="z-10">Виж Повече</button>
                </div>

                <img src="{{ config('app.paths.img') }}/green.png" class="absolute h-[65px] w-full z-1 top-0" />
            </div>

            <!-- swiper-1 -->
            <div class="swiper firstLongSwiper p-5">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="swiper-slide flex flex-col gap-3 group hover:bg-[#6d7b40] p-3 transition-all hover:shadow-lg">
                            <img src="https://via.placeholder.com/200" class="h-[100px] object-cover" alt="Municipality Logo" />
                            <div class="flex flex-col gap-2 text-start px-2">
                                <h1 class="font-bold group-hover:text-white">
                                    Sample Municipality Name
                                </h1>
                                <p class="text-sm group-hover:text-white">
                                    This is a sample description text limited to about 50
                                    characters...
                                </p>
                                <a href="https://example.com/municipality/sample" class="w-max text-sm text-red group-hover:text-white">
                                    See More <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- swiper-1 -->

            <div class="relative text-white">
                <div class="z-10 flex-between p-5">
                    <h1 class="uppercase z-10">Партии</h1>
                    <button class="z-10">Виж Повече</button>
                </div>

                <img src="{{ config('app.paths.img') }}/red.png" class="absolute h-[65px] w-full z-1 top-0" />
            </div>

            <!-- swiper-2 -->
            <div class="swiper secondLongSwiper p-5">
                <div class="swiper-wrapper">
                    <div class="swiper-slide group transition-all w-full hover:bg-[#8b2c3e]">
                        <div class="flex flex-col gap-3 p-3">
                            <img src="https://via.placeholder.com/150" class="w-full h-[10px] object-cover" alt="Parliamentary Group Logo" />
                            <div class="flex flex-col gap-2 text-start px-2">
                                <h1 class="font-bold group-hover:text-white">
                                    Sample Parliamentary Group
                                </h1>
                                <p class="text-sm group-hover:text-white">
                                    This is a sample description limited to 50 characters...
                                </p>
                            </div>
                        </div>
                        <a href="https://example.com/parliamentary-group"
                            class="transition-all text-sm text-red group-hover:text-white w-full group-hover:p-2 group-hover:flex group-hover:items-center group-hover:justify-between group-hover:shadow-inner">
                            <span>See More</span> <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- swiper-2 -->


            <!-- third row -->
            <div class="flex-col-5">
                <div>
                    <div class="relative">
                        <div class="z-10 flex-between p-5">
                            <h1 class="uppercase z-10">Забележителности</h1>
                            <span class="text-sm z-10">Бизнес и администрация | Транспорт | Мероприятия | Образование | Заведения | Магазини | Хотели | Здраве и класота</с>
                        </div>

                        <img src="{{ config('app.paths.img') }}/white.png" class="absolute h-[65px] w-full z-1 top-0" />
                    </div>
                    <div class="relative text-white">
                        <div class="z-10 flex-between p-5">
                            <h1 class="uppercase z-10">Партии</h1>
                            <button class="z-10">Виж Повече</button>
                        </div>

                        <img src="{{ config('app.paths.img') }}/green.png" class="absolute h-[65px] w-full z-1 top-0" />
                    </div>
                </div>

                <!-- swiper-3 -->
                <div class="swiper thirdLongSwiper p-5">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide group transition-all w-full hover:shadow-xl">
                            <div class="flex flex-col gap-3 p-3">
                                <img src="https://via.placeholder.com/150" class="w-full h-[10px] object-cover" alt="Parliamentary Group Logo" />
                                <div class="flex flex-col gap-2 text-start px-2">
                                    <h1 class="font-bold">
                                        Sample Parliamentary Group
                                    </h1>
                                    <p class="text-sm">
                                        This is a sample description limited to 50 characters...
                                    </p>
                                </div>
                            </div>
                            <a href="https://example.com/parliamentary-group"
                                class="group-hover:bg-[#333333] transition-all text-sm text-red group-hover:text-white w-full group-hover:p-2 group-hover:flex group-hover:items-center group-hover:justify-between group-hover:shadow-inner">
                                <span>See More</span>
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <!-- swiper-3 -->
            </div>
            <!-- third row -->
        </div>

        <div class="flex-col-5">
            <div class="bg-mainColor gap-5 flex-start px-5 h-[65px]">
                <h1 class="text-white text-xl">Полезно</h1>
            </div>
            <div class="flex-col-3 p-5">
                <div class="bg-mainColor hover:bg-mainColorRed">
                    <h1 class="text-white p-3 text-xl uppercase">Пловдив</h1>
                    <img src="https://i.guim.co.uk/img/media/1e6a94ecca5c1df6696f6673fe657e5d16819933/366_620_5634_3380/master/5634.jpg?width=1200&height=900&quality=85&auto=format&fit=crop&s=d96490ba4a9347f06e67022d68410995" class="w-full" />
                </div>
            </div>
        </div>


    </section>
    <!-- section -->

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ config('app.paths.js') }}Swiper.js"></script>
</body>

</html>
