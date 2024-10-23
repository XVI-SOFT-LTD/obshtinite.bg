<div class="row masonry-wrap">
    <div class="masonry">
        <div class="grid-sizer"></div>
        <main class="container mx-auto mt-10 flex-grow max-w-screen-xl">
            @if ($models->isEmpty())
                <div class="flex justify-center items-center min-h-screen-75">
                    <p class="lead">{{ trans('app.noFoundResults') }}</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($models as $model)
                        @php
                            $lengths = [140, 260, 180, 220];
                            $randomLengthDescription = $lengths[array_rand($lengths)];
                        @endphp
                        <article
                            class="masonry__brick entry format-standard p-4 bg-white rounded-lg shadow-md transition-transform duration-300 hover:scale-105"
                            data-aos="fade-up">
                            <div class="entry__thumb mb-4">
                                <a href="{{ $model->getUrl() }}"
                                    class="block relative overflow-hidden rounded-lg shadow-lg">
                                    <img src="{{ $model->getLogo() }}" alt="{{ $model->i18n->title }}"
                                        class="w-full h-40 object-cover">
                                </a>
                            </div>
                            <div class="entry__text p-4">
                                <div class="entry__header mb-3">
                                    <div class="entry__date text-gray-500 text-sm mb-1">
                                        <a
                                            href="{{ $model->getUrl() }}">{{ Helper::formatDateForHuman($model->created_at) }}</a>
                                    </div>
                                    <h1 class="entry__title text-lg font-semibold mb-2">
                                        <a href="{{ $model->getUrl() }}" title="{{ $model->i18n->title }}"
                                            class="hover:text-blue-600">{{ $model instanceof App\Models\News ? $model->i18n->title : $model->i18n->name }}
                                            </h2></a>
                                    </h1>
                                </div>
                                <div class="entry__excerpt text-gray-700 text-sm">
                                    {!! Str::limit(strip_tags($model->i18n->description), $randomLengthDescription) !!}
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </main>
    </div> <!-- end masonry -->
</div> <!-- end masonry-wrap -->
