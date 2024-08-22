<header class="header">
    <div class="header__content row">
        <div class="header__logo">
            <a class="logo" href="{{ route('homepage') }}">
                Fakla.bg
                {{-- <img src="{{ config('app.paths.img') }}/logo.svg" alt="{{ env('APP_NAME') }}"> --}}
            </a>
        </div>
        <ul class="header__social">
            <li>
                <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
            </li>
        </ul>
        <a class="header__search-trigger" href="#0"></a>

        <div class="header__search">
            <form role="search" action="{{ route('search.post') }}" method="POST" class="header__search-form">
                @csrf
                <label>
                    <span class="hide-content">Търсене</span>
                    <input type="search" class="search-field" placeholder="Въведете дума за търсене" value="" name="word" title="Търсене" autocomplete="off">
                </label>
                <input type="submit" class="search-submit" value="Търси">
            </form>
            <a href="#0" title="Затвори" class="header__overlay-close">Затвори</a>
        </div>

        <a class="header__toggle-menu" href="#0" title="Меню"><span>Меню</span></a>

        <nav class="header__nav-wrap">
            <h2 class="header__nav-heading h6">Меню</h2>

            <ul class="header__nav">
                <li class="{{ Route::currentRouteName() == 'homepage' ? 'current' : '' }}"><a href="{{ route('homepage') }}" title="Начало">Начало</a></li>
                @foreach ($categories as $category)
                    <li class="@if (isset($activeCategory) && $activeCategory == $category->id) current @endif">
                        <a href="{{ route('category.show', $category->slug) }}" title="{{ $category->i18n->name }}">{{ $category->i18n->name }}</a>
                    </li>
                @endforeach
                {{-- <li class="has-children">
                    <a href="#0" title="">Статия</a>
                    <ul class="sub-menu">
                        <li><a href="{{ url('video') }}">Видео темплейт</a></li>
                        <li><a href="single-audio.html">Аудио темплейт</a></li>
                        <li><a href="single-gallery.html">Галерия темплейт</a></li>
                        <li><a href="single-standard.html">Стандартен темплейт</a></li>
                    </ul>
                </li> --}}
            </ul>

            <a href="#0" title="Затвори менюто" class="header__overlay-close close-mobile-menu">Затвори</a>

        </nav> <!-- end header__nav-wrap -->
    </div> <!-- header-content -->
</header> <!-- end header -->


@isset($homepage)
    <div class="pageheader-content row">
        <div class="col-full">
            <div class="featured">
                <div class="featured__column featured__column--big">
                    @include('homepage.partials._header_news_x', ['news' => $topNews[0]])
                </div>

                <div class="featured__column featured__column--small">
                    @includeWhen($topNews[1], 'homepage.partials._header_news_x', ['news' => $topNews[1]])
                    @includeWhen($topNews[2], 'homepage.partials._header_news_x', ['news' => $topNews[2]])
                </div>
            </div>
        </div>
    </div>
@endisset
