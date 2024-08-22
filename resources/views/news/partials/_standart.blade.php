<article class="masonry__brick entry format-standard" data-aos="fade-up">

    <div class="entry__thumb">
        <a href="{{ $row->getUrl() }}" class="entry__thumb-link">
            <img src="{{ $row->getLogo() }}" srcset="{{ $row->getLogo() }} 1x, {{ $row->getLogo(960) }} 2x" alt="{{ $row->i18n->title }}">
        </a>
    </div>

    <div class="entry__text">
        <div class="entry__header">

            <div class="entry__date">
                <a href="{{ $row->getUrl() }}">{{ Helper::formatDateForHuman($row->publish_date) }}</a>
            </div>
            <h1 class="entry__title">
                <a href="{{ $row->getUrl() }}" title="{{ $row->i18n->title }}">{{ $row->i18n->title }}</a>
            </h1>

        </div>
        <div class="entry__excerpt">
            {!! Str::limit(strip_tags($row->i18n->description), $randomLength) !!}
        </div>
        <div class="entry__meta">
            <span class="entry__meta-links">
                {!! Helper::getNewsCategoriesNames($row, false) !!}
            </span>
        </div>
    </div>

</article> <!-- end article -->

{{-- <article class="masonry__brick entry format-standard" data-aos="fade-up">

            <div class="entry__thumb">
                <a href="{{ $row->getUrl() }}" class="entry__thumb-link">
                    <img src="{{ config('app.paths.img') }}/thumbs/masonry/tulips-400.jpg"
                        srcset="{{ config('app.paths.img') }}/thumbs/masonry/tulips-400.jpg 1x, {{ config('app.paths.img') }}/thumbs/masonry/tulips-800.jpg 2x" alt="">
                </a>
            </div>

            <div class="entry__text">
                <div class="entry__header">

                    <div class="entry__date">
                        <a href="{{ $row->getUrl() }}">December 15, 2017</a>
                    </div>
                    <h1 class="entry__title"><a href="{{ $row->getUrl() }}">10 Interesting Facts About Caffeine.</a></h1>

                </div>
                <div class="entry__excerpt">
                    <p>
                        Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia
                        aute incididunt velit sint in aliqua...
                    </p>
                </div>
                <div class="entry__meta">
                    <span class="entry__meta-links">
                        <a href="{{ route('category') }}">Health</a>
                    </span>
                </div>
            </div>

        </article> <!-- end article --> --}}
