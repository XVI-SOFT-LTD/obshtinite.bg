<!-- obshtini -->
<div class="grid gird-cols-1 lg:grid-cols-3 gap-32">
    <!-- left side -->
    <div class="flex flex-col gap-5 lg:col-span-2">
        <div class="flex flex-col gap-3">
            <div class="flex items-center justify-between px-5 bg-green w-full p-3 text-white">
                <h1 class="uppercase text-xl">ОБЩИНИ</h1>
                <button class="uppercase text-lg">Виж всички</button>
            </div>

            <div class="swiper mySwiperFour">
                <div class="swiper-wrapper xl:px-5">
                    <div
                        class="swiper-slide flex flex-col gap-3 group hover:bg-[#6d7b40] p-3 transition-all hover:shadow-lg ">
                        <img src="{{ asset('theme/images/box-image.png') }}" class="h-[200px] object-cover">
                        <div class="flex flex-col gap-2 text-start  px-2">
                            <h1 class="font-bold group-hover:text-white">Герб</h1>
                            <p class="text-sm group-hover:text-white">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</p>
                            <button class="w-max text-sm text-red group-hover:text-white">Виж още <i
                                    class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                    <div
                        class="swiper-slide flex flex-col gap-3 group hover:bg-[#6d7b40] p-3 transition-all hover:shadow-lg ">
                        <img src="{{ asset('theme/images/box-image.png') }}" class="h-[200px] object-cover">
                        <div class="flex flex-col gap-2 text-start  px-2">
                            <h1 class="font-bold group-hover:text-white">Герб</h1>
                            <p class="text-sm group-hover:text-white">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</p>
                            <button class="w-max text-sm text-red group-hover:text-white">Виж още <i
                                    class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="flex flex-col gap-3">
            <div class="flex items-center justify-between px-5 bg-red w-full p-3 text-white">
                <h1 class="uppercase text-xl">ОБЩИНИ</h1>
                <button class="uppercase text-lg">Виж всички</button>
            </div>

            <div class="swiper mySwiperFour">
                <div class="swiper-wrapper xl:px-5">
                    <div class="swiper-slide flex flex-col gap-3 group transition-all hover:bg-[#8b2c3e] p-3">
                        <img src="{{ asset('theme/images/box-image.png') }}" class="h-[200px] object-cover">
                        <div class="flex flex-col gap-2 text-start px-2">
                            <h1 class="font-bold group-hover:text-white">Герб</h1>
                            <p class="text-sm group-hover:text-white">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</p>
                            <button
                                class="w-max text-sm text-red group-hover:text-white group-hover:w-full group-hover:flex group-hover:justify-between group-hover:items-center">Виж
                                още <i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="flex flex-col gap-3">
            <div class="flex items-center justify-between px-5 bg-green w-full p-3 text-white">
                <h1 class="w-full text-center">Природни забележителности | <span class="underline">Архитектурни
                        забележителности</span> | Музи</h1>
                <button class="uppercase w-1/3 flex justify-end">Виж всички</button>
            </div>

            <div class="swiper mySwiperFour">
                <div class="swiper-wrapper xl:px-5">
                    <div class="swiper-slide flex flex-col gap-3  group p-3 hover:shadow-xl transition-all">
                        <img src="{{ asset('theme/images/box-image.png') }}" class="h-[200px] object-cover">
                        <div class="flex flex-col gap-2 text-start px-2">
                            <h1 class="font-bold">Герб</h1>
                            <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <button
                                class="transition-all  py-2 px-3 w-max text-sm text-red group-hover:text-white group-hover:w-full group-hover:flex group-hover:justify-between group-hover:items-center group-hover:bg-[#333333]">Виж
                                още <i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <!-- left side -->


    <!-- right side -->
    <div class="flex flex-col gap-5">
        <div class="flex items-center justify-between px-5 bg-green w-full p-3 text-white uppercase text-xl">
            <h1>Полезно</h1>
        </div>

        <!-- side news -->
        <div class="flex flex-col gap-5 xl:px-5">
            <div class="group flex flex-col transition-all">
                <div class="group-hover:bg-[#8b2c3e] p-2 text-white w-full bg-[#6d7b40]">
                    <h1>Пловдив</h1>
                </div>
                <img src="{{ asset('theme/images/box-image.png') }}" class="h-[200px] object-cover">
            </div>
        </div>
        <div class="flex flex-col gap-5 px-5 xl:px-5">
            <div class="group flex flex-col transition-all">
                <div class="group-hover:bg-[#8b2c3e] p-2 text-white w-full bg-[#6d7b40]">
                    <h1>Пловдив</h1>
                </div>
                <img src="{{ asset('theme/images/box-image.png') }}" class="h-[200px] object-cover">
            </div>
        </div>
        <div class="flex flex-col gap-5 px-5 xl:px-5">
            <div class="group flex flex-col transition-all">
                <div class="group-hover:bg-[#8b2c3e] p-2 text-white w-full bg-[#6d7b40]">
                    <h1>Пловдив</h1>
                </div>
                <img src="{{ asset('theme/images/box-image.png') }}" class="h-[200px] object-cover">
            </div>
        </div>
        <div class="flex flex-col gap-5 px-5 xl:px-5">
            <div class="group flex flex-col transition-all">
                <div class="group-hover:bg-[#8b2c3e] p-2 text-white w-full bg-[#6d7b40]">
                    <h1>Пловдив</h1>
                </div>
                <img src="{{ asset('theme/images/box-image.png') }}" class="h-[200px] object-cover">
            </div>
        </div>
    </div>
