@extends('layouts.admin')

@section('content')
    {!! Form::open([
        'route' => $routes . '.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'form-horizontal form-label-left',
    ]) !!}
    {{ Form::hidden('formMode', 'create') }}

    @isset($customButtons)
        <div class="row">
            <div class="col-md-12">
                @include('admin.partials._custom_buttons_content')
            </div>
        </div>
        <div class="ln_solid"></div>
    @endisset

    <div class="row">
        <div class="col-md-8">
            @include('admin.partials._languages_tabs', [
                'path' => $routes . '._form_multilanguage',
                'i18n' => null,
                'formMode' => 'create',
            ])
        </div>
        <div class="col-md-4">
            <ul class="bar_tabs"></ul>
            @include ($routes . '._form', ['formMode' => 'create'])
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <a href="{{ route($routes . '.index') }}" class="btn btn-default">Отказ</a>
        <button id="submit" type="submit" class="btn btn-success">Запази</button>
    </div>
    {!! Form::close() !!}
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
@endpush
