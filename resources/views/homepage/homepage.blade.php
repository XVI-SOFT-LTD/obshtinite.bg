@extends('layouts.layout')

@section('content')
    @include('news._list_news', ['news' => $news])
    @include('layouts.partials._before_footer', ['parliamentaryGroups', $parliamentaryGroups])
@endsection
