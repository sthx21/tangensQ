<div>

    <x-slot name="header">
         <div class="lg:px-8" id="heads">
        </div>
    </x-slot>
    <div class="flex-fill">
        <div class="row">

            <div class="tabset col-md-9 col-12">
                <!-- Tab 1 -->
                <input type="radio" name="tabset" id="tab1" aria-controls="info" checked>
                <label for="tab1">Info</label>
                <!-- Tab 2 -->
                <input type="radio" name="tabset" id="tab2" aria-controls="schriftverkehr">
                <label for="tab2">Schriftverkehr</label>


                <div class="tab-panels">
                    <section id="info" class="tab-panel">
                        @include('livewire.staff.partials.show-staff-main')
                    </section>
                    <section id="schriftverkehr" class="tab-panel">
                        @include('livewire.partials.show-attachments')
                    </section>

                </div>
            </div>

            <div class="col-md-3 col-12" style="padding: 20px 0;">
            @include('livewire.staff.partials.show-staff-active')
                @include('livewire.partials.show-activities')
            </div>

                </div>
                <div class="clearfix"></div>
        <div class="mb-6 mb-md-8"></div>
            @include('livewire.staff.partials.show-staff-workshops')
        </div>
    </div>

