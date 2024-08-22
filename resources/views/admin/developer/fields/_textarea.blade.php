<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" @isset($id) for="{{ $id }}" @endisset>
        {{ $label }}
        @if (isset($required) && $required)
            <span class="required">*</span>
        @endif
    </label>
    <div class="col-md-7 col-sm-7 col-xs-12">
        @if (isset($editor) && $editor)
            <div class="tinymce" name="{{ $name }}" @isset($id) id="{{ $id }}" @endisset placeholder="{{ $label }}"
                @if (isset($required) && $required) required="required" @endif>{!! $value ?? null !!}</div>
        @else
            <textarea rows="{{ $rows ?? 5 }}" class="form-control col-md-12 col-xs-12" name="{{ $name }}" @isset($id) id="{{ $id }}" @endisset
                placeholder="{{ $label }}" @if (isset($disabled) && $disabled) disabled="{{ $disabled }}" @endif @if (isset($required) && $required) required="required" @endif>{!! $value ?? null !!}</textarea>
        @endif
        @isset($hint)
            <small class="form-text text-muted">{{ $hint }}</small>
        @endisset
    </div>
</div>

@if (isset($line) && $line)
    <div class="ln_solid"></div>
@endif
