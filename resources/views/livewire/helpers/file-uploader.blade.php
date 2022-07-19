<x-modal-user form-action="upload">
    <x-slot name="title">

    </x-slot>
    <x-slot name="content">
        <div class="card">
            {!! csrf_field() !!}

            <x-input type="file" name="file" wire:model="file"/>

        </div>
    </x-slot>
    <x-slot name="buttons">
        <div class="col-12 d-grid gap-2">
            <button type="submit" class="btn btn-success">Upload</button>
        </div>
    </x-slot>
</x-modal-user>
