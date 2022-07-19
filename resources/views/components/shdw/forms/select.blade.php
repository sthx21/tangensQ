<div class="form-floating">
    <select class=" form-control block mt-1  xshdwSelect"
            name="{{ $name }}"
            id="{{ $name }}"
            wire:model="{{ $name }}"
            @error($name)style="background-color: red"@enderror
    >
        {{ $slot }}

    </select>
    <label for="{{ $name }}">{{ $label }}</label>
</div>

