<div>
<div class="container">
    <div class="col-lg-10 offset-lg-1">
        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="pull-right">
                        <a href="{{ route('companies') }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('companies.tooltips.backToCompanies') }}">
                            <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                            {{trans('companies.buttons.cancel')}}
                        </a>

                    </div>
                </div>
            </div>
            <div class="card-body">

                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div style="height: 300px; justify-content: center; align-content: baseline">
                            <div>
                                @if ($newLogo )
                                    <img src="{{$newLogo[0]->temporaryUrl()}}" class="imagePreview">
                                @endif
                            </div>
                        </div>
                        <x-shdw-file name="newLogo" label="Logo"/>

                    </div>
                    <div class="col-12 col-md-6">
                        <x-shdw-input name="group.name" label="Unternehmensgruppe" disabled=""/>
                        <x-shdw-input name="newCompany.name" :label="trans('companies.labels.company_name')" />
                        <div class="row">
                            <div class="col-8">
                                <x-shdw-input name="newCompany.street" :label="trans('companies.labels.street')" />
                            </div>
                      <div class="col-4">
                          <x-shdw-input name="newCompany.house_number" :label="trans('companies.labels.house_number')" />
                      </div>
                        </div>
                        <div class="row">
                        <div class="col-8">
                            <x-shdw-input name="newCompany.city" :label="trans('companies.labels.city')" />
                        </div>
                        <div class="col-4">
                            <x-shdw-input name="newCompany.zip" :label="trans('companies.labels.zip')" />
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-8">
                                <x-shdw-input name="newCompany.state" :label="trans('companies.labels.state')" />
                            </div>
                            <div class="col-4">
                                <x-shdw-input name="newCompany.country" :label="trans('companies.labels.country')" />
                            </div>
                        </div>
                        <x-shdw-input name="newCompany.additional_address" :label="trans('companies.labels.additional_address')" />
                        <x-shdw-select name="newCompany.payment_method" :label="trans('companies.forms.payment_method_label')">
                            <option value="Flatrate" selected>Flatrate</option>
                            <option value="Paket" >Paket</option>
                            <option value="Nachlass" >Nachlass</option>
                            <option value="Preisliste" >Preisliste</option>
                            <option value="ProBono" >ProBono</option>
                        </x-shdw-select>
                        <div class="col-12">
                            <div>
                                <x-shdw-input name="addGroup" label="Unternehmensgruppe hinzufügen"/>
                                <div>
                                    @if ($groups)
                                        <ul class="searchResults">
                                            <li wire:click.prevent="createGroup()" wire:key="groupNew">Neue Gruppe : {{$addGroup}}</li>
                                            @foreach($groups as $group)
                                                <li wire:click.prevent="addGroup({{$group}})">{{ $group->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <x-shdw-input name="newCompany.discount" label="Rabatt:"/>
                            </div>
                            <div class="col-md-6 col-12">
                                <x-shdw-input type="date" name="newCompany.discount_until" label="Rabatt bis:"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-md-5 col-12">
                        <x-shdw-input name="newCompany.homepage" :label="trans('companies.labels.homepage')" />
                    </div>
                    <div class="col-md-3 col-12">
                        <x-shdw-input name="newCompany.main_phone" :label="trans('companies.labels.phone')" />
                    </div>
                    <div class="col-md-4 col-12">
                        <x-shdw-input name="newCompany.main_email" :label="trans('companies.labels.email')" />
                    </div>

                </div>
                <div class="row pt-2">
                    <div class="col-md-3 col-12">
                        <x-shdw-input name="newCompany.address_origin" :label="trans('companies.labels.address_origin')" />
                    </div>
                    <div class="col-md-3 col-12">
                        <x-shdw-input name="newCompany.second_phone" :label="trans('companies.labels.second_phone')" />
                    </div>
                    <div class="col-md-3 col-12">
                        <x-shdw-input name="newCompany.second_email" :label="trans('companies.labels.second_email')" />
                    </div>
                    <div class="col-md-3 col-12">
                        <x-shdw-input name="newCompany.phone_office" :label="trans('companies.labels.phone_office')" />
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-9 col-12">
                        <x-shdw-input name="newCompany.info" :label="trans('companies.labels.info')" />
                    </div>
                    <div class="col-md-3 col-12">
                        <x-shdw-input name="newCompany.fax_number" :label="trans('companies.labels.fax_number')" />
                    </div>
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
                                @if ($results)
                                    <ul class="searchResults">
                                        <li wire:click.prevent="createTag()" wire:key="123">Neuer Tag : {{$addTag}}</li>
                                        @foreach($results as $tag)
                                            <li wire:click.prevent="addTag({{$tag}})">{{ $tag->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center align-items-center mt-4">
                    <div class="col-11">
                        <span style="font-weight: bold">{{trans('companies.labels.add_staff')}}</span>
                    </div>
                    <div class="col-1">
                        <button class="addButton"><em class="fas fa-plus" wire:click.prevent="addStaff()"></em>
                        </button>
                    </div>
                </div>
                @foreach ($staff as $key => $val)

                <div class="row">
                    <div class="col-md-3 col-12 pt-2">
                        <x-shdw-select name="staff.{{$key}}.title" :label="trans('companies.forms.title_label')" >
                            <option selected>{{trans('companies.forms.title_choose')}}</option>
                            <option value="{{trans('companies.forms.title_mr')}}">{{trans('companies.forms.title_mr')}}</option>
                            <option value="{{trans('companies.forms.title_mrs')}}">{{trans('companies.forms.title_mrs')}}</option>
                            <option value="{{trans('companies.forms.title_div')}}">{{trans('companies.forms.title_div')}}</option>
                        </x-shdw-select>
                    </div>
                    <div class="col-md-3 col-12 pt-2">
                        <x-shdw-input name="staff.{{$key}}.position" :label="trans('companies.labels.position')"/>
                    </div>
                    <div class="col-md-3 col-12 pt-2">
                        <x-shdw-input name="staff.{{$key}}.first_name" :label="trans('companies.labels.first_name')"/>
                    </div>
                    <div class="col-md-3 col-12 pt-2">
                        <x-shdw-input name="staff.{{$key}}.last_name" :label="trans('companies.labels.last_name')"/>
                    </div>
                    <div class="col-md-4 col-12 pt-2">
                        <x-shdw-input name="staff.{{$key}}.email" :label="trans('companies.labels.email')"/>
                    </div>
                    <div class="col-md-4 col-12 pt-2">
                        <x-shdw-input name="staff.{{$key}}.second_email" :label="trans('companies.labels.second_email')"/>
                    </div>
                    <div class="col-md-2 col-12 pt-2">
                        <x-shdw-input name="staff.{{$key}}.phone" :label="trans('companies.labels.phone')"/>
                    </div>
                    <div class="col-md-2 col-12 pt-2">
                        <x-shdw-input name="staff.{{$key}}.second_phone" :label="trans('companies.labels.second_phone')"/>
                    </div>
                    <div class="col-12 pt-2">
                        <x-shdw-input name="staff.{{$key}}.info" :label="trans('companies.labels.info')"/>
                    </div>
                </div>
                @endforeach

                <div class="row pt-3 col-12 d-flex">
                    <div class="d-flex justify-content-end">
                        <button class="storeButton" name="storeButton" wire:click.prevent="store()">{{trans('companies.buttons.new')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
