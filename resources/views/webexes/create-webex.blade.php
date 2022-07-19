<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <x-index-create>

    <div class="container">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
{{trans('workshops.general.newWorkshop')}}
                            <div class="pull-right">
                                <a href="{{ route('webex') }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('workshops.tooltips.back-workshops') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {{trans('workshops.buttons.cancel')}}
                                </a>

                            </div>
                        </div>
                    </div>
                <div class="card-body">
                    <!-- Session Status -->
                    <x-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-validation-errors class="mb-4" :errors="$errors" />

                    {!! Form::open(array('route' => 'webex.store', 'method' => 'POST', 'role' => 'form', 'class' => '')) !!}
                    {!! csrf_field() !!}
                    <div class="row col-12">
                    <div class=" col-4 pt-3">
                        <x-label for="title" :value="trans('webexes.forms.title')" />

                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" placeholder="Titel" required autofocus />
                    </div>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="col-4 pt-3">
                        <x-label for="additional_title" :value="trans('webexes.forms.additionalTitle')" />

                        <x-input id="additional_title" class="block mt-1 w-full" type="text" name="additional_title" :value="old('additional_title')" placeholder="Zusatztitel" />
                    </div>
                    @error('additional_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="col-4 pt-3">
                        <x-label for="price" :value="trans('webexes.forms.price')" />

                        <x-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" placeholder="Nettopreis :" />
                    </div>
                    @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                        <div class="row col-12">
                    <div class="col-6 pt-3">
                        <x-label for="detail" :value="trans('webexes.forms.details')" />

                        <x-textarea id="detail" class="block mt-1 w-full" name="detail" :value="old('detail')" placeholder="{{trans('workshops.forms.Details')}}" />
                    </div>
                    @error('detail')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                            <div class="col-6 pt-3">
                                <x-label for="topic_coreQuestions" :value="trans('webexes.forms.topicCoreQuestions')" />

                                <div class="col-12">
                                    <table class="table table-bordered" id="topics">
                                        <tr>
                                            <th>{{trans('workshops.edit.addTopicField')}}</th>
                                            <th><button type="button" name="addTopic" id="addTopic" class="btn btn-success">+</button></th>
                                        </tr>
                                        <tr id="row0" class="dynamic-added">

                                            <td><input type="text" name="topic_coreQuestions[0]" class="form-control" value="{{ old('topic_coreQuestions[0]') }}"></td>

                                            <td><button type="button" name="remove" id="0" class="btn btn-danger btn_removeTopic">X</button></td>

                                        </tr>

                                    </table>

                                </div>

                            </div>
                            @error('topic_coreQuestions')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="row col-12">
                        <div class="col-6 pt-3">
                            <x-label for="targets" :value="trans('webexes.forms.targets')" />

                            <x-textarea id="targets" class="block mt-1 w-full" name="targets" :value="old('targets')" placeholder="{{trans('workshops.forms.Targets')}}" />
                        </div>
                        @error('targets')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-6 pt-3">
                            <x-label for="process_flow" :value="trans('webexes.forms.processFlow')" />

                            <x-textarea id="process_flow" class="block mt-1 w-full" name="process_flow" :value="old('process_flow')" placeholder="{{trans('forms.create_workshop_ph_topic_coreQuestions')}} {{(trans('forms.create_workshop_ph_two_topic_coreQuestions'))}}" />
                        </div>
                        @error('process_flow')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row col-12">
                        <div class="col-6 pt-3">
                            <x-label for="misc" :value="trans('webexes.forms.misc')" />

                            <x-textarea id="misc" class="block mt-1 w-full" name="misc" :value="old('misc')" placeholder="{{trans('workshops.forms.Misc')}}" />
                        </div>
                        @error('misc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-6 pt-3">
                            <div>
                            <x-label for="misc_link" :value="trans('webexes.forms.miscLink')" />

                            <x-input id="misc_link" class="block mt-1 w-full" type="text" name="misc_link" :value="old('misc_link')" placeholder="{{trans('workshops.forms.MiscLink')}}" />
                        </div>
                        @error('misc_link')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                                <div>
                                    <x-label for="location" :value="trans('webexes.forms.location')" />
                                    <x-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" />
                                </div>

                                @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                        </div>
                    </div>
                </div>
{{--                    Trainer Select--}}
                    <div class="row pt-3 pl-3 pr-3">
                        <div class="col-3">
                        <x-label for="trainer" :value="trans('webexes.forms.trainer')" />
                        <select class="form-control" id="trainer" name="trainer">
                            <option selected></option>
                            @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id  }}">{{$trainer->last_name}}</option>
                            @endforeach
                        </select>
                        </div>

                    {{--                     Start Date And Time Select--}}
                        <div class="col-3">
                    <x-label for="start_date" :value="trans('webexes.forms.startDate')" />
                    <x-input id="start_date" class="block mt-1 w-full form-control" type="date" name="start_date" :value="old('start_date')"  />
                        </div>

                            <div class="col-3">
                                <x-label for="start_time" :value="trans('webexes.forms.time')" />
                                <x-input id="start_time" class="form-counter" type="time" name="start_time" :value="old('start_time')" />
                                <x-input id="end_time" class="form-counter" type="time" name="end_time" :value="old('end_time')" />
                            </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="border-bottom"></div>
                    <div><br>Zusätzliche Einstellungen / Nur Ändern wenn wirklich benötigt!</div>
                    <div class="clearfix"></div>
                    <div class="border-bottom"></div>
                    <div class="row pt-3 pl-3 pr-3">
                        <div class="col-3">
                            <x-label for="password" :value="'password (min. 4 / max. 16)'" />
                            <x-input id="password" class="block mt-1 w-full" type="text" name="password" :value="old('password')" />
                        </div>
                        <div class="col-3">
                            <x-label for="chatroom" :value="'chatroom'" />
                            <select class="form-control" id="chatroom" name="chatroom">
                                <option value="1" selected>Chatroom 1</option>
                                <option value="2">Chatroom 2</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <x-label for="enabledAutoRecordMeeting" :value="'enabledAutoRecordMeeting'" />
                            <select class="form-control" id="enabledAutoRecordMeeting" name="enabledAutoRecordMeeting" :value="old('enabledAutoRecordMeeting')">
                                <option value="true" selected>Ja</option>
                                    <option value="false">Nein</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <x-label for="sendEmail" :value="'sendEmail'" />
                            <select class="form-control" id="sendEmail" name="sendEmail">
                                <option value="true" selected>Ja</option>
                                <option value="false">Nein</option>
                            </select>
                        </div>

                    </div>


                    <div class="row pt-3 pl-3 pr-3">
                        <div class="col-3">
                            <x-label for="excludePassword" :value="'excludePassword'" />
                            <select class="form-control" id="excludePassword" name="excludePassword">
                                <option value="true">Ja</option>
                                <option value="false" selected>Nein</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <x-label for="publicMeeting" :value="'publicMeeting'" />
                            <select class="form-control" id="publicMeeting" name="publicMeeting">
                                <option value="true">Ja</option>
                                <option value="false" selected>Nein</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <x-label for="enableAutomaticLock" :value="'enableAutomaticLock'" />
                            <select class="form-control" id="enableAutomaticLock" name="enableAutomaticLock">
                                <option value="true">Ja</option>
                                <option value="false" selected>Nein</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <x-label for="allowFirstUserToBeCoHost" :value="'allowFirstUserToBeCoHost'" />
                            <select class="form-control" id="allowFirstUserToBeCoHost" name="allowFirstUserToBeCoHost">
                                <option value="true">Ja</option>
                                <option value="false" selected>Nein</option>
                            </select>
                        </div>

                    </div>
                    <div class="row pt-3 pl-3 pr-3">
                        <div class="col-3">
                            <x-label for="allowAuthenticatedDevices" :value="'allowAuthenticatedDevices'" />
                            <select class="form-control" id="allowAuthenticatedDevices" name="allowAuthenticatedDevices">
                                <option value="true">Ja</option>
                                <option value="false" selected>Nein</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <x-label for="allowAnyUserToBeCoHost" :value="'allowAnyUserToBeCoHost'" />
                            <select class="form-control" id="allowAnyUserToBeCoHost" name="allowAnyUserToBeCoHost">
                                <option value="true">Ja</option>
                                <option value="false" selected>Nein</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <x-label for="enabledJoinBeforeHost" :value="'enabledJoinBeforeHost'" />
                            <select class="form-control" id="enabledJoinBeforeHost" name="enabledJoinBeforeHost">
                                <option value="true">Ja</option>
                                <option value="false" selected>Nein</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <x-label for="enableConnectAudioBeforeHost" :value="'enableConnectAudioBeforeHost'" />
                            <select class="form-control" id="enableConnectAudioBeforeHost" name="enableConnectAudioBeforeHost">
                                <option value="true">Ja</option>
                                <option value="false" selected>Nein</option>
                            </select>
                        </div>

                    </div>


                </div>


                    <div class="row pt-3  pl-3 pr-3 pb-2">
                        <div class="col-12 d-grid gap-2">
                            {!! Form::button(trans('forms.create_workshop_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                    </div>

                </div>
            </div>




        </x-index-create>
    <script type="text/javascript">

        $(document).ready(function(){
            {{--var postURL = "<?php echo url('addmore'); ?>";--}}
            var i= 0;
            $('#addTopic').click(function(){
                i++;
                $('#topics').append(
                    '<tr id="row' +i+ '" class="dynamic-added">'
                    +
                    '<td>'
                    +
                    '<input type="text" name="topic_coreQuestions['+ i +']" class="form-control name_list" />'
                    +
                    '</td>'
                    +
                    '<td>'
                    +
                    '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_removeTopic">X</button>' +
                    '</td>' +
                    '</tr>'
                )
            });
            $(document).on('click', '.btn_removeTopic', function(){
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
</x-app-layout>
