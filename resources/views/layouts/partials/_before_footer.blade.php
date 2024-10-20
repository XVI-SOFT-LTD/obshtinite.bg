<!-- obshtini -->
<div class="grid gird-cols-1 lg:grid-cols-3 gap-32">
    <!-- left side -->
    <div class="flex flex-col gap-5 lg:col-span-2">
        <div class="flex flex-col gap-3">
            <div class="flex items-center justify-between px-5 bg-green w-full p-3 text-white">
                <h1 class="uppercase text-xl">{{ trans('app.municipalities') }}</h1>
                <a href="{{ route('category.listing.layout', ['categoryName' => 'municipalities']) }}"
                    class="uppercase text-lg">
                    <button>{{ trans('app.viewAll') }}</button>
                </a>
            </div>

            <div class="swiper mySwiperFour">
                <div class="swiper-wrapper xl:px-5">
                    @foreach ($municipalities as $municipality)
                        <div
                            class="swiper-slide flex flex-col gap-3 group hover:bg-[#6d7b40] p-3 transition-all hover:shadow-lg ">
                            <img src="{{ $municipality->getLogo() }}" class="h-[200px] object-cover">
                            <div class="flex flex-col gap-2 text-start  px-2">
                                <h1 class="font-bold group-hover:text-white">{{ $municipality->i18n->name }}</h1>
                                <p class="text-sm group-hover:text-white">
                                    {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($municipality->i18n->description)), 50) }}
                                </p>
                                <a href="{{ route('municipality.show', $municipality->slug) }}"
                                    class="w-max text-sm text-red group-hover:text-white">
                                    Виж още <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="swiper-pagination"></div> --}}
            </div>
        </div>
        <div class="flex flex-col gap-3">
            <div class="flex items-center justify-between px-5 bg-red w-full p-3 text-white">
                <h1 class="uppercase text-xl">{{ trans('app.parliamentaryGroups') }}</h1>
                <a href="{{ route('category.listing.layout', ['categoryName' => 'parliamentaryGroups']) }}"
                    class="uppercase text-lg">
                    <button>{{ trans('app.viewAll') }}</button>
                </a>
            </div>


            <div class="swiper mySwiperFour">
                <div class="swiper-wrapper xl:px-5">
                    @foreach ($parliamentaryGroups as $parliamentaryGroup)
                        <div class="swiper-slide flex flex-col gap-3 group transition-all hover:bg-[#8b2c3e] p-3">
                            <img src="{{ $parliamentaryGroup->getLogo() }}" class="h-[200px] object-cover">
                            <div class="flex flex-col gap-2 text-start px-2">

                                <h1 class="font-bold group-hover:text-white">{{ $parliamentaryGroup->i18n->name }}</h1>
                                <p class="text-sm group-hover:text-white">
                                    {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($parliamentaryGroup->i18n->description)), 50) }}
                                </p>
                                <a href="{{ route('parliamentaryGroup.show', $parliamentaryGroup->slug) }}"
                                    class="w-max text-sm text-red group-hover:text-white">
                                    {{ trans('app.seeMore') }}<i class="fa-solid fa-chevron-right"></i>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="swiper-pagination"></div> --}}
            </div>

        </div>
        <div class="flex flex-col gap-3">
            <div class="flex items-center justify-between px-5 bg-green w-full p-3 text-white">
                <h1 class="w-full text-center">Природни забележителности | <span class="underline">Архитектурни
                        забележителности</span> | Музеи</h1>
                <a href="{{ route('category.listing.layout', ['categoryName' => 'landmarks']) }}"
                    class="uppercase w-1/3 flex justify-end">
                    <button>{{ trans('app.viewAll') }}</button>
                </a>
            </div>
            <div class="swiper mySwiperFour">
                <div class="swiper-wrapper xl:px-5">
                    @foreach ($landmarks as $landmark)
                        <div class="swiper-slide flex flex-col gap-3  group p-3 hover:shadow-xl transition-all">
                            <img src="{{ $landmark->getLogo() }}" class="h-[200px] object-cover">
                            <div class="flex flex-col gap-2 text-start px-2">
                                <h1 class="font-bold">{{ $landmark->i18n->name }}</h1>
                                <p class="text-sm">
                                    {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($landmark->i18n->description)), 50) }}
                                </p>
                                <button
                                    class="transition-all py-2 px-3 w-max text-sm text-red group-hover:text-white group-hover:w-full group-hover:flex group-hover:justify-between group-hover:items-center group-hover:bg-[#333333]">{{ trans('app.seeMore') }}<i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="swiper-pagination"></div> --}}
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
