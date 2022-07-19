@props(['formAction' => false])
    <x-slot name="header">
        hhhh
    </x-slot>

<div>
    @if($formAction)
        <form wire:submit.prevent="{{ $formAction }}" class="needs-validation" novalidate>
            @endif
            <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
                @if(isset($title))
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $title }}
                    </h3>
                @endif
            </div>
            <div class="bg-white px-4 sm:p-6">
                <div>
                    {{ $content }}
                </div>
            </div>
            <div class="bg-white px-4 pb-5 sm:px-4 sm:flex">
                {{ $buttons }}
            </div>
            @if($formAction)
        </form>
    @endif
</div>

<script>

    document.addEventListener('livewire:load', function () {

        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })

</script>
