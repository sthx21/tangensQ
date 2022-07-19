@props(['value' => '', 'size' => 'w-full'])

<div class="form-floating">
        <input type="{{ $type }}"
               {{$lazy}} ="{{$name}}"
               wire:model="{{ $name }}"
               value="{{$value}}"
                class="form-control block mt-1 {{ $size }} xshdwInput" id="{{ $name }}"
               placeholder="{{ $label }}"
                wire:key="{{$key}}"
                {{$options['ro'] ?? ''}}
                {{$attributes}}
    @error($name)style="background-color: red"@enderror
    >
        <label for="{{ $name }}">{{ $label }}</label>
    @error($name) <span class="error">{{ $message }}</span> @enderror

</div>




