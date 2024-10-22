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
    <h1 class="uppercase font-light text-black">{{ trans('app.blogFooter') }}</h1>
    <a href="{{ route('category.listing.layout', ['categoryName' => 'news']) }}" class="uppercase text-lg">
        <button>{{ trans('app.viewAll') }}</button>
    </a>
</div>
