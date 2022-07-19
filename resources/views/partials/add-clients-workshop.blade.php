

    <div class="form-group has-feedback row" >

{!! Form::label($addClient, trans('forms.edit_workshop_label_addClient'), array('class' => 'col-md-3 control-label')); !!}
<div class="col-md-9">

    <div class="input-group">
        {!! Form::select($addClient.$id, $attachableClients, old(), array('id' => $addClient.$id, 'class' => 'form-control col-md-11', 'placeholder' => '')) !!}





    </div>

</div>

</div>


