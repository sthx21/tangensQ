@extends('layouts.app')

@section('template_title')
    {!!trans('trainers.show-deleted-trainers')!!}

@endsection

@section('template_linked_css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .trainers-table {
            border: 0;
        }
        .trainers-table tr td:first-child {
            padding-left: 15px;
        }
        .trainers-table tr td:last-child {
            padding-right: 15px;
        }
        .trainers-table.table-responsive,
        .trainers-table.table-responsive table {
            margin-bottom: .15em;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {!!trans('trainers.show-deleted-trainers')!!}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('trainers') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('trainers.tooltips.back-trainers') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('trainers.buttons.back-to-trainers') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(count($trainers) === 0)

                            <tr>
                                <p class="text-center margin-half">
                                    {!! trans('trainers.no-records') !!}
                                </p>
                            </tr>

                        @else

                            <div class="table-responsive trainers-table">
                                <table class="table table-striped table-sm data-table">
                                    <caption id="trainer_count">
                                        {{ trans_choice('trainers.trainers-table.caption', 1, ['trainerscount' => $trainers->count()]) }}
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th class="hidden-xxs">ID</th>
                                            <th>{!!trans('trainers.trainers-table.name')!!}</th>
                                            <th class="hidden-xs hidden-sm">Email</th>
                                            <th class="hidden-xs hidden-sm hidden-md">{!!trans('trainers.trainers-table.fname')!!}</th>
                                            <th class="hidden-xs hidden-sm hidden-md">{!!trans('trainers.trainers-table.lname')!!}</th>
                                            <th class="hidden-xs hidden-sm">{!!trans('trainers.trainers-table.role')!!}</th>
                                            <th class="hidden-xs">{!!trans('trainers.labelDeletedAt')!!}</th>
                                            <th class="hidden-xs">{!!trans('trainers.labelIpDeleted')!!}</th>
                                            <th>{!!trans('trainers.trainers-table.actions')!!}</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($trainers as $trainer)
                                            <tr>
                                                <td class="hidden-xxs">{{$trainer->id}}</td>
                                                <td>{{$trainer->name}}</td>
                                                <td class="hidden-xs hidden-sm"><a href="mailto:{{ $trainer->email }}" title="email {{ $trainer->email }}">{{ $trainer->email }}</a></td>
                                                <td class="hidden-xs hidden-sm hidden-md">{{$trainer->first_name}}</td>
                                                <td class="hidden-xs hidden-sm hidden-md">{{$trainer->last_name}}</td>
                                                <td class="hidden-xs hidden-sm">
                                                    @foreach ($trainer->roles as $trainer_role)

                                                        @if ($trainer_role->name == 'trainer')
                                                            @php $labelClass = 'primary' @endphp

                                                        @elseif ($trainer_role->name == 'Admin')
                                                            @php $labelClass = 'warning' @endphp

                                                        @elseif ($trainer_role->name == 'Unverified')
                                                            @php $labelClass = 'danger' @endphp

                                                        @else
                                                            @php $labelClass = 'default' @endphp

                                                        @endif

                                                        <span class="label label-{{$labelClass}}">{{ $trainer_role->name }}</span>

                                                    @endforeach
                                                </td>
                                                <td class="hidden-xs">{{$trainer->deleted_at}}</td>
                                                <td class="hidden-xs">{{$trainer->deleted_ip_address}}</td>
                                                <td>
                                                    {!! Form::model($trainer, array('action' => array('SoftDeletesController@update', $trainer->id), 'method' => 'PUT', 'data-toggle' => 'tooltip')) !!}
                                                        {!! Form::button('<i class="fa fa-refresh" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-block btn-sm', 'type' => 'submit', 'data-toggle' => 'tooltip', 'title' => 'Restore trainer')) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('trainers/deleted/' . $trainer->id) }}" data-toggle="tooltip" title="Show trainer">
                                                        <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    {!! Form::model($trainer, array('action' => array('SoftDeletesController@destroy', $trainer->id), 'method' => 'DELETE', 'class' => 'inline', 'data-toggle' => 'tooltip', 'title' => 'Destroy trainer Record')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button('<i class="fa fa-trainer-times" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm inline','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete trainer', 'data-message' => 'Are you sure you want to delete this trainer ?')) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @if (count($trainers) > 10)
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.tooltips')

@endsection
