<div>
    <div class="container">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        {{trans('clients.general.newClient')}}
                        <div class="pull-right">
                            <a href="{{ route('clients') }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('clients.tooltips.backToClients') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                {{trans('companies.buttons.cancel')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! csrf_field() !!}
                    <div class="row">
                            <div class="col-md-6 col-12">
                                   <x-shdw-input name="addedCompany.name" label="Arbeitgeber" disabled=""/>
                            </div>
                            <div class="col-md-6 col-12">
                                    <x-shdw-input name="addCompany" label="Arbeitgeber wählen"/>
                                        @if ($companies)
                                            <ul class="searchResults">
                                                @foreach($companies as $company)
                                                    <li wire:click.prevent="addCompany({{$company}})" wire:key="company.{{$company->id}}">{{ $company->name }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <x-shdw-input name="addedCompany.name" label="Workshop" disabled=""/>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-shdw-input name="addCompany" label="Workshop wählen"/>
                            @if ($companies)
                                <ul class="searchResults">
                                    @foreach($companies as $company)
                                        <li wire:click.prevent="addCompany({{$company}})" wire:key="company.{{$company->id}}">{{ $company->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group pt-3 col-12 col-md-3">
                            <x-shdw-select name="client.title" :label="trans('trainers.forms.title_label')">
                                <option selected>{{trans('clients.forms.title_choose')}}</option>
                                @foreach ($titles as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </x-shdw-select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <x-shdw-input name="client.first_name" :label="trans('trainers.forms.firstName_label')"/>
                        </div>
                        <div class="col-12 col-md-6">
                            <x-shdw-input name="client.last_name" :label="trans('trainers.forms.lastName_label')"/>
                        </div>
                    </div>
            <div class="row">
                <div class="col-12 col-md-9">
                    <x-shdw-input name="client.street" :label="trans('trainers.forms.street_label')"/>
                </div>
                <div class="col-12 col-md-3">
                    <x-shdw-input name="client.house_number" :label="trans('trainers.forms.house_number_label')"/>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <x-shdw-input name="client.zip" :label="trans('trainers.forms.zip_label')"/>
                </div>
                <div class="col-12 col-md-9">
                    <x-shdw-input name="client.city" :label="trans('trainers.forms.city_label')"/>
                </div>
            </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <x-shdw-input name="email" :label="trans('trainers.forms.email_label')"/>
                        </div>
                        <div class="col-12 col-md-6">
                            <x-shdw-input name="client.phone" :label="trans('trainers.forms.phone_label')"/>
                        </div>
                    </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <x-shdw-input name="second_email" :label="trans('trainers.forms.email_label')"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-shdw-input name="client.second_phone" :label="trans('trainers.forms.phone_label')"/>
                </div>
            </div>
                    <div>
                        <x-shdw-input name="client.info" :label="trans('trainers.forms.info_label')" class="block mt-1 w-full"/>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-control block mt-1 d-inline-flex flex-wrap" style="min-height: 55px">
                                @foreach ($addedTags as $tag)
                                    <span class="mt-1 addedTag">{{$tag['name']}}<span class="removeTag">X</span></span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div>
                                <x-shdw-input name="addTag" label="Tag hinzufügen"/>
                                <div>
                                    @if ($tags)
                                        <ul class="searchResults">
                                            <li wire:click.prevent="createTag()" wire:key="123">Neuer Tag : {{$addTag}}</li>
                                            @foreach($tags as $tag)
                                                <li wire:click.prevent="addTag({{$tag}})">{{ $tag->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3 col-12 d-flex">
                        <div class="d-flex justify-content-end">
                            <button class="storeButton" name="storeButton" wire:click.prevent="store()">{{trans('companies.buttons.new')}}</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
