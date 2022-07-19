<div class="col-md-3 col-12">

    <div class="card mb-md-6">
        <div class="card-header">
            Aktiv
        </div>
        <div class="card-body text-left">
            @if($trainer->active)
                <button class="activeButton" wire:click.prevent="toggleActive()">Aktiv</button>

            @elseif(!$trainer->active)
                <button class="inactiveButton" wire:click.prevent="toggleActive()">Abwesend bis: </button>
                    <input type="date" name="inactive_date" style="color: black;"
                           wire:model="trainer.inactive_date"
                           wire:key="inactive_date.{{$trainer->id}}"
                           wire:keydown.enter="setInactiveDate()">

            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Aktivitäten
        </div>
        <div class="card-body ">
            <x-shdw-input name="activity.description" label="Neue Aktivität" wire:keydown.enter="addActivity()"/>
                @foreach ($activities as $activity)
                <div class="activity companyActivity">
                    <div class="activityDate">
                        Datum: {{$activity->created_at->format('d.m.y')}} von {{$activity->user->name}}
                    </div>
                    <div class="dividerLine"></div>
                    <div class="activityText">
                       {{$activity->description}}
                    </div>
                </div>
               @endforeach

        </div>
    </div>
</div>
