@extends('layouts.layout')

@section('content')
    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <h1>Категория: {{ $category->i18n->name }}</h1>

            <div class="lead">{{ $category->i18n->description }}</div>
        </div>
    </div>

    @include('news._list_news', ['news' => $news])
@endsection
