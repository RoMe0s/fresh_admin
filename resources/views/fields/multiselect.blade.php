<div class="form-group form-element-selecst {{ $errors->has(rtrim($name, "[]")) ? 'has-error' : '' }}">
    <label for="{{ $name }}" class="control-label">
        {{ $label }}

        @if($required)
            <span class="form-element-required">*</span>
        @endif
    </label>

    <div>
        <select name="{{$name}}" {!! $attributes !!}>
            @foreach($options as $key => $option)
                <option value="{{$key}}" @if(in_array($key, $value)) selected @endif>{{$option}}</option>
            @endforeach
        </select>
    </div>

    @include(AdminTemplate::getViewPath('form.element.partials.helptext'))
    @include(AdminTemplate::getViewPath('form.element.partials.errors'))
</div>
