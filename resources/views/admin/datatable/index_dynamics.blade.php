@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
            @if (!$dataTable->getHideCreateButton())
                <div class="pull-right">
                    <a href="{{ route($routes . '.create') }}" class="btn btn-success">
                        <i class="fa fa-plus mt-1"></i> Създай
                    </a>
                </div>
            @endif
        </div>
    </div>
    <table id="datatable-dynamics" class="table table-striped table-bordered jambo_table" style="width:100%;">
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
@endsection

@if ($dataTable->getRowsCount())
    @push('css')
        <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <link href="{{ asset('build/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('build/css/dataTables.buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('build/css/dataTables.fixedheader.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('build/css/dataTables.responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('build/css/dataTables.scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    @endpush

    @push('scripts')
        <script src="{{ asset('build/js/datatables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/datatables.bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/datatables.buttons.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/buttons.bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/datatables.fixedheader.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/pdfmake.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/vfs_fonts.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/buttons.html5.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/buttons.print.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/buttons.flash.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/jszip.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/dataTables.keyTable.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/responsive.bootstrap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('build/js/dataTables.scroller.min.js') }}" type="text/javascript"></script>

        @include('admin.datatable._scripts')
    @endpush
@endif

@push('js-init')
    <script type="text/javascript">
        $('#datatable-dynamics').DataTable({
            fixedHeader: true,
            stateSave: true,
            //keys: true,
            'order': [
                [0, 'desc']
            ],
            dom: "fBlrtip",
            buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                },
                {
                    extend: "csv",
                    className: "btn-sm"
                },
                {
                    extend: "excel",
                    className: "btn-sm"
                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                },
                {
                    extend: "print",
                    className: "btn-sm"
                },
            ],
            responsive: true,
            'columnDefs': [{
                orderable: false,
                targets: [{{ implode(', ', $dataTable->getSkipSortableIds()) }}, {{ count($dataTable->getColumns()) + 1 }}]
            }],
            'language': {
                'search': 'Търсене:',
                'lengthMenu': 'Покажи _MENU_ записа на страница',
                'info': 'Показване от _START_ до _END_ от общо _TOTAL_ записа',
                'infoEmpty': 'Показване от 0 до 0 от общо 0 записа',
                'infoFiltered': '(филтрирани от общо _MAX_ записа)',
                'loadingRecords': 'Зареждане...',
                'processing': 'Обработка...',
                'zeroRecords': 'Няма намерени резултати',
                'emptyTable': 'Няма данни в таблицата',
                'paginate': {
                    'first': 'Първа',
                    'previous': 'Предишна',
                    'next': 'Следваща',
                    'last': 'Последна'
                },
                'aria': {
                    'sortAscending': ': активирано сортиране във възходящ ред',
                    'sortDescending': ': активирано сортиране в низходящ ред'
                }
            },
            pageLength: 50,
            lengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "Всички"]
            ],
        });

        /*
                $(document).ready(function() {
                    var table = $('#datatable-dynamics').DataTable();

                    table.on('draw', function() {
                        var searchText = $('#datatable-dynamics_filter input').val().toLowerCase();

                        table.rows().every(function() {
                            var data = this.data();
                            for (var i = 0; i < data.length; i++) {
                                var cell = $(this.node()).children().eq(i);
                                var cellText = cell.text().toLowerCase();
                                if (cellText.includes(searchText)) {
                                    var highlightedText = cell.text().replace(new RegExp(searchText, 'gi'), '<span class="highlight">$&</span>');
                                    cell.html(highlightedText);
                                } else {
                                    cell.html(cell.text()); // Remove previous highlights
                                }
                            }
                        });
                    });
                });
        

        $(document).ready(function() {
            var table = $('#datatable-dynamics').DataTable();

            table.on('draw', function() {
                var searchText = $('#datatable-dynamics_filter input').val().toLowerCase();

                table.rows().every(function() {
                    var data = this.data();
                    for (var i = 0; i < data.length; i++) {
                        var cell = $(this.node()).children().eq(i);
                        var cellText = cell.text().toLowerCase();
                        if (cellText.includes(searchText)) {
                            var textNodes = getTextNodesIn(cell[0]);
                            textNodes.forEach(function(node) {
                                var text = node.nodeValue;
                                var highlightedText = text.replace(new RegExp(searchText, 'gi'), '<span class="highlight">$&</span>');
                                $(node).replaceWith(highlightedText);
                            });
                        } else {
                            cell.find('.highlight').contents().unwrap(); // Remove previous highlights
                        }
                    }
                });
            });

            function getTextNodesIn(node) {
                var textNodes = [];
                if (node.nodeType == 3) {
                    textNodes.push(node);
                } else {
                    var children = node.childNodes;
                    for (var i = 0; i < children.length; i++) {
                        if (children[i].nodeType == 3) {
                            textNodes.push(children[i]);
                        }
                    }
                }
                return textNodes;
            }
        });
        */
    </script>
@endpush
