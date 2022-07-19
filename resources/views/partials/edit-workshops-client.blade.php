
    <div class="form-group has-feedback row" >
{!! Form::label($workshop, trans('forms.edit_client_label_Workshop'), array('class' => 'col-md-3 control-label')); !!}
<div class="col-md-9">
    <div class="input-group">
        {!! Form::select($workshop, $allWorkshops, $id, array('id' => $id, 'class' => 'form-control')) !!}
    </div>
</div>
</div>



