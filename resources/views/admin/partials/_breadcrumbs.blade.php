{{-- <div class="breadcrumb">
    <a href="#">Home</a> /
    <a href="#">Page</a> /
    <span class="current-page">Current Page</span>
</div> --}}
<ul class="breadcrumb">
    <li>
        <a href="#">Начало</a>
    </li>
    @foreach ($breadcrumbs as $breadcrumb)
        <li>
            @if (isset($breadcrumb['url']))
                <a href="{{ $breadcrumb['url'] }}">{!! $breadcrumb['text'] !!}</a>
            @else
                {{ $breadcrumb['text'] }}
            @endif
        </li>
    @endforeach
</ul>
