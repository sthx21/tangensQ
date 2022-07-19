<div class="col-3">
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
