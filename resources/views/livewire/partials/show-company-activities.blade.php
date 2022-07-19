<div class="card">
        <div class="card-header">
            Aktivitäten
        </div>
        <div class="card-body ">

@foreach ($allActivities as $staffActivity)
                <div class="activity companyActivity">
                    <div class="activityDate pb-2 d-flex justify-content-between">
                        <div>
                            Datum: {{$staffActivity->created_at->format('d.m.y')}} <br>
                            <span style="font-weight: bold">{{$staffActivity->user->first_name}}</span>
                            mit
                             <span style="font-weight: bold">{{$staffActivity->staff->last_name ?? ''}}</span>
                        </div>
                        <div>
                            <button class="removeButtonCircle" wire:click.prevent="removeActivity({{$staffActivity->id}})">X</button>
                        </div>
                    </div>
                    <div class="dividerLine"></div>
                    <div class="activityText">
                       {{$staffActivity->description}}
                    </div>
                </div>
@endforeach
        </div>
    </div>
