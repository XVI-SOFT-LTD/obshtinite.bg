<nav class="relative w-full flex-between p-6 px-10">
    <h1 class="text-xl text-mainColor z-10">Общините в България</h1>
    <ul class="hidden lg:flex lg:items-center gap-10 text-lg z-10">
        <li><a href="{{ route('homepage') }}">Начало</a></li>
        <li><a href="{{ route('area.index') }}">Области</a></li>
        <li><a href="#">Новини</a></li>
        <li><a href="#">Партии</a></li>
        <li><a href="#">Забележителности</a></li>
    </ul>

    <img src="{{ config('app.paths.img') }}/icons/search-icon.png" class="z-10" />

    <img src="{{ config('app.paths.img') }}/navbar.png" class="h-[100px] absolute right-0 top-0 z-[3]" />
    <img src="{{ config('app.paths.img') }}/navbar-r.png" class="w-3/4 h-[100px] absolute left-0 top-0 z-[2]" />
</nav>
