<div>

    <x-slot name="header">
        <div class="lg:px-8" id="heads">
        </div>
    </x-slot>
    <div class="flex-fill">
        <div class="row">
            <div class="col-md-9">
                @include('livewire.staff.partials.edit-staff-main')
            </div>
         <div class="col-md-3">
             @include('livewire.partials.show-activities')
         </div>
        </div>
        <div class="clearfix"></div>
        <div class="border-bottom col-12"></div>
        @include('livewire.staff.partials.edit-staff-workshops')
    </div>
    <script>
        window.addEventListener('confirmTransfer',event =>{
            Swal.fire({
                title: event.detail.title,
                text: "Dieser HR Mitarbeiter wird zum TN...",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ich bin sicher!',
                cancelButtonText: 'Whoops..'
            })
                .then((result) => {
                        if (result.value){
                        @this.call('transferToClients')
                        }
                    }

                )
        });
    </script>
</div>
