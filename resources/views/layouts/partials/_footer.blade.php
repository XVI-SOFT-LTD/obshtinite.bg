<?php $includeFooterCategories = ['oblasti', 'obshtinite-na-balgaria', 'kontakti', 'informatsionen-blog']; ?>

<footer class="flex flex-col gap-5 bg-[#333333] mt-10">
    {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 p-10">
        <img src="{{ asset('theme/images/logo.png') }}" class="xl:mt-[50px]">
        @foreach ($categories as $category)
            @if (in_array($category->slug, $includeFooterCategories))
                <div class="flex flex-col gap-3">
                    <h1 class="text-lg text-white font-bold">{{ $category->i18n->name }}</h1>
                    <ul class="flex flex-col gap-2 text-white">
                        @foreach ($category->childs as $childCategory)
                        <li><a href="{{ route('category.show', $childCategory->slug) }}" class="hover:text-[#6d7b40]">{{ $childCategory->i18n->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div> --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 p-10">
        <img src="{{ asset('theme/images/logo.png') }}" class="xl:mt-[50px]">
        <div class="flex flex-col gap-3">
            <h1 class="text-lg text-white font-bold">Общините в България</h1>
            <ul class="flex flex-col gap-2 text-white">
                <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'za-nas']) }}" title="За нас">За
                        нас</a></li>
                <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'obshti-uslovia']) }}"
                        title="Общи условия">Общи условия</a></li>
                <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'poveritelnost']) }}"
                        title="Поверителност">Поверителност</a></li>
                <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'reklama']) }}"
                        title="Реклама">Реклама</a></li>
                <li><a class="hover:text-[#6d7b40]" href="{{ route('contacts') }}" title="Контакти">Контакти</a></li>
            </ul>
        </div>
        <div class="flex flex-col gap-3">
            <h1 class="text-lg text-white font-bold">Области</h1>
            <ul class="flex flex-col gap-2 text-white">
                @foreach ($areas->take(5) as $area)
                    <li>
                        <a class="hover:text-[#6d7b40]" href="{{ route('area.show', ['slug' => $area->slug]) }}"
                            title="{{ $area->i18n->name }}">{{ $area->i18n->name }}</a>
                    </li>
                @endforeach
                @if ($areas->count() > 5)
                    <li>
                        <a href="" class="hover:text-[#6d7b40]">Още...</a>
                        {{-- <a href="{{ route('areas.index') }}" class="hover:text-[#6d7b40]">Още...</a> --}}
                    </li>
                @endif
            </ul>
        </div>
        <div class="flex flex-col gap-3">
            <h1 class="text-lg text-white font-bold">Контакти</h1>
            <ul class="flex flex-col gap-2 text-white">
                <li>Адрес: ул. Голаш 26, София</li>
                <li>Поверителност</li>
                <li>Телефон: 0877758 96 89</li>
                <li>Е-mail: team@emediaconsult.bg</li>
            </ul>
        </div>
        <div class="flex flex-col gap-3">
            <h1 class="text-lg text-white font-bold">Информационен блог</h1>
            <ul class="flex flex-col gap-2 text-white">
                <ul class="flex flex-col gap-2 text-white">
                    <li><a class="hover:text-[#6d7b40]"
                            href="{{ route('page.show', ['slug' => 'informatsionen-blog']) }}"
                            title="Информационен блог">Информационен блог</a></li>
                    <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'statii']) }}"
                            title="Статии">Статии</a></li>
                    <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'video']) }}"
                            title="Видео">Видео</a></li>
                    <li><a class="hover:text-[#6d7b40]" href="{{ route('landmark.listAllLandmarks') }}"
                            title="Заележителност">Заележителности</a></li>
                </ul>
            </ul>
        </div>
    </div>

    <div class="line"></div>
    <p class="text-white px-10 font-light pb-3">
        "All rights reserved " <a class="text-green" href="#">{{ config('app.name') }}</a>
    </p>

</footer>
