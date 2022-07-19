

    <div class="form-group has-feedback row" >

{!! Form::label($client, trans('forms.edit_workshop_label_addClient'), array('class' => 'col-md-3 control-label')); !!}
<div class="col-md-9">

    <div class="input-group">
        {!! Form::select($client, $attachableClients, old(), array('id' => $client, 'class' => 'form-control', 'placeholder' => '')) !!}





    </div>

</div>

</div>


