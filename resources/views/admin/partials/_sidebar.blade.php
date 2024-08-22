<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Основни компоненти</h3>
        <ul class="nav side-menu">
            @foreach ($menus as $menu)
                @if (auth()->user()->id == 4 && $menu->id != 1)
                    @continue
                @endif
                <li>
                    <a @if (!count($menu->childs)) href="{{ asset($menu->url) }}" @endif><i class="{{ $menu->icon ?? 'fa fa-home' }}"></i> {{ $menu->title }}
                        @if ($menu->childs && count($menu->childs) > 0)
                            <span class="fa fa-chevron-down"></span>
                        @endif
                    </a>

                    @if ($menu->childs && count($menu->childs) > 0)
                        <ul class="nav child_menu">
                            @foreach ($menu->childs as $child)
                                <li><a href="{{ asset($child->url) }}">{{ $child->title }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
            @if (auth()->user()->id == 1)
                <li>&nbsp;</li>
                <li>
                    <a><i class="fa fa-cog"></i> Developer Настройки <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('admin.developer.menu.index') }}">Меню - Администрация</a></li>
                        <li><a href="{{ route('admin.developer.tree.index') }}">Дървовидна структура</a></li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out pull-left"></i> Изход
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>


</div>
