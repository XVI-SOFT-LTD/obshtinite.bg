<div class="form-group">
    @if (isset($label))
        <label class="control-label col-md-3 col-sm-3 col-xs-12" @isset($id) for="{{ $id }}" @endisset>

            {{ $label }}

            @if (isset($required) && $required)
                <span class="required">*</span>
            @endif
        </label>
    @endif
    <div class="col-md-7 col-sm-7 col-xs-12">
        <select name="{{ $name }}" id="{{ $id }}" class="form-control">
            @foreach ($options as $val => $label)
                <option value="{{ $val }}" @if (isset($selected) && $val == $selected) selected @endif @if (isset($value) && $val == $value) selected @endif>{{ $label }}</option>
            @endforeach
        </select>
        @isset($hint)
            <small class="form-text text-muted">{{ $hint }}</small>
        @endisset
    </div>
</div>

@if (isset($line) && $line)
    <div class="ln_solid"></div>
@endif
