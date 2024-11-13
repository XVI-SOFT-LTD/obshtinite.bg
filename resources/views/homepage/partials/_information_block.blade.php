<div class="relative">
    <div class="z-10 flex-between p-5">
        <h1 class="uppercase z-10">Информационен блог</h1>
        <button class="z-10">{{ trans('app.viewAll') }}</button>
    </div>

    <img src="{{ config('app.paths.img') }}/info-blog.png" class="absolute h-[60px] w-full z-1 top-0" />
</div>
<section class="grid-3 gap-10 p-5 lg:p-10">
    <!-- 3 grid cards -->
    <div class="grid-3 gap-5 lg:col-span-2">
        @foreach ($news as $row)
            <div class="flex flex-col lg:flex-row gap-3 w-full bg-[#E9E9E9] group hover:bg-[#383838] transition-all">
                <img class="w-full lg:w-[150px] h-auto object-cover" src="{{ $row->logo }}" alt="{{ $row->title }}" />
                <div class="flex flex-col gap-1 py-2 px-2 lg:px-0">
                    <p class="font-light group-hover:text-white">{{ date('d.m.Y H:i', strtotime($row->created_at)) }}</p>
                    <a href="{{ $row->url }}" target="_blank" class="font-bold text-lg group-hover:text-white">
                        {!! $row->title !!}
                    </a>
                    @if ($row->description)
                        <p class="text-sm max-w-[350px] group-hover:text-white">
                            {!! $row->description !!}
                        </p>
                    @endif
                    <a href="{{ $row->url }}" target="_blank" class="view group-hover:text-white">прочети повече</a>
                    {{-- 
                    <!-- Optionally include button if needed -->
                    <!-- <button class="w-max text-sm text-red group-hover:text-white">Read More</button> -->
                    --}}
                </div>
            </div>
        @endforeach
    </div>
    <!-- 3 grid cards -->

    <div class="flex-col-5 col-span-1">
        <!-- swiper-two -->
        <div class="swiper swiperTwo max-h-[30vh] lg:max-h-[20vh]">
            <div class="swiper-wrapper">
                <div class="swiper-slide relative">
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                        <h1 class="text-white text-5xl">Амфи Театър 1</h1>
                    </div>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Roman_Theatre_Plovdiv.jpg" class="" alt="image" />
                </div>
                <div class="swiper-slide relative">
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                        <h1 class="text-white text-5xl">Амфи Театър 2</h1>
                    </div>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Roman_Theatre_Plovdiv.jpg" class="" alt="image" />
                </div>
                <div class="swiper-slide relative">
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                        <h1 class="text-white text-5xl">Амфи Театър 3</h1>
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
                        <h1 class="text-white text-5xl">Амфи Театър 1</h1>
                    </div>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Roman_Theatre_Plovdiv.jpg" class="" alt="image" />
                </div>
                <div class="swiper-slide relative">
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                        <h1 class="text-white text-5xl">Амфи Театър 2</h1>
                    </div>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Roman_Theatre_Plovdiv.jpg" class="" alt="image" />
                </div>
                <div class="swiper-slide relative">
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                        <h1 class="text-white text-5xl">Амфи Театър 3</h1>
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
