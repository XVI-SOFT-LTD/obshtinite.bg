<div class="row masonry-wrap">
    <div class="masonry">
        <div class="grid-sizer"></div>
        @forelse ($news as $row)
            @php
                $lengths = [140, 260, 180, 220];
                $randomLengthDescription = $lengths[array_rand($lengths)];
            @endphp
            @include('news.partials._standart', ['row' => $row, 'randomLength' => $randomLengthDescription])
        @empty
            <div class="row narrow">
                <div class="col-full s-content__header" data-aos="fade-up">
                    @if (Route::currentRouteName() == 'search')
                        <p class="lead">Няма намерени резултати. Моля, опитайте с друга дума.</p>
                    @else
                        <p class="lead">Няма намерени новини в тази категория.</p>
                    @endif
                </div>
            </div>
        @endforelse
        {{-- @include('news.partials._quote')
        @include('news.partials._standart')
        @include('news.partials._standart')
        @include('news.partials._video')
        @include('news.partials._gallery')
        @include('news.partials._audio')
        @include('news.partials._link')
        @include('news.partials._standart')
        @include('news.partials._standart')
        @include('news.partials._standart')
        @include('news.partials._standart') --}}
    </div> <!-- end masonry -->
</div> <!-- end masonry-wrap -->

{{ $news->links() }}
