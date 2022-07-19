<div>
    <x-slot name="header">
         <div class="lg:px-8" id="heads">
        </div>
    </x-slot>
    <div class="flex-fill">
        <div class="row">
            @include('livewire.trainers.partials.show-trainer-main')
            <div class="col-md-3 col-12">
                @include('livewire.partials.show-activities')
            </div>
        </div>
                <div class="clearfix"></div>
                <div class="border-bottom col-9"></div>
        <div class="border-bottom col-12"></div>
            @include('livewire.trainers.partials.show-trainer-workshops')
        </div>
    </div>

