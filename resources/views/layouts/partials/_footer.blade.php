<?php $includeFooterCategories = ['oblasti', 'obshtinite-na-balgaria', 'kontakti', 'informatsionen-blog']; ?>

<footer class="flex flex-col gap-5 bg-[#333333] mt-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 p-10">
        <img src="{{ asset('theme/images/logo.png') }}" class="xl:mt-[50px]">
        {{-- @dump($totalNews) --}}
        @foreach ($categories as $category)
            @if (in_array($category->slug, $includeFooterCategories))
                <div class="flex flex-col gap-3">
                    <h1 class="text-lg text-white font-bold">{{ $category->i18n->name }}</h1>
                    <ul class="flex flex-col gap-2 text-white">
                        @foreach ($categories as $category)
                        <li><a href="{{ route('category.show', $category->slug) }}" class="hover:text-[#6d7b40]">{{ $category->i18n->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>

    <div class="line"></div>
    <p class="text-white px-10 font-light pb-3">
        "All rights reserved " <a class="text-green" href="#">{{ config('app.name') }}</a>
    </p>
    
</footer>