</div>
<!-- obshtini -->
{{-- <section class="s-extra">
    <div class="row top">
        <div class="col-eight md-six tab-full popular">
            <h3>Популярни новини</h3>

            <div class="block-1-2 block-m-full popular__posts">
                @foreach ($popularNews as $popular)
                    <article class="col-block popular__post">
                        <a href="{{ $popular->getUrl() }}" class="popular__thumb">
                            <img src="{{ $popular->getLogo(69) }}" alt="{{ $popular->i18n->title }}">
                        </a>
                        <h5><a href="{{ $popular->getUrl() }}">{{ Str::limit(strip_tags($popular->i18n->title), 55) }}</a></h5>
                        <section class="popular__meta">
                            <span class="popular__author">{!! Helper::getNewsAuthorsNames($popular) !!}</span>
                            <span class="popular__date">
                                <span>|</span>
                                <time datetime="{{ date('Y-m-d', strtotime($popular->publish_date)) }}">{{ Helper::formatDateForHuman($popular->publish_date) }}</time>
                            </span>
                        </section>
                    </article>
                @endforeach
            </div>
        </div>

        <div class="col-four md-six tab-full about">
            <h3>За Obshtinite.bg</h3>

            <p>Кратко описание за проета или някакъв друг текст .. може да го махнем този абзац или цялото каре ако мислите, че няма нужда от него :).. </p>

            <ul class="about__social">
                <li>
                    <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                </li>
            </ul>
        </div>
    </div> --}}

{{-- <div class="row bottom tags-wrap">
        <div class="col-full tags">
            <h3>Tags</h3>

            <div class="tagcloud">
                <a href="#0">Salad</a>
                <a href="#0">Recipe</a>
                <a href="#0">Places</a>
                <a href="#0">Tips</a>
                <a href="#0">Friends</a>
                <a href="#0">Travel</a>
                <a href="#0">Exercise</a>
                <a href="#0">Reading</a>
                <a href="#0">Running</a>
                <a href="#0">Self-Help</a>
                <a href="#0">Vacation</a>
            </div> <!-- end tagcloud -->
        </div> <!-- end tags -->
    </div> <!-- end tags-wrap --> --}}

{{-- </section> --}}
