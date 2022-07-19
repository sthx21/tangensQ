
    <div class="card mb-md-6">
        <div class="card-header">
            Aktiv
        </div>
        <div class="card-body text-left">
            @if($staff->active)
                <button class="activeButton" wire:click.prevent="toggleActive()">Aktiv</button>

            @elseif(!$staff->active)
                <button class="inactiveButton" wire:click.prevent="toggleActive()">Abwesend bis:</button>
                    <input type="date" name="inactive_date" style="color: black;"
                           wire:model="staff.inactive_date"
                           wire:key="inactive_date.{{$staff->id}}"
                           wire:keydown.enter="setInactiveDate()">

            @endif
        </div>
    </div>
