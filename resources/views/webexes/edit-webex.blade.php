<x-app-layout>
    <x-slot name="header">

    </x-slot>
    @if (count($errors) > 0)
        <div class="alert alert-danger"  style="display: none;" id="error_msg" >
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <x-index-create>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                {!! trans('webexes.editing-webex', ['name' => $webex->title, 'date' => $webex->start_date.' - '.$webex->end_date]) !!}

                                <div class="pull-right">
                                    <a href="{{ route('webex') }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('webexes.tooltips.back-webexes') }}">
                                        <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                        {{trans('webexes.buttons.cancel')}}
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! Form::open(array('route' => ['webex.update', $webex->slug], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}
                            {!! csrf_field() !!}
                            <div class="row pt-3">
                                <div class="col-6">
                                    <x-label for="title" :value="trans('webexes.edit.title')" />
                                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$webex->title}}"  autofocus />
                                </div>
                                <div class="col-6">
                                    <x-label for="additional_title" :value="trans('webexes.edit.additionalTitle')" />
                                    <x-input id="additional_title" class="block mt-1 w-full" type="text" name="additional_title" value="{{$webex->additional_title}}" />
                                </div>
                            </div>
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('additional_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="row pt-3">
                                <div class="col-6">
                                    <x-label for="detail" :value="trans('webexes.edit.detail')" />
                                    <x-textarea id="detail" class="block mt-1 w-full" name="detail" value="{{$webex->detail}}"  >
                                        {{$webex->detail}}
                                    </x-textarea>
                                </div>
                                <div class="col-6">
                                    <x-label for="topic_coreQuestions" :value="trans('forms.create_webex_label_topic_coreQuestions')" />
                                    <div class="row col-12">

                                        <div class="col-12">
                                            <table class="table table-bordered" id="topics">
                                                <tr>

                                                    <th>{{trans('webexes.edit.addTopicField')}}</th>
                                                    <th><button type="button" name="add" id="add" class="btn btn-success">+</button></th>
                                                </tr>
                                                @foreach($webex->topic_coreQuestions as $key => $topic)
                                                    <tr id="row{{$key}}" class="dynamic-added">

                                                        <td><input type="text" name="topic_coreQuestions[{{$key}}]" class="form-control" value="{{ $topic }}"></td>

                                                        <td><button type="button" name="remove" id="{{$key}}" class="btn btn-danger btn_remove">X</button></td>

                                                    </tr>
                                                @endforeach
                                            </table>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            @error('detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('topic_coreQuestions')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="row pt-3">
                                <div class="col-6">
                                    <x-label for="targets" :value="trans('webexes.edit.targets')" />
                                    <x-textarea id="targets" class="block mt-1 w-full" name="targets" value="{{$webex->targets}}" >
                                        {{$webex->targets}}
                                    </x-textarea>
                                </div>
                                @error('targets')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="col-6">
                                    <x-label for="process_flow" :value="trans('webexes.edit.processFlow')" />
                                    <x-textarea id="process_flow" class="block mt-1 w-full" name="process_flow" value="{{$webex->process_flow}}" >
                                        {{$webex->process_flow}}
                                    </x-textarea>
                                </div>
                            </div>
                            @error('process_flow')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="row pt-3">
                                <div class="col-3">
                                    <x-label for="status" :value="trans('webexes.edit.status')" />
                                    <select class="form-control" id="status" name="status">

                                        <option value="{{$webex->status ?? ''}}" selected>{{$webex->status ?? ''}}</option>
                                        <option value="Online">Online</option>
                                        <option value="Inaktiv">Inaktiv</option>
                                        <option value="Storniert">Storniert</option>


                                    </select>
                                </div>
                                <div class="col-3">
                                    {{--                                TODO Location Model plus select2 Search--}}
                                    <x-label for="location" :value="trans('webexes.edit.location')" />
                                    <x-input id="location" class="block mt-1 w-full" type="text" name="location" value="{{$webex->location}}"   />

                                    {{--                                @error('location')--}}
                                    {{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
                                    {{--                                @enderror--}}
                                </div>



                                <div class="col-3">
                                    <x-label for="misc" :value="trans('webexes.edit.misc')" />
                                    <x-input id="misc" class="block mt-1 w-full" type="text" name="misc" value="{{$webex->misc}}"  />

                                    @error('misc')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    {{--                TODO Option External Link                --}}
                                    <x-label for="misc_link" :value="trans('webexes.edit.misc_link')" />
                                    <x-input id="misc_link" class="block mt-1 w-full" type="text" name="misc_link" value="{{$webex->misc_link}}"  />

                                    @error('misc_link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row pt-3">
                                <div class="col-3">
                                    <x-label for="start_date" :value="trans('webexes.edit.startDate')" />
                                    <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" value="{{$webex->start_date}}"   />

                                    @error('start_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <x-label for="end_date" :value="trans('webexes.edit.endDate')" />
                                    <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" value="{{$webex->end_date}}"  />

                                    @error('end_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-3">
                                    <x-label for="trainer_one" :value="trans('webexes.edit.trainerOne')" />
                                    <select class="form-control" id="trainer_one" name="trainer_one">

                                        <option value="{{$webex->trainer_one->id ?? ''}}" selected>{{$webex->trainer_one->last_name ?? ''}}</option>
                                        <option value="">{{trans('webexes.edit.removeTrainer')}}</option>

                                        @foreach($webex->attachableTrainers as $id => $last_name)
                                            <option value="{{$id}}">{{$last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <x-label for="trainer_two" :value="trans('webexes.edit.trainerTwo')" />
                                    <select class="form-control" id="trainer_two" name="trainer_two">

                                        <option value="{{$webex->trainer_two->id ?? ''}}" selected>{{$webex->trainer_two->last_name ?? ''}}</option>
                                        <option value="">{{trans('webexes.edit.removeTrainer')}}</option>

                                        @foreach($webex->attachableTrainers as $id => $last_name)
                                            <option value="{{ $id  }}">{{$last_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row pb-4 pl-2">

                                <div class="col-6 pt-3">
                                    <strong>{{trans('webexes.edit.bookedClients')}}</strong>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>{{trans('webexes.labels.Clients')}}</th>
                                            <th>{{trans('webexes.labels.clientFirm')}}</th>
                                            <th>{{trans('clients.general.remove')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($webex->clients as $client)
                                            <tr>
                                                <td>{{$client->first_name}} {{$client->last_name}}</td>
                                                <td>{{$client->company->name}}</td>
                                                <td >
                                                    <input type="checkbox" value="{{$client->id}}" name="removeClients[]" title="{{$client->id}}">
                                                </td>
                                            </tr>


                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                <div class="col-6 pt-3">

                                    <select class="addClients" id="addClients" name="addClients[]" style="width: 70%">


                                    </select>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-12 d-grid gap-2">
                                    {!! Form::button(trans('forms.save-changes'),
                                    array('class' => 'btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save','type' => 'submit', 'id' => 'submit')) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-index-create>
    <script type="text/javascript">
        $('.addClients').select2({
            multiple: 'multiple',
            theme: 'bootstrap-5',
            placeholder: 'TN hinzufügen:',
            ajax: {
                url: '/getClients',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {

                    return {
                        results: $.map(data, function (item) {

                            if( item.title === undefined){
                                item.title = ', ',
                                    item.location = ' von ',
                                    item.start_date = ' '
                            };
                            return {
                                text:  item.last_name
                                    + item.title
                                    + item.first_name
                                    + item.location
                                    + item.company.name,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function(){
            var postURL = "<?php echo url('addmore'); ?>";
            var i= "<?php echo count($webex->topic_coreQuestions); ?>";
            $('#add').click(function(){
                i++;
                $('#topics').append(
                    '<tr id="row' +i+ '" class="dynamic-added">'
                    +
                    '<td>' +
                    '<input type="text" name="topic_coreQuestions['+ i +']" class="form-control name_list" />'
                    +
                    '</td>'
                    +
                    '<td>'
                    +
                    '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>' +
                    '</td>' +
                    '</tr>'
                )
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $(".print-success-msg").css('display','none');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }
        });
    </script>
    <script type="text/javascript">
        $('#detail').on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    </script>
    <script type="text/javascript">
        var has_errors = {{ count($errors) > 0 ? 'true' : 'false' }};
        if ( has_errors){
            swal.fire({
                title: '<strong>HTML <u>example</u></strong>',
                icon: 'error',
                html: jQuery('#error_msg').html(),
                showCloseButton: true,

            });

        }
    </script>
</x-app-layout>
