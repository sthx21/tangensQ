<x-app-layout>
    <x-slot name="header">

        <div>
            <x-button-link :link="'/workshops/create'" :class="'btn-primary'" :title="trans('workshops.tooltips.new')">{{trans('workshops.buttons.new')}}</x-button-link>
            <x-button-link :link="'/workshops/'" :class="'btn-info'" :title="trans('workshops.tooltips.active')">{{trans('workshops.buttons.active')}}</x-button-link>
            <x-button-link :link="'/workshops/Beendet'" :class="'btn-success'" :title="trans('workshops.tooltips.ended')">{{ trans('workshops.buttons.endedWorkshops') }}</x-button-link>
        </div>

    </x-slot>

    <x-index-table>
        <table class="table table-striped table-sm data-table table-hover" id="workshops_table">
            <thead>
            <tr  class="border-black">
                <th>Nr.</th>
                <th>{{trans('workshops.index.title')}}</th>
                <th>{{trans('workshops.index.date')}}</th>
                <th>{{trans('workshops.index.cancelDate')}}</th>
                <th>{{trans('workshops.index.clientCount')}}</th>
                <th>{{trans('workshops.index.status')}}</th>
                <th>{{trans('workshops.index.location')}}</th>
                <th>{!! trans('workshops.index.actions') !!}</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <script type="text/javascript">

            $(document).ready(function () {
                var table = $('#workshops_table').DataTable({

                    pageLength: 25,
                    processing: true,
                    serverSide: true,
                    language: {
                        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
                    },
                    ajax: "{{ route('workshops.canceled') }}",

                    columnDefs : [
                        { "width": "5%", "targets": 0 },
                        { "width": "10%", "targets": 2 },
                        { "width": "10%", "targets": 3 },
                        { "width": "5%", "targets": 4 },
                        { "width": "5%", "targets": 5 },
                        { "width": "10%", "targets": 6 },
                        { "width": "20%", "targets": 7 },
                    ],

                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'title', name: 'title'},
                        {data: 'start_date', name: 'start_date'},
                        {data: 'cancellation_date', name: 'cancellation_date'},
                        {data: 'booked', name: 'booked',
                            render : function (data, type, row) {
                                if (data >= 10) {
                                    return '<h4><span class="badge badge-success">' +data+ '</span></h4>'

                                }
                                if(data >3 && data < 10) {
                                    return '<h4><span class="badge badge-warning">' + data + '</span></h4>'

                                }
                                else {
                                    return '<h4><span class="badge badge-danger">' + data + '</span></h4>'

                                }
                            }
                        },
                        {data: 'status', name: 'status',
                            render : function (data, type, row) {
                                if (data == 'Inaktiv') {
                                    return '<h4><span class="badge badge-primary">' +data+ '</span></h4>'

                                }
                                if(data == 'Storniert') {
                                    return '<h4><span class="badge badge-danger">' + data + '</span></h4>'

                                }
                                else {
                                    return '<h4><span class="badge badge-success">' + data + '</span></h4>'

                                }
                            }
                        },

                        {data: 'location', name: 'location'},

                        {
                            data: 'action',
                            name: 'Aktionen',

                            orderable: true,
                            searchable: true
                        },


                    ]

                });

            });
            $('#active').on( 'click', function () {
                table.columns(21).search('ACTIVE').draw();
            } );
        </script>
    </x-index-table>




</x-app-layout>

