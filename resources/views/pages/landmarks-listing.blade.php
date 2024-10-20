{{-- @include('layouts.partials._head')
@include('layouts.partials._before_header')


@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Всички Забележителности</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10 px-5">
            @foreach ($landmarks as $landmark)
                <div class="flex flex-col gap-3 group p-3 hover:shadow-xl transition-all">
                    <img src="{{ $landmark->getLogo() }}" class="h-[200px] object-cover">
                    <div class="flex flex-col gap-2 text-start px-2">
                        <h1 class="font-bold">{{ $landmark->i18n->name }}</h1>
                        <p class="text-sm">
                            {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($landmark->i18n->description)), 50) }}
                        </p>
                        <a href=""
                            class="w-max text-sm text-red group-hover:text-white">
                            Виж още <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@include('layouts.partials._footer') --}}