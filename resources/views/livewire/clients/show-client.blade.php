<div>
    <x-slot name="header">
         <div class="lg:px-8" id="heads">
        </div>
    </x-slot>
    <div class="flex-fill">
        <div class="row">
            @include('livewire.clients.partials.show-client-main')
            <div class="col-md-3 col-12">
                @include('livewire.partials.show-activities')
            </div>
        </div>
                <div class="clearfix"></div>
        <div class="mb-6 mb-md-8"></div>
            @include('livewire.clients.partials.show-client-workshops')
        </div>
    </div>

