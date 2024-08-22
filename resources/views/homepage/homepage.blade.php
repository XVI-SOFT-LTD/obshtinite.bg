@extends('layouts.layout')

@section('content')
    @include('news._list_news', ['news' => $news])
@endsection
