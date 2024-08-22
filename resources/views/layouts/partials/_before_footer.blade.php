<section class="s-extra">
    <div class="row top">
        <div class="col-eight md-six tab-full popular">
            <h3>Популярни новини</h3>

            <div class="block-1-2 block-m-full popular__posts">
                @foreach ($popularNews as $popular)
                    <article class="col-block popular__post">
                        <a href="{{ $popular->getUrl() }}" class="popular__thumb">
                            <img src="{{ $popular->getLogo(69) }}" alt="{{ $popular->i18n->title }}">
                        </a>
                        <h5><a href="{{ $popular->getUrl() }}">{{ Str::limit(strip_tags($popular->i18n->title), 55) }}</a></h5>
                        <section class="popular__meta">
                            <span class="popular__author">{!! Helper::getNewsAuthorsNames($popular) !!}</span>
                            <span class="popular__date">
                                <span>|</span>
                                <time datetime="{{ date('Y-m-d', strtotime($popular->publish_date)) }}">{{ Helper::formatDateForHuman($popular->publish_date) }}</time>
                            </span>
                        </section>
                    </article>
                @endforeach
            </div>
        </div>

        <div class="col-four md-six tab-full about">
            <h3>За Fakla.bg</h3>

            <p>Кратко описание за проета или някакъв друг текст .. може да го махнем този абзац или цялото каре ако мислите, че няма нужда от него :).. </p>

            <ul class="about__social">
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
        </div>
    </div>

    {{-- <div class="row bottom tags-wrap">
        <div class="col-full tags">
            <h3>Tags</h3>

            <div class="tagcloud">
                <a href="#0">Salad</a>
                <a href="#0">Recipe</a>
                <a href="#0">Places</a>
                <a href="#0">Tips</a>
                <a href="#0">Friends</a>
                <a href="#0">Travel</a>
                <a href="#0">Exercise</a>
                <a href="#0">Reading</a>
                <a href="#0">Running</a>
                <a href="#0">Self-Help</a>
                <a href="#0">Vacation</a>
            </div> <!-- end tagcloud -->
        </div> <!-- end tags -->
    </div> <!-- end tags-wrap --> --}}

</section>
