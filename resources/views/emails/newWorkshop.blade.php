<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'jlh') }}</title>

    <link rel="stylesheet" href="{{ asset('css/sc.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">

    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fixedHeader.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/googlefontscss2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap5.css') }}" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body class="font-sans antialiased">

<div class="min-h-screen bg-gray-100">



<!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-12xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        </div>

    </header>

    <!-- Page Content -->
    <main>
        <div class="flex-fill">
            <div class="flex-row">
                <div class="flex-column col-12">
                    <div class="card">
                        <div class="card-header d-sm-flex flex-sm-row">
                            <div class="pb-sm-4">
                                <div class="default-style">Liebe/r {{$trainer->first_name}},<br>

                                Sie haben ein Training mit dem Titel: <strong>{{$workshop->title}}</strong> für tangensQ.<br><br>
                               Die Eckdaten zum Workshop :<br>
                            </div>
                            </div>

                        </div>
                        <div class="card-body pl-2">
                            <div class="row text-center text-left-tablet mb-4">
                                <div class="col-4">
                                    <h4 class="text-black margin-top-sm-1 text-center text-left-tablet">
                                        {{trans('workshops.labels.title')}}<br> {{ $workshop->title }}<br></h4>
                                    <h4 class="text-black margin-top-sm-1 text-center text-left-tablet">
                                        {{ trans('workshops.labels.additional_title') }}<br>{{$workshop->additional_title}}</h4>
                                    <p class="text-center text-left-tablet">

                                    <div class="text-center pb-3">
                                        <div class="btn-group align-content-center" role="group"
                                             aria-label="{{trans('workshops.buttons.group')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>

                                        <div><strong>{{ trans('workshops.labels.location') }}</strong></div>
                                        <div>{{ $workshop->location }}</div>

                                    </div>
                                    <div>

                                        <div><strong>{{ trans('workshops.labels.date') }}</strong></div>
                                        <div>{{$workshop->start_date->format('d.m.y'). ' - ' .$workshop->end_date->format('d.m.y')}}</div>

                                    </div>
                                    <div>

                                        <div><strong>{{ trans('workshops.labels.time') }}</strong></div>
                                        <div>{{$workshop->start_time}} - {{$workshop->end_time}}</div>

                                    </div>
                                </div>
                                <div class="col-4">

                                    <div>
                                        <strong>

                                            {{trans('workshops.index.trainer')}} <br>
                                            {{$workshop->trainer}}

                                        </strong>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row col-12 pt-3 pb-3">
                            <div class="col-6">

                                <div class="ml-6">
                                    <strong>
                                        {{ trans('workshops.labels.details') }}
                                    </strong>
                                </div>
                                <div class="ml-6">
                                    {{ $workshop->detail }}
                                </div>

                            </div>
                            <div class="col-6">

                                <div>
                                    <strong>
                                        {{ trans('workshops.labels.topicCoreQuestions') }}
                                    </strong>
                                </div>
                                <div>
                                    @if ($workshop->topic_coreQuestions)
                                        @foreach($workshop->topic_coreQuestions as  $topic)
                                            <em class="fas fa-circle fa-xs"></em>    {{$topic}}<br>
                                        @endforeach
                                    @endif

                                </div>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                        <div class="row col-12 pt-3 pb-3">
                            <div class="col-6">

                                <div class="ml-6">
                                    <strong>
                                        {{ trans('workshops.labels.targets') }}
                                    </strong>
                                </div>
                                <div class="ml-6">
                                    {{ $workshop->targets }}
                                </div>

                            </div>
                            <div class="col-6">

                                <div>
                                    <strong>
                                        {{ trans('workshops.labels.processFlow') }}
                                    </strong>
                                </div>
                                <div>
                                    {{$workshop->process_flow}}

                                </div>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                        <div class="row col-12 pt-3 pb-3">
                            <div class="col-6">

                                <div class="ml-6">
                                    <strong>
                                        {{ trans('workshops.labels.misc') }}
                                    </strong>
                                </div>
                                <div class="ml-6">
                                    {{ $workshop->misc }}
                                </div>

                            </div>
                            <div class="col-6">

                                <div>
                                    <strong>
                                        {{ trans('workshops.labels.miscLink') }}
                                    </strong>
                                </div>
                                <div>
                                    <a href="{{$workshop->misc_link}}">{{$workshop->misc_link}}</a>

                                </div>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
                        <div class="row col-12 pt-3 pb-3">





                            <div class="clearfix"></div>
                            <div class="border-bottom"></div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </main>
</div>

</body>

</html>
