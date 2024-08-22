<div class="entry" style="background-image:url('{{ $news->getLogo() }}');">
    <div class="entry__content">
        <span class="entry__category">{!! Helper::getNewsCategoriesNames($news, false) !!}</span>
        <h1>
            <a href="{{ $news->getUrl() }}" title="{{ $news->i18n->title }}">{!! Str::limit($news->i18n->title, 120) !!}</a>
        </h1>
        <div class="entry__info">
            @if ($news->authors->count())
                <a href="{{ $news->getUrl() }}" class="entry__profile-pic">
                    <img class="avatar" src="{{ $news->authors[0]->getLogo() }}" alt="{{ Helper::getNewsAuthorsNames($news, false) }}">
                </a>
            @endif

            <ul class="entry__meta">
                <li>{!! Helper::getNewsAuthorsNames($news) !!}</li>
                <li>{{ Helper::formatDateForHuman($news->publish_date) }}</li>
            </ul>
        </div>
    </div> <!-- end entry__content -->

</div> <!-- end entry -->
