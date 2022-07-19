<div>

    <x-slot name="header">
         <div class="lg:px-8" id="heads">
        </div>
    </x-slot>
    <div class="flex-fill">
        <div class="row">
            @include('livewire.companies.partials.edit-company-main')
                </div>
                @include('livewire.companies.partials.edit-company-staff')
                <div class="clearfix"></div>
                <div class="border-bottom col-9"></div>
        </div>
    </div>

