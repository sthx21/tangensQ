<div class="d-flex justify-content-end align-items-start">
    <div class="d-flex justify-content-end align-items-start">

        @if ($reminders)

@foreach ($reminders as $reminder)
    <div>
        <div class="card" onclick="Livewire.emit('openModal', 'reminders.show-reminder', {{ json_encode(["reminder" => $reminder]) }})">
            <div class="card-header showReminders" id="a">
                <span style="font-weight: bold">{{$reminder->title}}</span>
                <br>
                Fällig am :
                <span style="@if($reminder->due_date->eq( $today))color: red;@endif">
                    {{$reminder->due_date->format ('d.m.y')}}
                </span>
            </div>
            <div class="card-body showRemindersBody" id="b">

                {{$reminder->description}}
            </div>
        </div>
    </div>

@endforeach
        @endif
    </div>
</div>

