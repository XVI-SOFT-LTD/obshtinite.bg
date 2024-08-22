@extends('layouts.admin')

@section('content')
    {!! Form::open([
        'route' => [$routes . '.update', 'id' => $object->id],
        'method' => 'PUT',
        'files' => true,
        'class' => 'form-horizontal form-label-left',
    ]) !!}
    {{ Form::hidden('formMode', 'edit') }}

    @include('admin.partials._languages_tabs', [
        'path' => $routes . '._form_multilanguage',
        'i18n' => $object->i18nAdmin(),
        'formMode' => 'edit',
    ])
    <div class="clearfix"></div>
    <div class="ln_solid"></div>

    @include ($routes . '._form', ['formMode' => 'edit'])

    <div class="ln_solid"></div>
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <a href="{{ route($routes . '.index') }}" class="btn btn-default">Отказ</a>
        <button type="submit" class="btn btn-success">Запази</button>
    </div>
    {!! Form::close() !!}
@endsection
