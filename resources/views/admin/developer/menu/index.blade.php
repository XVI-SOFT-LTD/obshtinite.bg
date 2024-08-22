@extends('layouts.admin')

@section('content')
    <div class="col-md-6">
        <div class="x_panel border-0">
            <div class="x_title">
                <h2>Управление на меню</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if ($menus)
                    <div class="dd" id="nestable">
                        <ol class="dd-list">
                            @foreach ($menus as $menu)
                                <li class="dd-item dd3-item" data-id="{{ $menu->id }}" data-title="{{ $menu->title }}" data-url="{{ $menu->url }}" data-icon="{{ $menu->icon }}">
                                    <div class="dd-handle dd3-handle">Drag</div>
                                    <div class="dd3-content">
                                        <span>{{ $menu->title }}</span>
                                        <div class="item-edit"><i class="fa fa-edit"></i></div>
                                    </div>

                                    <!-- Основни настройки на елемента от менюто -->
                                    @include('admin.developer.menu.partials._menu_settings', ['item' => $menu])

                                    <!-- Второ ниво на менюто -->
                                    @if ($menu->childs && count($menu->childs) > 0)
                                        <ol class="dd-list">
                                            @foreach ($menu->childs as $child)
                                                <li class="dd-item dd3-item" data-id="{{ $child->id }}" data-title="{{ $child->title }}" data-url="{{ $child->url }}" data-icon="{{ $child->icon }}">
                                                    <div class="dd-handle dd3-handle">Drag</div>
                                                    <div class="dd3-content">
                                                        <span>{{ $child->title }}</span>
                                                        <div class="item-edit"><i class="fa fa-edit"></i></div>
                                                    </div>

                                                    <!-- Настройки на под-елемента от менюто -->
                                                    @include('admin.developer.menu.partials._menu_settings', ['item' => $child])
                                                </li>
                                            @endforeach
                                        </ol>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>

                    {{ Form::open(['route' => 'admin.developer.menu.updateMenu', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left']) }}

                    @include('admin.developer.fields._hidden', [
                        'id' => 'nestable-output',
                        'name' => 'menuOrder',
                    ])

                    @include('admin.developer.fields._submit', [
                        'label' => 'Подреди',
                        'name' => 'submit',
                    ])

                    {!! Form::close() !!}
                @else
                    <strong>Няма въведени менюта.</strong>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="x_panel border-0">
            <div class="x_title">
                <h2>Добавяне на ново меню</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                {{ Form::open(['route' => 'admin.developer.menu.store', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left']) }}

                @include('admin.developer.fields._input', [
                    'label' => 'Заглавие',
                    'name' => 'title',
                    'required' => true,
                ])

                @include('admin.developer.fields._input', [
                    'label' => 'Адрес (url)',
                    'name' => 'url',
                    'required' => true,
                ])

                @include('admin.developer.fields._input', [
                    'label' => 'Иконка',
                    'name' => 'icon',
                    'required' => false,
                ])

                @include('admin.developer.fields._submit', [
                    'label' => 'Добави',
                    'name' => 'submit',
                ])

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/nestable.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var updateOutput = function() {
                $('#nestable-output').val(JSON.stringify($('#nestable').nestable('serialize')));
            };

            $('#nestable').nestable({
                "maxDepth": 2
            }).on('change', updateOutput);

            updateOutput();

            $("body").delegate(".item-delete", "click", function(e) {
                $(this).closest(".dd-item").remove();
                updateOutput();
            });

            $("body").delegate(".item-edit", "click", function(e) {
                // Намиране на най-близкия родителски .dd-item
                var currentItem = $(this).closest('.dd-item');
                var item_setting = currentItem.find("> .item-settings").first();

                // Проверка дали .item-settings е скрит или не
                if (item_setting.hasClass("d-none")) {
                    item_setting.removeClass("d-none");

                    // Вземане на стойностите от текущия .dd-item
                    var title = currentItem.data('title');
                    var url = currentItem.data('url');
                    var icon = currentItem.data('icon');

                    // Задаване на стойностите в полетата за редакция
                    item_setting.find("input[name='title']").val(title);
                    item_setting.find("input[name='url']").val(url);
                    item_setting.find("input[name='icon']").val(icon);
                } else {
                    item_setting.addClass("d-none");
                }
            });

            $("body").delegate(".item-settings input[name='title']", "change paste keyup", function(e) {
                var titleValue = $(this).val();
                var closestDdItem = $(this).closest(".dd-item");
                closestDdItem.data("title", titleValue);
                closestDdItem.find("> .dd3-content > span").text(titleValue);
            });

            $("body").delegate(".item-settings input[name='url']", "change paste keyup", function(e) {
                var url = $(this).val();
                $(this).closest(".dd-item").data("url", url);
            });

            $("body").delegate(".item-settings input[name='icon']", "change paste keyup", function(e) {
                var icon = $(this).val();
                $(this).closest(".dd-item").data("icon", icon);
            });
        });
    </script>
    <script src="{{ asset('js/nestable.min.js') }}" type="text/javascript"></script>
@endpush
