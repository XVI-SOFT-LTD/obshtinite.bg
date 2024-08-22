@extends('layouts.layout')

@section('content')
    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <h1>Търсене за: „{!! $word !!}“</h1>
        </div>
    </div>
    @include('news._list_news', ['news' => $news])
@endsection
