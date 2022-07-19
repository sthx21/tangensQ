<x-modal-user form-action="update">
    <x-slot name="title">
        <div>
            {!! trans('users.forms.editUser_label') !!}

            <a href="{{ route('users') }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{!! trans('users.tooltips.backToUsers') !!}">
                {!! trans('users.buttons.backToUsers') !!}
            </a>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="card">
            {!! csrf_field() !!}
            <x-shdw-select name="role" :label="trans('users.forms.addRole_ph')" required>
                <option value="{{ $user->roles->id }}">{{ $user->roles->name }}</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </x-shdw-select>
            <x-shdw-input type="text" name="name" :label="trans('users.forms.name_label')"/>

            {{--                                @if ($errors->has('name'))--}}
            {{--                                    <span class="help-block">--}}
            {{--                                            <strong>{{ $errors->first('name') }}</strong>--}}
            {{--                                        </span>--}}
            {{--                                @endif--}}

            <x-shdw-input type="text" name="email" :label="trans('users.forms.email_label')"/>
            <x-shdw-input type="password" name="password" :label="trans('users.forms.password_label')"/>
            <x-shdw-input type="password" name="password_confirmation" :label="trans('users.forms.password_label_confirm')"/>
        </div>
    </x-slot>
    <x-slot name="buttons">
        <div class="col-12 d-grid gap-2">
            <button type="submit" class="btn btn-success">{{trans('users.general.new')}}</button>
        </div>
    </x-slot>
</x-modal-user>
