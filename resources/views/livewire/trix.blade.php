<div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
{{--    <trix-editor name="trixx"></trix-editor>--}}
    <input id="{{ $trixId }}" type="hidden" name="content"  value="{{ $value }}" wire:model.lazy="trixx">
    <trix-editor wire:ignore input="{{ $trixId }}" class="trixEditor"></trix-editor>


    <script>
        var trixEditor = document.getElementById("{{ $trixId }}")

        addEventListener("trix-change", function(event) {
        @this.set('value', trixEditor.getAttribute('value'))
        })
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
</div>
