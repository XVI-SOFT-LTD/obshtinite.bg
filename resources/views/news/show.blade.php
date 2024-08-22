@extends('layouts.layout')

@section('content')
    <article class="row format-standard">
        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">
                {{ $news->i18n->title }}
            </h1>
            <ul class="s-content__header-meta">
                <li class="date">{{ Helper::formatDateForHuman($news->publish_date) }}</li>
                <li class="cat">{!! Helper::getNewsCategoriesNames($news, false) !!}</li>
            </ul>
        </div> <!-- end s-content__header -->

        <div class="s-content__media col-full">
            <div class="s-content__post-thumb">
                <img src="{{ $news->getLogo(960) }}"
                    srcset="{{ $news->getLogo(960) }} 2000w, 
                                 {{ $news->getLogo(960) }} 1000w, 
                                 {{ $news->getLogo(773) }} 500w"
                    sizes="(max-width: 2000px) 100vw, 2000px" alt="{{ $news->i18n->title }}">
            </div>
        </div> <!-- end s-content__media -->

        <div class="col-full s-content__main">

            {!! $news->i18n->description !!}

            <div class="s-content__author">
                @if ($news->authors->count())
                    <a href="{{ $news->getUrl() }}" class="">
                        <img class="avatar" src="{{ $news->authors[0]->getLogo(66) }}" alt="{{ Helper::getNewsAuthorsNames($news, false) }}">
                    </a>
                    <div class="s-content__author-about">
                        <h4 class="s-content__author-name">
                            {!! Helper::getNewsAuthorsNames($news) !!}
                        </h4>

                        @if (isset($news->authors[0]->i18n->description))
                            <p>{!! $news->authors[0]->i18n->description !!}</p>
                        @endif

                        {{-- <ul class="s-content__author-social">
                            <li><a href="#0">Facebook</a></li>
                            <li><a href="#0">Twitter</a></li>
                            <li><a href="#0">GooglePlus</a></li>
                            <li><a href="#0">Instagram</a></li>
                        </ul> --}}
                    </div>
                @endif
            </div>

            <div class="s-content__pagenav">
                <div class="s-content__nav">
                    @if ($previousNews)
                        <div class="s-content__prev">
                            <a class="ff-openSans fs-16" href="{{ route('news.show', ['id' => $previousNews->id, 'slug' => $previousNews->slug]) }}" rel="prev">
                                <span>Предишна статия</span>
                                {{ $previousNews->i18n->title }}
                            </a>
                        </div>
                    @endif
                    @if ($nextNews)
                        <div class="s-content__next">
                            <a class="ff-openSans fs-16" href="{{ route('news.show', ['id' => $nextNews->id, 'slug' => $nextNews->slug]) }}" rel="next">
                                <span>Следваща статия</span>
                                {{ $nextNews->i18n->title }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </article>


    @if ($news->related->count())
        <div class="row top">
            <div class="col-full md-six tab-full simular">
                <h3>Свързани новини</h3>

                <div class="block-1-3 block-m-full simular__posts">
                    @foreach ($news->related as $related)
                        <article class="col-block simular__post">
                            <a href="{{ $related->getUrl() }}" class="simular__thumb">
                                <img src="{{ $related->getLogo(320) }}" alt="{{ $related->i18n->title }}">
                            </a>
                            <h5><a href="{{ $related->getUrl() }}">{{ Str::limit(strip_tags($related->i18n->title), 55) }}</a></h5>
                            <section class="simular__meta">
                                <span class="simular__author">{!! Helper::getNewsAuthorsNames($related) !!}</span>
                                <span class="simular__date">
                                    <span>|</span>
                                    <time datetime="{{ date('Y-m-d', strtotime($related->publish_date)) }}">{{ Helper::formatDateForHuman($related->publish_date) }}</time>
                                </span>
                            </section>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
