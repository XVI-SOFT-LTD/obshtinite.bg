@include('layouts.partials._before_header')
<!-- header -->
<header class="flex flex-col overflow-x-hidden">
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
        <h1 class="uppercase font-light text-black">Информационен блог</h1>
        <button class="h-full">Виж Всички</button>
    </div>
</header>

<script src="https://cdn.tailwindcss.com"></script>
<script type="module" src="{{ config('app.paths.js') }}/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://kit.fontawesome.com/90bafb394a.js" crossorigin="anonymous"></script>
