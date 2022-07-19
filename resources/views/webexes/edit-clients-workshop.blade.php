<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('workshops.showing-all-workshops') }}
        </h2>
        <div>
            <x-button-link :link="'/workshops'" :class="'btn-info'" :title="'Back to Workshops'">Back</x-button-link>
        </div>
    </x-slot>
    <x-index-create>
{{--TODO change to add/remove clientsss one page per--}}

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! __('workshops.editing-workshop', ['name' => $workshop->title , 'date' => $workshop->start_date]) !!}

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






                            <div class="row pt-3">

                                <div class="col-12 d-grid gap-2">
                                    {!! Form::button(trans('forms.save-changes'),
                                    array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit')) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>


    </x-index-create>

</x-app-layout>
