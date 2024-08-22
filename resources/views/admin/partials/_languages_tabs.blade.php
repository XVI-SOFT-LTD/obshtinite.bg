<div class="tabs" role="tabpanel" data-example-id="togglable-tabs">
    <ul class="nav nav-tabs bar_tabs" role="tablist">
        @foreach ($languages as $language)
            <li role="lang-{{ $language->code }}" class="nav-item {{ $loop->index == 0 ? 'active' : '' }}">
                <a href="#lang-{{ $language->id }}" role="tab" data-toggle="tab" aria-expanded="true">
                    <img src="{{ asset('flags/' . $language->code . '.png') }}" /> {{ $language->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<div class="tab-content">
    @foreach ($languages as $language)
        <div role="tabpanel" class="tab-pane fade {{ $loop->index == 0 ? 'active in' : '' }}" id="lang-{{ $language->id }}" aria-labelledby="lang-{{ $language->id }}">
            @include($path, ['language' => $language])
        </div>
    @endforeach
</div>
