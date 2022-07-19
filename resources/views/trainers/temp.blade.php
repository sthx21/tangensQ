{{--                    Series Trainer Select--}}
<div class="row pt-3 pl-3 pr-3">
    <div class="col-3">
        <div class="form-group">
            <x-label for="trainer_one" :value="__('forms.create_workshop_ph_trainer_one')" />
            <select class="form-control" id="trainer_one" name="trainer_one">
                <option selected></option>
                @foreach($trainers as $id => $trainer)
                    <option value="{{ $id  }}">{{$trainer}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group pt-3">
            <x-label for="trainer_two" :value="__('forms.create_workshop_ph_trainer_two')" />
            <select class="form-control" id="trainer_two" name="trainer_two">
                <option selected></option>
                @foreach($trainers as $id => $trainer)
                    <option value="{{ $id  }}">{{$trainer}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="col-3">
        <div class="form-group">
            <x-label for="trainer_three" :value="__('forms.create_workshop_ph_trainer_one')" />
            <select class="form-control" id="trainer_three" name="trainer_three">
                <option selected></option>
                @foreach($trainers as $id => $trainer)
                    <option value="{{ $id  }}">{{$trainer}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group pt-3">
            <x-label for="trainer_four" :value="__('forms.create_workshop_ph_trainer_two')" />
            <select class="form-control" id="trainer_four" name="trainer_four">
                <option selected></option>
                @foreach($trainers as $id => $trainer)
                    <option value="{{ $id  }}">{{$trainer}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="col-3">
        <div class="form-group">
            <x-label for="trainer_five" :value="__('forms.create_workshop_ph_trainer_one')" />
            <select class="form-control" id="trainer_five" name="trainer_five">
                <option selected></option>
                @foreach($trainers as $id => $trainer)
                    <option value="{{ $id  }}">{{$trainer}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group pt-3">
            <x-label for="trainer_six" :value="__('forms.create_workshop_ph_trainer_two')" />
            <select class="form-control" id="trainer_six" name="trainer_six">
                <option selected></option>
                @foreach($trainers as $id => $trainer)
                    <option value="{{ $id  }}">{{$trainer}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <x-label for="trainer_seven" :value="__('forms.create_workshop_ph_trainer_one')" />
            <select class="form-control" id="trainer_seven" name="trainer_seven">
                <option selected></option>
                @foreach($trainers as $id => $trainer)
                    <option value="{{ $id  }}">{{$trainer}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group pt-3">
            <x-label for="trainer_eight" :value="__('forms.create_workshop_ph_trainer_two')" />
            <select class="form-control" id="trainer_eight" name="trainer_eight">
                <option selected></option>
                @foreach($trainers as $id => $trainer)
                    <option value="{{ $id  }}">{{$trainer}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>


{{--                    Series Start Dates Select--}}
<div class="row pt-3  pl-3 pr-3">
    <div class="col-3">
        <div>

            <x-label for="start_dateOne" :value="__('forms.create_workshop_label_main_start_date')" />
            <x-input id="start_dateOne" class="block mt-1 w-full" type="date" name="start_dateOne" :value="old('start_dateOne')" required />

        </div>
        <div class="pt-3">
            <x-label for="end_dateOne" :value="__('forms.create_workshop_label_end_date')" />
            <x-input id="end_dateOne" class="block mt-1 w-full" type="date" name="end_dateOne" :value="old('end_dateOne')" />

        </div>
    </div>
    <div class="col-3">
        <div>
            <x-label for="start_dateTwo" :value="__('forms.create_workshop_label_start_date')" />
            <x-input id="start_dateTwo" class="block mt-1 w-full" type="date" name="start_dateTwo" :value="old('start_dateTwo')" />
        </div>
        <div class="pt-3">
            <x-label for="end_dateTwo" :value="__('forms.create_workshop_label_end_date')" />
            <x-input id="end_dateTwo" class="block mt-1 w-full" type="date" name="end_dateTwo" :value="old('end_dateTwo')" />
        </div>
    </div>
    <div class="col-3">
        <div>
            <x-label for="start_dateThree" :value="trans('forms.create_workshop_label_start_date')" />
            <x-input id="start_dateThree" class="block mt-1 w-full" type="date" name="start_dateThree" :value="old('start_dateThree')" />
        </div>
        <div class="pt-3">
            <x-label for="end_dateThree" :value="__('forms.create_workshop_label_end_date')" />
            <x-input id="end_dateThree" class="block mt-1 w-full" type="date" name="end_dateThree" :value="old('end_dateThree')" />
        </div>
    </div>
    <div class="col-3">
        <div>
            <x-label for="start_dateFour" :value="__('forms.create_workshop_label_start_date')" />
            <x-input id="start_dateFour" class="block mt-1 w-full" type="date" name="start_dateFour" :value="old('start_dateFour')" />
        </div>
        <div class="pt-3">
            <x-label for="end_dateFour" :value="__('forms.create_workshop_label_end_date')" />
            <x-input id="end_dateFour" class="block mt-1 w-full" type="date" name="end_dateFour" :value="old('end_dateFour')" />
        </div>
    </div>
</div>
<div class="row pt-3  pl-3 pr-3">
    <div class="col-3">
        <x-label for="start_timeOne" :value="trans('workshops.forms.time')" />
        <x-input id="start_timeOne" class="form-counter" type="time" name="start_timeOne" :value="old('start_timeOne')" />
        <x-input id="end_timeOne" class="form-counter" type="time" name="end_timeOne" :value="old('end_timeOne')" />
    </div>
    <div class="col-3">
        <x-label for="start_timeTwo" :value="trans('workshops.forms.time')" />
        <x-input id="start_timeTwo" class="form-counter" type="time" name="start_timeTwo" :value="old('start_timeTwo')" />
        <x-input id="end_timeTwo" class="form-counter" type="time" name="end_timeTwo" :value="old('end_timeTwo')" />
    </div>
    <div class="col-3">
        <x-label for="start_timeThree" :value="trans('workshops.forms.time')" />
        <x-input id="start_timeThree" class="form-counter" type="time" name="start_timeThree" :value="old('start_timeThree')" />
        <x-input id="end_timeThree" class="form-counter" type="time" name="end_timeThree" :value="old('end_timeThree')" />
    </div>
    <div class="col-3">
        <x-label for="start_timeFour" :value="trans('workshops.forms.time')" />
        <x-input id="start_timeFour" class="form-counter" type="time" name="start_timeFour" :value="old('start_timeFour')" />
        <x-input id="end_timeFour" class="form-counter" type="time" name="end_timeFour" :value="old('end_timeFour')" />
    </div>


</div>
{{--                    Series Location Select--}}
<div class="row pt-3  pl-3 pr-3">
    <div class="col-3">
        <x-label for="locationOne" :value="__('forms.create_workshop_label_location')" />
        <x-input id="locationOne" class="block mt-1 w-full" type="text" name="locationOne" :value="old('locationOne')" />
    </div>
    <div class="col-3">
        <x-label for="locationTwo" :value="__('forms.create_workshop_label_location')" />
        <x-input id="locationTwo" class="block mt-1 w-full" type="text" name="locationTwo" :value="old('locationTwo')" />
    </div>
    <div class="col-3">
        <x-label for="locationThree" :value="__('forms.create_workshop_label_location')" />
        <x-input id="locationThree" class="block mt-1 w-full" type="text" name="locationThree" :value="old('locationThree')" />
    </div>
    <div class="col-3">
        <x-label for="locationFour" :value="__('forms.create_workshop_label_location')" />
        <x-input id="locationFour" class="block mt-1 w-full" type="text" name="locationFour" :value="old('locationFour')" />
    </div>
    @error('locationTwo')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('locationOne')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('locationThree')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('locationFour')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
{{--                    Series Cancellation  Dates--}}
<div class="row col-12 pt-3  pl-3 pr-3">
    <div class="col-3">
        <div class="form-group">
            <x-label for="cancel_days_one" :value="__('forms.create_workshop_label_cancel_days')" />
            <select class="form-control" id="cancel_days_one" name="cancel_days_one">
                <option value="56">56 Tage</option>
                <option value="42">42 Tage</option>
                <option value="28">28 Tage</option>
                <option value="14">14 Tage</option>
                <option value="7" selected>7 Tage</option>
                <option value="112">112 Tage</option>
                <option value="84">84 Tage</option>
            </select>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <x-label for="cancel_days_two" :value="__('forms.create_workshop_label_cancel_days')" />
            <select class="form-control" id="cancel_days_two" name="cancel_days_two">
                <option value="56">56 Tage</option>
                <option value="42">42 Tage</option>
                <option value="28">28 Tage</option>
                <option value="14">14 Tage</option>
                <option value="7" selected>7 Tage</option>
                <option value="112">112 Tage</option>
                <option value="84">84 Tage</option>
            </select>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <x-label for="cancel_days_three" :value="__('forms.create_workshop_label_cancel_days')" />
            <select class="form-control" id="cancel_days_three" name="cancel_days_three">
                <option value="56">56 Tage</option>
                <option value="42">42 Tage</option>
                <option value="28">28 Tage</option>
                <option value="14">14 Tage</option>
                <option value="7" selected>7 Tage</option>
                <option value="112">112 Tage</option>
                <option value="84">84 Tage</option>
            </select>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <x-label for="cancel_days_four" :value="__('forms.create_workshop_label_cancel_days')" />
            <select class="form-control" id="cancel_days_four" name="cancel_days_four">
                <option value="56">56 Tage</option>
                <option value="42">42 Tage</option>
                <option value="28">28 Tage</option>
                <option value="14">14 Tage</option>
                <option value="7" selected>7 Tage</option>
                <option value="112">112 Tage</option>
                <option value="84">84 Tage</option>
            </select>
        </div>
    </div>
</div>
