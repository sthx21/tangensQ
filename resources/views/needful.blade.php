{{-- Autoheight textarea--}}
<div class="col-6 pt-3">
    <x-label for="detail" :value="" />

    <x-textarea id="detail" class="block mt-1 w-full" name="detail" :value="old('detail')" placeholder="" />
</div>

<script type="text/javascript">
    $('#detail').on('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
</script>

{{-- Autoheight textarea--}}

{{--Add Row / Inputfield on click--}}
<div class="col-12">
    <table class="table table-bordered" id="topics">
        <tr>

            <th>{{trans('workshops.edit.addTopicField')}}</th>
            <th><button type="button" name="add" id="add" class="btn btn-success">+</button></th>
        </tr>
        @foreach($workshop->topic_coreQuestions as $key => $topic)
            <tr id="row{{$key}}" class="dynamic-added">

                <td><input type="text" name="topic_coreQuestions[{{$key}}]" class="form-control" value="{{ $topic }}"></td>

                <td><button type="button" name="remove" id="{{$key}}" class="btn btn-danger btn_remove">X</button></td>

            </tr>
        @endforeach
    </table>

</div>

<script type="text/javascript">

    $(document).ready(function(){
        var postURL = "<?php echo url('addmore'); ?>";
        var i= "<?php echo count($workshop->topic_coreQuestions); ?>";
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
Route::post("addmore",[WorkshopController::class, 'addTopicPost']);

Controller

public function addMorePost(Request $request)
{
$rules = [];
foreach($request->input('topic_coreQuestions') as $key => $value) {
$rules["topic_coreQuestions.{$key}"] = 'required';
}
$validator = Validator::make($request->all(), $rules);
if ($validator->passes()) {
foreach($request->input('topic_coreQuestions') as $key => $value) {
Workshop::create(['topic_coreQuestions'=>$value]);
}
return response()->json(['success'=>'done']);
}
return response()->json(['error'=>$validator->errors()->all()]);
}

{{--Add Row / Inputfield on click--}}
{{--Modal--}}
<button class="btn btn-sm btn-danger"
        title="{{trans('clients.tooltips.delete')}}"
        onclick="document.getElementById('modalDelete').style.display='block'">{{trans('clients.buttons.delete')}}</button>
<div id="modalDelete" class="modal">
    <span onclick="document.getElementById('modalDelete').style.display='none'" class="close" title="{{trans('modals.default.title')}}">&times;</span>
    <form class="modal-content" action="{{route('client.destroy', $client)}}" method="post">
        <div class="container">
            <h1>{{trans('clients.buttons.delete')}}</h1>
            <p>{{trans('clients.confirm.delete')}}?</p>

            <div class="clearfix">
                <x-buk-form-button :action="route('clients.show', $client)" method="get"
                                   :class="'mButton cancelbtn'" :title="'Nicht löschen'">{{trans('clients.general.no')}}
                </x-buk-form-button>
                <x-buk-form-button :action="route('client.destroy', $client)" method="delete"
                                   :class="'mButton deletebtn'" :title="'TN löschen'">{{trans('clients.general.yes')}}
                </x-buk-form-button>

            </div>
        </div>
    </form>
</div>
<script>
    // Get the modal
    var modal = document.getElementById('modalDelete');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
{{--Modal--}}
{{--Change value in Pivot Table}}
 $attributes = ['canceled' => 1];
        $this->trainer->workshops()->updateExistingPivot($toCancel['id'], $attributes);
{{PIVOT}}
