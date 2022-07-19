<x-app-layout>
    <style>

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
    <div class="container rounded bg-gray-500 mt-2 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold"><x-shdw-input name="artist_name" label="Künstlername" type="text"/></span>
                    <span class="text-black-50">$user->email</span><span> </span></div>
            </div>
{{--CONTENT--}}
            @if($editProfile)
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><x-shdw-input name="first_name" label="Vorname" type="text"/></div>
                        <div class="col-md-6"><x-shdw-input name="last_name" label="Nachname" type="text"/></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h4>Kontakt Details :</h4>
                        </div>
                        <div class="col-md-12"><x-shdw-input name="instagram" label="Instagram" type="text"/></div>
                        <div class="col-md-12"><x-shdw-input name="facebook" label="facebook" type="text"/></div>
                        <div class="col-md-12"><x-shdw-input name="soundcloud" label="soundcloud" type="text"/></div>
                        <div class="col-md-12"><x-shdw-input name="instagram" label="Instagram" type="text"/></div>
                        <div class="col-md-12"><x-shdw-input name="instagram" label="Instagram" type="text"/></div>


                        <div class="col-md-12 mt-3">
                            <h4>Einsatzgebiete :</h4>
                        </div>
                        <div class="col-md-12"><x-shdw-input name="workArea" label="Haupt Einsatzgebiet" type="text"/></div>
                        <div class="col-md-12"><x-shdw-input name="workArea" label="Neben Einsatzgebiet" type="text"/></div>
                        <div class="col-md-12"><x-shdw-input name="workArea" label="Weiterer Einsatzgebiet" type="text"/></div>


                    </div>
                    <div class="row mt-3">
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>Edit Experience</span>

                        <span class="border px-3 p-1 add-experience" id="add"><i class="fa fa-plus"></i>&nbsp;Experience</span>
                    </div><br>
                    <div class="col-12">
                        <table class="table" id="topics">
                            <tr>
                            </tr>
                            @if (isset($profile))
                                @foreach($profile->experiences as $key => $experience)
                                    <tr id="row{{$key}}" class="dynamic-added">
                                        <td><input type="text" name="experiences[{{$key}}]" class="form-control" value="{{ $experience }}"></td>
                                        <td><button type="button" name="remove" id="{{$key}}" class="btn btn-danger btn_remove">X</button></td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>

                    </div>
                </div>
            </div>
            @else
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">{{$user->first_name}}</div>
                            <div class="col-md-6">{{$user->last_name}}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h4>Kontakt Details :</h4>
                            </div>
                            <div class="col-md-12">{{$user->instagram}}</div>
                            <div class="col-md-12">{{$user->facebook}}</div>
                            <div class="col-md-12">{{$user->soundcloud}}</div>
                            <div class="col-md-12">{{$user->instagram}}</div>
                            <div class="col-md-12">{{$user->instagram}}</div>


                            <div class="col-md-12 mt-3">
                                <h4>Einsatzgebiete :</h4>
                            </div>
                            <div class="col-md-12">{{$user->workArea}}</div>
                            <div class="col-md-12">{{$user->workArea}}</div>
                            <div class="col-md-12">{{$user->workArea}}</div>


                        </div>
                        <div class="row mt-3">
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Edit Experience</span>

                            <span class="border px-3 p-1 add-experience" id="add"><i class="fa fa-plus"></i>&nbsp;Experience</span>
                        </div><br>
                        <div class="col-12">
                            <table class="table" id="topics">
                                <tr>
                                </tr>
                                @if (isset($profile))
                                    @foreach($profile->experiences as $key => $experience)
                                        <tr id="row{{$key}}" class="dynamic-added">
                                            <td><input type="text" name="experiences[{{$key}}]" class="form-control" value="{{ $experience }}"></td>
                                            <td><button type="button" name="remove" id="{{$key}}" class="btn btn-danger btn_remove">X</button></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>

                        </div>
                    </div>
                </div>
            @endif






            {{--CONTENT--}}
        </div>
    </div>
            <script type="text/javascript">

                $(document).ready(function(){
                    var postURL = "<?php echo url('addmore'); ?>";
                    var i= "1";
                    $('#add').click(function(){
                        i++;
                        $('#topics').append(
                            '<tr id="row' +i+ '" class="dynamic-added">'
                            +
                            '<td>' +
                            '<input type="text" name="experiences['+ i +']" class="form-control name_list" />'
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
</x-app-layout>
