<div class="col-9">
    <div class="card">
        <div class="card-header d-sm-flex flex-sm-row">
            <div class="pb-sm-4 pl-md-2">
                <h4> {!! trans('trainers.showing-trainer', ['name' => $trainer->last_name]) !!}</h4>
            </div>
            <div class="buttonMenu">
                <button class="editButton" wire:click.prevent="editTrainer({{$trainer}})" wire:key="edit.{{$trainer->id}}">Bearbeiten</button>
                <button class="backToButton" name="backToButton" wire:click.prevent="backToTrainers()">{{trans('trainers.buttons.backToTrainers')}}</button>
            </div>
        </div>
        <div class="card-body pl-2">
            <div class="row text-center text-left-tablet mb-4">
                <div class="col-3">
                    @if ($trainer->hasMedia('trainerLogo'))
                        <img src="{{$trainer->getFirstMediaUrl('trainerLogo')}}" alt="" class="center-block w-100 border-1">

                    @endif
                </div>
                <div class="col-3">
                    <strong class="text-black margin-top-sm-1 text-center text-left-tablet">
                        {{trans('trainers.labels.name')}}<br> </strong>
                    {{ $trainer->first_name.' '.$trainer->last_name }}<br><br>
                    <strong>{{ trans('trainers.labels.address') }}<br></strong>
                    {{$trainer->additional_address}}<br>
                    {{ $trainer->street.' '. $trainer->house_number }}<br>
                    {{$trainer->zip.' '.$trainer->city}}<br><br>
                    <div>
                        @if($trainer->homepage)
                            <strong>{{ trans('trainers.labels.homepage') }}</strong><br>
                            {!!   Html::link("//$trainer->homepage", $trainer->homepage) !!}<br><br>
                        @endif
                    </div>
                </div>
                <div class="col-3">
                    <div>
                        <strong>
                            {{ trans('trainers.labels.email') }}
                        </strong>
                    </div>
                    <div>
                        {{ Html::mailto($trainer->email, $trainer->email) }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('trainers.labels.phone') }}
                        </strong>
                    </div>
                    <div>
                        {{ $trainer->phone }}<br>
                        {{ $trainer->second_phone }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('trainers.labels.info') }}
                        </strong>
                    </div>
                    <div>
                        {{ $trainer->info }}
                    </div>
                </div>
                    <div class="col-3">
                    <div>
                        <strong>
                            {{ trans('trainers.labels.createdAt') }}<br>
                        </strong>
                        {{ $trainer->created_at }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('trainers.labels.updatedAt') }}<br>
                        </strong>
                        {{ $trainer->updated_at }}
                    </div>
                    <div class="mt-8">
                        <strong>
                            {{ trans('trainers.labels.responsible') }}
                        </strong>
                    </div>
                    <div>
                     TODO
                    </div>
                </div>
            </div>
            <div class="flex-row d-flex justify-content-between pb-10">
                <div>
                        {{ trans('trainers.labels.coaching_fee_per_hour') }}<br>
                    {{ $trainer->coaching_fee_per_hour }} €
                </div>
                <div>
                    {{ trans('trainers.labels.training_fee_per_day') }}<br>
                    {{ $trainer->training_fee_per_day }} €
                </div>
                <div>
                    {{ trans('trainers.labels.consulting_fee_per_day') }}<br>
                    {{ $trainer->consulting_fee_per_day }} €
                </div>
            </div>
                <div class="row border-1">
                    <span style="font-weight: bold">TAGS: </span>
                    @foreach ($trainer->tags as $tag)
                        <span class="mt-1 addedTag">{{$tag['name']}}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

