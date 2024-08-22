@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="pull-left">
                <form action="{{ route($routes . '.index') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="word" value="{{ old('word', request()->get('word')) }}" class="form-control" placeholder="Търсене...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
            @if (!$dataTable->getHideCreateButton())
                <div class="pull-right">
                    <a href="{{ route($routes . '.create') }}" class="btn btn-success">
                        <i class="fa fa-plus mt-1"></i> Създай
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th>#</th>
                    @foreach ($dataTable->getColumns() as $column)
                        <th>
                            {{ $column }}
                            {{-- <i class="fa fa-arrow-up"></i>
                            <i class="fa fa-arrow-down"></i> --}}
                        </th>
                    @endforeach
                    <th class="column-title">Действия</th>
                </tr>
            </thead>

            <tbody>
                @if (empty($dataTable->getRows()))
                    <tr>
                        <td colspan="{{ count($dataTable->getColumns()) + 3 }}" class="text-center">Няма намерени резултати</td>
                    </tr>
                @else
                    @foreach ($dataTable->getRows() as $row)
                        <tr id="row_{{ $row->id }}" class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }} pointer">
                            <td class="a-center">{{ $row->id }}</td>
                            @foreach ($row as $key => $cell)
                                @if ($key == 'id')
                                    @continue
                                @endif
                                <td>{!! $cell !!}</td>
                            @endforeach
                            <td class="last text-nowrap action-buttons">
                                <div class="action-buttons">
                                    <a href="{{ route($routes . '.edit', $row->id) }}" title="Редактирай">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a class="btn btn-danger btn-sm delete-button" href="javascript:void(0);" title="Изтрий" onclick="confirmDelete({{ $row->id }})">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>

    <p class="fontColor f-14 fw-400">
        @if ($paginator->total() > 0)
            {{ __('admin.showing_count_results', ['from' => $paginator->firstItem(), 'to' => $paginator->lastItem(), 'total' => $paginator->total()]) }}
        @endif
    </p>
    {{ $paginator->withQueryString()->links() }}
@endsection

@if ($dataTable->getRowsCount())
    @push('scripts')
        @include('admin.datatable._scripts')
    @endpush
@endif
