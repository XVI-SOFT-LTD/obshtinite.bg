@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="s-content__header col-full">
            <h1 class="s-content__header-title">{!! $page->i18n->title !!}</h1>
        </div>

        <div class="col-full s-content__main">{!! $page->i18n->description !!}</div>
    </div>
@endsection
