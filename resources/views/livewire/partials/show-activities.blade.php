<div class="card">
        <div class="card-header">
            Aktivitäten
        </div>
        <div class="card-body ">
            <x-shdw-input name="activity.description" label="Neue Aktivität" wire:keydown.enter="addActivity()"/>
@foreach ($activities as $activity)
                <div class="activity companyActivity">
                    <div class="activityDate pb-2 d-flex justify-content-between">
                        <div>
                            Datum: {{$activity->created_at->format('d.m.y')}} <br>
                            von <span style="font-weight: bold">{{$activity->user->first_name}}</span>
                        </div>
                        <div>
                            <button class="removeButtonCircle" wire:click.prevent="removeActivity({{$activity->id}})">X</button>
                        </div>
                    </div>
                    <div class="dividerLine"></div>
                    <div class="activityText">
                       {{$activity->description}}
                    </div>
                </div>
@endforeach
        </div>
    </div>
