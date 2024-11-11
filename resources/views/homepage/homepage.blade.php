@extends('layouts.layout')

@section('content')
    @include('homepage.partials._information_block')

    <section class="grid-4 gap-10">
        <div class="flex-col-5 lg:col-span-3">

            @includeWhen($municipalities->count(), 'homepage.partials._municipality')

            @includeWhen($parties->count(), 'homepage.partials._parties')



            {{-- 
            <!-- third row -->
            <div class="flex-col-5">
                <div>
                    <div class="relative">
                        <div class="z-10 flex-between p-5">
                            <h1 class="uppercase z-10">Забележителности</h1>
                            <span class="text-sm z-10">Бизнес и администрация | Транспорт | Мероприятия | Образование |
                                Заведения | Магазини | Хотели | Здраве и класота</с>
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
         --}}
    </section>
@endsection
