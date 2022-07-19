    <div class="card">
        <div class="card-header d-sm-flex flex-sm-row">
            <div class="pb-sm-4 pl-md-2">
                <h4> {!! trans('companies.showingCompanyName', ['name' => $company->name]) !!}</h4>
            </div>
            <div class="buttonMenu">
                <button class="editButton" wire:click.prevent="editCompany({{$company}})" wire:key="edit.{{$company->id}}">Bearbeiten</button>
                <button class="backToButton" name="backToButton" wire:click.prevent="backToCompanies()">{{trans('companies.buttons.backToCompanies')}}</button>
            </div>
        </div>
        <div class="card-body pl-2">
            <div class="row text-center text-left-tablet mb-4">
                <div class="col-3">

                </div>
                <div class="col-3">
                    <strong class="text-black margin-top-sm-1 text-center text-left-tablet">
                        {{trans('companies.labels.company_name')}}<br> </strong>
                    {{ $company->name }}<br><br>
                    <strong>{{ trans('companies.labels.address') }}<br></strong>
                    {{$company->additional_address}}<br>
                    {{ $company->street.' '. $company->house_number }}<br>
                    {{$company->zip.' '.$company->city}}<br><br>
                    <strong>{{ trans('companies.labels.clients') }}</strong>
                    <div class="mb-md-4 mt-md-2">
                        @if(count($company->clients) > 0)
                            {{count($company->clients).' '.'Teilnehmer'}}
                        @elseif(count($company->clients) == 0)
                            {{trans('companies.labels.noClients')}}
                        @endif
                    </div>
                    <div>
                        @if($company->homepage)
                            <strong>{{ trans('companies.labels.homepage') }}</strong><br>
                            {!!   Html::link("//$company->homepage", $company->homepage) !!}<br><br>
                        @endif
                        @if($company->payment_method)
                            <strong>{{ trans('companies.labels.payment_method') }}</strong><br>
                            <strong> {{$company->payment_method}}</strong>
                        @endif
                    </div>
                </div>

                <div class="col-3">
                    <div>
                        <strong>
                            {{ trans('companies.labels.email') }}
                        </strong>
                    </div>
                    <div class="mb-md-4 mt-md-2">
                        @if ($company->main_email)
                            {{ Html::mailto($company->main_email, $company->main_email) }}
                        @endif
                    </div>
                    <div>
                        <strong>
                            {{ trans('companies.labels.second_email') }}
                        </strong>
                    </div>
                    <div class="mb-md-4 mt-md-2">
                        @if ($company->second_email)
                            {{ Html::mailto($company->second_email, $company->second_email) }}
                        @endif
                    </div>
                    <div>
                        <strong>
                            {{ trans('companies.labels.phone') }}
                        </strong>
                    </div>
                    <div class="mb-md-4 mt-md-2">
                        {{ $company->main_phone }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('companies.labels.second_phone') }}
                        </strong>
                    </div>
                    <div class="mb-md-4 mt-md-2">
                        {{ $company->second_phone }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('companies.labels.phone_office') }}
                        </strong>
                    </div>
                    <div class="mb-md-4 mt-md-2">
                        {{ $company->phone_office }}
                    </div>
                </div>
                <div class="col-2">
                    <div>
                        <strong>
                            {{ trans('companies.labels.group') }}
                        </strong>
                    </div>
                    <div class="mb-md-4 mt-md-2">
                        @if ($companyGroup)
                            {{$companyGroup->name}}

                        @endif

                    </div>
                    <div>
                        <strong>
                            {{ trans('companies.labels.createdAt') }}<br>
                        </strong>
                        {{ $company->created_at->format('d.m.y') }}
                    </div>
                    <div>
                        <strong>
                            {{ trans('companies.labels.updatedAt') }}<br>
                        </strong>
                        {{ $company->updated_at->format('d.m.y') }}
                    </div>
                    <div class="mt-md-8">
                        <strong>
                            {{ trans('companies.labels.responsible') }}
                        </strong>

                    </div>
                    <div class="mb-md-4 mt-md-2">
                        {{$company->managed_by}}
                    </div>
                    <div>
                        <strong>
                            {{ trans('companies.labels.discount') }}
                        </strong>
                    </div>
                    <div class="mb-md-4 mt-md-2">
                        {{ $company->discount. ' '.'%' }}<br>
                        @if ($company->discount_until)
                            {{'bis'.' '.$company->discount_until->format('d.m.y')}}
                        @endif
                    </div>
                    <div>
                        <strong>
                            {{ trans('companies.labels.group_discount') }}
                        </strong>
                    </div>
                    <div class="mb-md-4 mt-md-2">

                        @if ($companyGroup)
                            {{ $companyGroup->discount. ' '.'%' }}<br>
                        @if ($companyGroup->discount_until)
                                {{'bis'.' '.$companyGroup->discount_until->format('d.m.y')}}

                            @endif
                        @endif
                    </div>
                </div>
                <div class="row d-flex justify-content-start mb-md-4 mt-md-2">
                    <div>
                        <strong>
                            {{ trans('companies.labels.info') }}
                        </strong>
                    </div>
                    <div>
                        {{ $company->info }}
                    </div>
                </div>
                <div class="row border-1 mb-md-4 mt-md-2">
                    <span style="font-weight: bold">TAGS: </span>
                    @foreach ($company->tags as $tag)
                        <span class="mt-1 addedTag">{{$tag['name']}}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
