<div>
    <div class="container">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        {{trans('staff.general.newStaff')}}
                        <div class="pull-right">
                            <a href="{{ route('staff') }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('staff.tooltips.backToStaff') }}">
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
                            <x-shdw-input name="addedWorkshop.name" label="Workshop" disabled=""/>
                        </div>
                        <div class="col-md-6 col-12">
                            <x-shdw-input name="addWorkshop" label="Workshop wählen"/>
                            @if ($companies)
                                <ul class="searchResults">
                                    @foreach($workshops as $workshop)
                                        <li wire:click.prevent="addWorkshop({{$workshop}})" wire:key="workshop.{{$workshop->id}}">{{ $workshop->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <x-shdw-select name="staff.title" :label="trans('staff.labels.title')">
                                <option selected>{{trans('staff.general.choose')}}</option>
                                @foreach ($titles as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </x-shdw-select>
                        </div>
                        <div class="col-12 col-md-3">
                            <x-shdw-input name="staff.department" :label="trans('staff.labels.department')"/>
                        </div>
                        <div class="col-12 col-md-3">
                            <x-shdw-input name="staff.position" :label="trans('staff.labels.position')"/>
                        </div>
                        <div class="col-12 col-md-3">
                            <x-shdw-select name="staff.lead_position" :label="trans('staff.labels.lead_position')">
                                <option selected>{{trans('staff.general.choose')}}</option>
                                    <option value="true">{{trans('trainers.general.yes')}}</option>
                                    <option value="false">{{trans('trainers.general.no')}}</option>
                            </x-shdw-select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-2">
                            <x-shdw-select name="staff.academic_title" :label="trans('staff.labels.academic_title')">
                                <option selected>{{trans('staff.general.choose')}}</option>
                                <option value="Dr.">DR.</option>
                                <option value="Prof.">Prof.</option>
                            </x-shdw-select>
                        </div>
                        <div class="col-12 col-md-4">
                            <x-shdw-input name="staff.first_name" :label="trans('staff.labels.firstName')"/>
                        </div>
                        <div class="col-12 col-md-4">
                            <x-shdw-input name="staff.last_name" :label="trans('staff.labels.lastName')"/>
                        </div>
                        <div class="col-12 col-md-2">
                            <x-shdw-select name="companyAddress" :label="trans('staff.labels.company_address')">
                                <option selected>{{trans('staff.general.choose')}}</option>
                                <option value="true">{{trans('trainers.general.yes')}}</option>
                                <option value="false">{{trans('trainers.general.no')}}</option>
                            </x-shdw-select>
                        </div>
                    </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <x-shdw-input name="staff.street" :label="trans('staff.labels.street')"/>
                </div>
                <div class="col-12 col-md-2">
                    <x-shdw-input name="staff.house_number" :label="trans('staff.labels.house_number')"/>
                </div>
                <div class="col-12 col-md-4">
                    <x-shdw-input name="staff.additional_address" :label="trans('staff.labels.additional_address')"/>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-2">
                    <x-shdw-input name="staff.zip" :label="trans('staff.labels.zip')"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-shdw-input name="staff.city" :label="trans('staff.labels.city')"/>
                </div>
                <div class="col-12 col-md-4">
                    <x-shdw-input name="staff.address_origin" :label="trans('staff.labels.address_origin')"/>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <x-shdw-select name="staff.state" :label="trans('staff.labels.state')">
                        <option selected>{{trans('staff.general.choose')}}</option>
                        @foreach ($states as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </x-shdw-select>
                </div>
                <div class="col-12 col-md-4">
                    <x-shdw-input name="staff.country" :label="trans('staff.labels.country')"/>
                </div>
                <div class="col-12 col-md-4">
                    <x-shdw-input name="staff.address_origin" :label="trans('staff.labels.address_origin')"/>
                </div>
            </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <x-shdw-input name="email" :label="trans('staff.labels.email')"/>
                        </div>
                        <div class="col-12 col-md-6">
                            <x-shdw-input name="staff.phone" :label="trans('staff.labels.phone')"/>
                        </div>
                    </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <x-shdw-input name="second_email" :label="trans('staff.labels.second_email')"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-shdw-input name="staff.second_phone" :label="trans('staff.labels.second_phone')"/>
                </div>
            </div>
                    <div>
                        <x-shdw-input name="staff.info" :label="trans('staff.labels.info')" class="block mt-1 w-full"/>
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
