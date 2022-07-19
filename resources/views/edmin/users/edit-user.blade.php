<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <x-index-create>
        <div class="flex-fill">
            <div class="flex-row">
                <div class="flex-column col-12">
                    <div class="card">

                        <div class="card-header   d-sm-flex flex-sm-row">
                            {{--                        <div style="display: flex; justify-content: space-between; align-items: center;">--}}
                            <div class="pb-sm-4">
                                {!! trans('users.editingUser', ['name' => $user->name]) !!}
                            </div>
                            {{--                            <div class="pull-right">--}}
                            <div class="ml-auto">
                                <div class=" btn-group">
                                    <a href="{{ route('users') }}" class="btn btn-info btn-sm"
                                       title="{{ trans('users.tooltips.backToUsers') }}">
                                        {!! trans('users.buttons.backToUsers') !!}
                                    </a>
                                    <a href="{{ url('clients/'. $user->id) }}" class="btn btn-info btn-sm"
                                       title="{{ trans('users.tooltips.backToUser') }}">
                                        {!! trans('users.buttons.backToUser') !!}
                                    </a>

                                </div>
                            </div>
                        </div>

                        <div class="card-body pl-2">
                            {!! Form::open(array('route' => ['users.update', $user->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}
                            <div class="row align-content-center pb-4 pl-2">
                                <div class="col-3">
                                    <x-label for="roles" :value="trans('forms.edit_client_label_change_company')"/>
                                    <select class="form-control text-center w-full" id="roles" name="roles">

                                        <option value="" class="align-content-center" selected>{{$user->roles[0]['name'] ?? ''}}</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" class="align-content-center">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row pb-4 pl-2 ">




                                <div class="col-3">
                                    <x-label for="name" :value="trans('clients.labels.lastName')"/>

                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                             value="{{$user->name}}"  autofocus/>
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="col-4">
                                    <x-label for="email" :value="trans('clients.labels.email')"/>

                                    <x-input id="email" class="block mt-1 w-full" type="text" name="email"
                                             value="{{$user->email}}" autofocus/>

                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row pb-4 pl-2">


                            </div>
                            <div class="row pb-4 pl-8 pr-8 pt-4">
                                <div class="d-grid">
                                    @can('edit users')
                                        {!! Form::button(trans('clients.buttons.saveChanges'), array('class' => 'btn btn-success btn-block margin-bottom-1 mt-3 mb-2 ','type' => 'submit')) !!}
                                    @endcan
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </x-index-create>
</x-app-layout>
