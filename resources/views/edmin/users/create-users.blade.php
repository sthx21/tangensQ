<x-app-layout>
    <x-slot name="header">

        <div>
            <x-button-link :link="'/clients'" :class="'btn-info'" :title="'Back to Clients'">Back</x-button-link>
        </div>
    </x-slot>
    <x-index-create>

    <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('users.forms.createUser_label') !!}
                            <div class="pull-right">
                                <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{!! trans('users.tooltips.backToUsers') !!}">
                                    @if(config('laravelusers.fontAwesomeEnabled'))
                                        <i class="fas fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @endif
                                    {!! trans('users.buttons.backToUsersbuttons.back-to-users') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => 'users.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">



                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw {{trans('users.forms.userName_icon')}}" aria-hidden="true"></i></span>
                                    {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('users.forms.userName_ph'))) !!}

                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">


                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw {{trans('users.forms.email_icon')}}" aria-hidden="true"></i></span>
                                    {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('users.forms.email_ph'))) !!}

                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                            <div class="form-group has-feedback row {{ $errors->has('role') ? ' has-error ' : '' }}">

                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw {{trans('users.forms.role_icon')}}" aria-hidden="true"></i></span>
                                        <select class="custom-select form-control" name="role" id="role">
                                            <option value="">{!! trans('users.forms.addRole_ph') !!}</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach

                                        </select>

                                    </div>
                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">

                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw {{trans('users.forms.password_icon')}}" aria-hidden="true"></i></span>

                                    {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('users.forms.password_label'))) !!}

                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">

                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw {{trans('users.forms.password_icon')}}" aria-hidden="true"></i></span>

                                    {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('users.forms.password_label_confirm'))) !!}

                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="row pt-3">

                            <div class="col-12 d-grid gap-2">

                                {!! Form::button(trans('users.general.new'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                                {!! Form::close() !!}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </x-index-create>
</x-app-layout>
