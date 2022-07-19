<div>

{{--    <trix-editor name="trixx"></trix-editor>--}}
    <input id="{{ $trixId }}" type="hidden" name="content"  value="{{ $value }}" wire:model="trixx">
    <trix-editor input="{{ $trixId }}" class="trixEditor" wire:ignore></trix-editor>


    <script>
        var trixEditor = document.getElementById("{{ $trixId }}")

        addEventListener("trix-change", function(event) {
        @this.set('value', trixEditor.getAttribute('value'))
        })
    </script>
</div>
