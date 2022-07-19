@extends('layouts.app')

@section('template_title')
    {!! trans('workshops.editing-workshop', ['name' => $workshop->title]) !!}
@endsection

@section('template_linked_css')
    <style type="text/css">
        .btn-save,
        .pw-change-container {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('workshops.editing-workshop', ['name' => $workshop->slug]) !!}
                            <div class="pull-right">
                                <a href="{{ route('workshops') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('workshops.tooltips.back-workshops') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('workshops.buttons.back-to-workshops') !!}
                                </a>
                                <a href="{{ url('workshops/' . $workshop->slug) }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('workshops.tooltips.back-workshops') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('workshops.buttons.back-to-workshop') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['updateClients', $workshop->slug],
                        'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                        @foreach($attachedClients as $id => $attachedClient)
                                @include('partials.edit-clients-workshop')
                        @endforeach
                        @foreach($addClients as $id => $addClient)
                            @include('partials.add-clients-workshop')
                        @endforeach



                        {{--       @foreach($attachableClients as $client)
    {{--{{dd($attachableClients)}}
                            @include('partials.add-clients-workshop')
                        @endforeach

                          @foreach($workshop->newClientsCollector as $key => $newClient)

                                @include('partials.add-clients-workshop')

                            @endforeach
--}}


                            <div class="row">

                                <div class="col-12 col-sm-6">
                                    {!! Form::button(trans('forms.save-changes'),
                                    array('class' => 'btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save','type' => 'button',
                                    'data-toggle' => 'modal', 'data-target' => '#confirmSave',
                                    'data-title' => trans('modals.edit_user__modal_text_confirm_title'),
                                    'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-save')
    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
  @include('scripts.check-changed')
@endsection
