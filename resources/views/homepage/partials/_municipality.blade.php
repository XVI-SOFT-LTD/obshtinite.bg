<div class="relative text-white">
    <div class="z-10 flex-between p-5">
        <div class="uppercase z-10">{{ trans('app.municipalities') }}</div>
        <a href="#" class="z-10">{{ trans('app.viewAll') }}</a>
    </div>

    <img src="{{ config('app.paths.img') }}/green.png" class="absolute h-[65px] w-full z-1 top-0" />
</div>

{{-- swiper-1 --}}
<div class="swiper firstLongSwiper p-5">
    <div class="swiper-wrapper">
        @foreach ($municipalities as $municipality)
            <div class="swiper-slide">
                <div class="swiper-slide flex flex-col gap-3 group hover:bg-[#6d7b40] p-3 transition-all hover:shadow-lg">
                    <img src="{{ $municipality->getLogo() }}" class="h-[100px] object-cover" alt="{{ $municipality->i18n->name }}" />
                    <div class="flex flex-col gap-2 text-start px-2">
                        <a href="{{ $municipality->getUrl() }}" class="font-bold group-hover:text-white">{{ $municipality->i18n->name }}</a>
                        <div class="text-sm group-hover:text-white">{{ Str::limit(html_entity_decode(strip_tags($municipality->i18n->description)), 50) }}</div>
                        <a href="{{ $municipality->getUrl() }}" title="{{ $municipality->i18n->name }}" class="w-max text-sm text-red group-hover:text-white">
                            {{ trans('app.seeMore') }} <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
{{-- swiper-1 --}}
