<div class="relative text-white">
    <div class="z-10 flex-between p-5">
        <h1 class="uppercase z-10">{{ trans('app.parliamentaryGroups') }}</h1>
        <button class="z-10">{{ trans('app.viewAll') }}</button>
    </div>

    <img src="{{ config('app.paths.img') }}/red.png" class="absolute h-[65px] w-full z-1 top-0" />
</div>

{{-- swiper-2 --}}
<div class="swiper secondLongSwiper p-5">
    <div class="swiper-wrapper">
        @foreach ($parties as $party)
            <div class="swiper-slide group transition-all w-full hover:bg-[#8b2c3e]">
                <div class="flex flex-col gap-3 p-3">
                    @if ($party->getLogo() != '/theme/img/no-image.png')
                        <img src="{{ $party->getLogo() }}" class="w-full h-[10px] object-cover" alt="{{ $party->i18n->name }}" />
                    @endif
                    <div class="flex flex-col gap-2 text-start px-2">
                        <a href="{{ $party->getUrl() }}" class="font-bold group-hover:text-white">{{ $party->i18n->name }}</a>
                        <div class="text-sm group-hover:text-white">{{ Str::limit(html_entity_decode(strip_tags($party->i18n->description)), 50) }}</div>
                    </div>
                </div>
                <a href="{{ $party->getUrl() }}" class="transition-all text-sm text-red group-hover:text-white w-full group-hover:p-2 group-hover:flex group-hover:items-center group-hover:justify-between group-hover:shadow-inner">
                    <span>{{ trans('app.seeMore') }}</span> <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
{{-- swiper-2 --}}
