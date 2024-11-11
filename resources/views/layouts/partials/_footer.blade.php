<footer class="flex flex-col gap-5 bg-[#333333] mt-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 p-10">
        <img src="{{ asset('theme/images/logo.png') }}" class="xl:mt-[50px]">
        <div class="flex flex-col gap-3">
            <h1 class="text-lg text-white font-bold">{{ trans('app.logo') }}</h1>
            <ul class="flex flex-col gap-2 text-white">
                <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'za-nas']) }}" title="aboutUs">{{ trans('app.aboutUs') }}</a></li>
                <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'obshti-uslovia']) }}" title="generalConditions">{{ trans('app.generalConditions') }}</a></li>
                <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'poveritelnost']) }}" title="privacyPolicy">{{ trans('app.privacyPolicy') }}</a></li>
                <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'reklama']) }}" title="advertIsement">{{ trans('app.advertIsement') }}</a></li>
                <li><a class="hover:text-[#6d7b40]" href="{{ route('contacts') }}" title="contactUs">{{ trans('app.contactUs') }}</a></li>
            </ul>
        </div>
        <div class="flex flex-col gap-3">
            <h1 class="text-lg text-white font-bold">{{ trans('app.areas') }}</h1>
            <ul class="flex flex-col gap-2 text-white">
                @foreach ($areas->take(5) as $area)
                    <li>
                        <a class="hover:text-[#6d7b40]" href="{{ route('area.show', ['slug' => $area->slug]) }}" title="{{ $area->i18n->name }}">{{ $area->i18n->name }}</a>
                    </li>
                @endforeach
                @if ($areas->count() > 5)
                    <li>
                        {{-- <a href="{{ route('areas.index') }}" class="hover:text-[#6d7b40]">Още...</a> --}}
                        <a href="{{ route('category.listing.layout', ['categoryName' => 'areas']) }}" class="hover:text-[#6d7b40]">
                            <button>{{ trans('app.more') }}...</button>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="flex flex-col gap-3">
            <h1 class="text-lg text-white font-bold">{{ trans('app.contactUs') }}</h1>
            <ul class="flex flex-col gap-2 text-white">
                <li>{{ trans('app.footerAddress') }}</li>
                <li>{{ trans('app.footerPhone') }}</li>
                <li>{{ trans('app.footerEmail') }}</li>
            </ul>
        </div>
        <div class="flex flex-col gap-3">
            <h1 class="text-lg text-white font-bold">{{ trans('app.blogFooter') }}</h1>
            <ul class="flex flex-col gap-2 text-white">
                <ul class="flex flex-col gap-2 text-white">
                    <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'informatsionen-blog']) }}" title="blogFooter">{{ trans('app.blogFooter') }}</a></li>
                    <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'statii']) }}" title="articleFooter">{{ trans('app.articlesFooter') }}</a></li>
                    <li><a class="hover:text-[#6d7b40]" href="{{ route('page.show', ['slug' => 'video']) }}" title="videoFooter">{{ trans('app.videoFooter') }}</a></li>
                    <li><a class="hover:text-[#6d7b40]" href="{{ route('landmark.listAllLandmarks') }}" title="landmarks">{{ trans('app.landmarks') }}</a></li>
                </ul>
            </ul>
        </div>
    </div>

    <div class="line"></div>
    <p class="text-white px-10 font-light pb-3 text-center">
        © 2015 - {{ date('Y') }} <a href="{{ url('/') }}" class="text-green">obshtinite.bg</a> - Всички права запазени.
        | Design and development: <a class="text-white text-decoration-none" href="https://xvi-soft.com" target="_blank">XVI-SOFT LTD</a>
    </p>
</footer>
