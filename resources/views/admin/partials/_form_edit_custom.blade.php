@extends('layouts.admin')

@section('content')
    {!! Form::open([
        'route' => [$routes . '.update', 'id' => $object->id],
        'method' => 'PUT',
        'files' => true,
        'class' => 'form-horizontal form-label-left',
    ]) !!}
    {{ Form::hidden('formMode', 'edit') }}

    <div class="row">
        <div class="col-md-8">
            @include('admin.partials._languages_tabs', [
                'path' => $routes . '._form_multilanguage',
                'i18n' => $object->i18nAdmin(),
                'formMode' => 'edit',
            ])
        </div>
        <div class="col-md-4">
            <ul class="bar_tabs"></ul>
            @include ($routes . '._form', ['formMode' => 'edit'])
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <a href="{{ route($routes . '.index') }}" class="btn btn-default">Отказ</a>
        <button type="submit" class="btn btn-success">Запази</button>
    </div>
    {!! Form::close() !!}
@endsection
