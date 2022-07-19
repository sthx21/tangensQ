    <div class="card">
        <div class="card-header">
            <div class="pb-sm-4 pl-md-2">
                <h4> {!! trans('staff.labels.staff', ['name' => $staff->last_name.', '.$staff->first_name]) !!}</h4>
            </div>
            <div class="buttonMenu">
                <button class="editButton" wire:click.prevent="editStaff({{$staff}})" wire:key="edit.{{$staff->id}}">Bearbeiten</button>
                <button class="backToButton" name="backToButton" wire:click.prevent="backToStaff()">{{trans('staff.buttons.backToStaff')}}</button>
            </div>
        </div>
        <div class="card-body pl-2">
            <div class="row text-center text-left-tablet mb-4">
                <div class="col-md-3 col-12">
                    @if ($staff->hasMedia('staffLogo'))
                        <img src="{{$staff->getFirstMediaUrl('staffLogo')}}" alt="" class="center-block w-100 border-1">

                    @endif
                </div>
                <div class="col-md-3 col-12">
                    <div>
                        @if($staff->company)
                        <strong class="text-black margin-top-sm-1 text-center text-left-tablet">
                            {{trans('staff.labels.company')}}<br> </strong>
                        {{$staff->company->name}}<br>
                        {{$staff->company->additional_address}}<br>
                        {{ $staff->company->street.' '. $staff->company->house_number }}<br>
                        {{$staff->company->zip.' '.$staff->company->city}}<br><br>
                        @endif
                    </div>

                    <div>
                        <strong class="text-black margin-top-sm-1 text-center text-left-tablet"> {{trans('staff.labels.position')}}</strong><br>
                        {{$staff->position}}
                    </div>

                    <strong class="text-black margin-top-sm-1 text-center text-left-tablet">
                        {{trans('staff.labels.name')}}<br> </strong>
                    {{ $staff->first_name.' '.$staff->last_name }}<br><br>
                    <strong>{{ trans('staff.labels.address') }}<br></strong>
                    {{$staff->additional_address}}<br>
                    {{ $staff->street.' '. $staff->house_number }}<br>
                    {{$staff->zip.' '.$staff->city}}<br><br>
                    <div>
                        @if($staff->homepage)
                            <strong>{{ trans('staff.labels.homepage') }}</strong><br>
                            {!!   Html::link("//$staff->homepage", $staff->homepage) !!}<br><br>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div>
                        <strong>
                            {{ trans('staff.labels.email') }}
                        </strong>
                    </div>
                    <div>
                        {{ Html::mailto($staff->email, $staff->email) }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('staff.labels.phone') }}
                        </strong>
                    </div>
                    <div>
                        {{ $staff->phone }}<br>
                        {{ $staff->second_phone }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('staff.labels.info') }}
                        </strong>
                    </div>
                    <div>
                        {{ $staff->info }}
                    </div>
                </div>
                    <div class="col-md-3 col-12">
                    <div>
                        <strong>
                            {{ trans('staff.labels.createdAt') }}<br>
                        </strong>
                        {{ $staff->created_at }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('staff.labels.updatedAt') }}<br>
                        </strong>
                        {{ $staff->updated_at }}
                    </div>
                    <div class="mt-8">
                        <strong>
                            {{ trans('staff.labels.responsible') }}
                        </strong>
                    </div>
                    <div>
                    {{$staff->company->responsible}}
                    </div>
                </div>
            </div>
                <div class="row border-1">
                    <span style="font-weight: bold">TAGS: </span>
                    @foreach ($staff->tags as $tag)
                        <span class="mt-1 addedTag">{{$tag['name']}}</span>
                    @endforeach
                </div>
            </div>
        </div>

