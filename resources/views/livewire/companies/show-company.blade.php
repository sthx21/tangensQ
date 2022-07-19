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
                <input type="radio" name="tabset" id="tab2" aria-controls="angebote">
                <label for="tab2">Angebote</label>
                <!-- Tab 2 -->
                <input type="radio" name="tabset" id="tab3" aria-controls="schriftverkehr">
                <label for="tab3">Aktivitäten</label>
                <input type="radio" name="tabset" id="tab4" aria-controls="emails">
                <label for="tab4">Emails</label>

                <div class="tab-panels">
                    <section id="info" class="tab-panel">
                        @include('livewire.companies.partials.show-company-main')
                    </section>
                    <section id="angebote" class="tab-panel">
                        @include('livewire.partials.show-offers')
                    </section>
                    <section id="schriftverkehr" class="tab-panel">
                        @include('livewire.partials.show-company-activities')
                    </section>
                    <section id="schriftverkehr" class="tab-panel">
{{--                        @include('livewire.partials.show-attachments')--}}
                    </section>

                </div>
            </div>

            <div class="col-md-3 col-12">
                @include('livewire.partials.show-activities')
            </div>
                </div>
                @include('livewire.companies.partials.show-company-staff')
                <div class="clearfix"></div>
                <div class="border-bottom col-9"></div>
              @include('livewire.companies.partials.show-company-clients')
        <div class="border-bottom col-12"></div>
            @include('livewire.companies.partials.show-company-workshops')
        </div>
    </div>

