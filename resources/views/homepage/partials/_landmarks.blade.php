<div class="flex-col-5">
    <div>
        <div class="relative">
            <div class="z-10 flex-between p-5">
                <div class="uppercase z-10">Забележителности</div>
                <span class="text-sm z-10">Бизнес и администрация | Транспорт | Мероприятия | Образование | Заведения | Магазини | Хотели | Здраве и класота</span>
            </div>

            <img src="{{ config('app.paths.img') }}/white.png" class="absolute h-[65px] w-full z-1 top-0" />
        </div>
        <div class="relative text-white">
            <div class="z-10 flex items-center justify-between bg-green p-3 text-white">
                <div class="w-full text-center z-10">{{ trans('app.naturalSights') }} | <span class="underline">{{ trans('app.architecturalLandmarks') }}</span> |
                    {{ trans('app.museums') }}</div>
                <button class="z-10">{{ trans('app.viewAll') }}</button>
            </div>

            <img src="{{ config('app.paths.img') }}/green.png" class="absolute h-[65px] w-full z-1 top-0" />
        </div>
    </div>

    {{-- swiper-3 --}}
    <div class="swiper thirdLongSwiper p-5">
        <div class="swiper-wrapper">
            @foreach ($landmarks as $landmark)
                <div class="swiper-slide group transition-all w-full hover:shadow-xl">
                    <div class="flex flex-col gap-3 p-3">
                        <img src="{{ $landmark->getLogo() }}" class="w-full h-[10px] object-cover" alt="{{ $landmark->i18n->name }}" />
                        <div class="flex flex-col gap-2 text-start px-2">
                            <div class="font-bold">{{ $landmark->i18n->name }}</div>
                            <div class="text-sm">{{ Str::limit(html_entity_decode(strip_tags($landmark->i18n->description)), 50) }}</div>
                        </div>
                    </div>
                    <a href="{{ $landmark->getUrl() }}"
                        class="group-hover:bg-[#333333] transition-all text-sm text-red group-hover:text-white w-full group-hover:p-2 group-hover:flex group-hover:items-center group-hover:justify-between group-hover:shadow-inner">
                        <span>{{ trans('app.seeMore') }}</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    {{-- swiper-3 --}}
</div>
