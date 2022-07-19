
    <div class="form-group has-feedback row" >
{!! Form::label($attachedClient, trans('forms.edit_workshop_label_attachedClient'), array('class' => 'col-md-3 boarder control-label')); !!}
<div class="col-md-9">
    <div class="input-group">
        {!! Form::select($attachedClient, $allClients, $id, array('id' => $id, 'class' => 'form-control col-md-11', 'placeholder' => '')) !!}
    </div>
</div>
</div>


