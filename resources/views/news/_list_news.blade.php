<div class="row masonry-wrap">
    <div class="masonry">
        <div class="grid-sizer"></div>
        
        @forelse ($news as $row)
            @php
                $lengths = [140, 260, 180, 220];
                $randomLengthDescription = $lengths[array_rand($lengths)];
            @endphp
            @include('news.partials._standart', [
                'row' => $row,
                'randomLength' => $randomLengthDescription,
            ])
        @empty
            <div class="row narrow">
                <div class="col-full s-content__header" data-aos="fade-up">
                    <p class="lead">{{ trans('app.noFoundResults') }}</p>
                </div>
            </div>
        @endforelse
    </div> <!-- end masonry -->
</div> <!-- end masonry-wrap -->
