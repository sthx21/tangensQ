<div>

    <x-slot name="header">
        <div class="lg:px-8" id="heads">
        </div>
    </x-slot>
    <div class="flex-fill">
        <div class="row">
            @include('livewire.clients.partials.edit-client-main')
        </div>
        <div class="clearfix"></div>
        <div class="border-bottom col-12"></div>
        @include('livewire.clients.partials.edit-client-workshops')
    </div>
</div>
