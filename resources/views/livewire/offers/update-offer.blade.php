<div>
        <div class="container">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {{trans('accounting.general.new')}} für
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="select" id="select" wire:model="select" value="company" checked>
                                <label class="form-check-label" for="select">
                                    Unternehmen
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="select" id="select" wire:model="select" value="privatePerson">
                                <label class="form-check-label" for="select">
                                    Privatperson
                                </label>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('accounting') }}" class="btn btn-warning btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('accounting.tooltips.backToList') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {{trans('accounting.buttons.cancel')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! csrf_field() !!}
                        @if ($select === 'company')
                            <div class="row">
                                <div class="col-6 ">
                                    <livewire:offers.companies/>
                                </div>
                                <div class="col-6">
                                    <x-shdw-input name="selectedCompany" label="Unternehmen" disabled=""/>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mainOrStaff" id="mainOrStaff" wire:model="mainOrStaff" value="main" checked>
                                        <label class="form-check-label" for="mainOrStaff">
                                            Hauptadresse
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="staff" id="mainOrStaff" wire:model="mainOrStaff" value="staff">
                                        <label class="form-check-label" for="mainOrStaff">
                                           An Mitarbeiter
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if ($mainOrStaff === 'staff')
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6">  <livewire:offers.companies/></div>
                        </div>
                            @endif
                        @endif
                        @if ($select === 'privatePerson')
                        <div class="row">
                            <div class="form-group pt-3 col-2">
                                <x-shdw-select name="invoice_recipient.title" label="">
                                    <option value="" selected>{{trans('accounting.forms.title_ph')}}</option>
                                    <option value="{{trans('clients.forms.title_mr')}}">{{trans('clients.forms.title_mr')}}</option>
                                    <option value="{{trans('clients.forms.title_mrs')}}">{{trans('clients.forms.title_mrs')}}</option>
                                    <option value="{{trans('clients.forms.title_div')}}">{{trans('clients.forms.title_div')}}</option>
                                </x-shdw-select>
                            </div>
                        <div class="form-group pt-3 col-5">
                            <x-shdw-input name="invoice_recipient.first_name" :label="trans('accounting.forms.firstName_label')"/>
                        </div>
                        <div class="form-group pt-3 col-5">
                            <x-shdw-input name="invoice_recipient.last_name" :label="trans('accounting.forms.lastName_label')"/>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group pt-3 col-2">
                                <x-shdw-input name="invoice_recipient.zip" :label="trans('accounting.forms.zip_label')"/>
                            </div>
                            <div class="form-group pt-3 col-4">
                                <x-shdw-input name="invoice_recipient.city" :label="trans('accounting.forms.city_label')"/>
                            </div>
                            <div class="form-group pt-3 col-4">
                                <x-shdw-input name="invoice_recipient.street" :label="trans('accounting.forms.street_label')"/>
                            </div>
                            <div class="pt-3 col-2">
                                <x-shdw-input name="invoice_recipient.house_number" :label="trans('accounting.forms.houseNumber_label')"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="pt-3 col-6">
                                <x-shdw-input name="invoice_recipient.email" :label="trans('accounting.forms.email_label')"/>
                            </div> <div class="pt-3 col-6">
                                <x-shdw-input name="invoice_recipient.phone" :label="trans('accounting.forms.phone_label')"/>
                            </div>
                        </div>
                            <div class="pt-3 text-left">
                                <span>Privatperson wird nach Angebotserstellung als Kunde angelegt.</span>
                            </div>
                        @endif
                        <br>
                        <br>
                        <div class="clearfix"></div>
                        <div class="border-bottom w-full"></div>
                        @for ($i = 0; $i < 4; $i++)
                        <div class="row">
                            <div class="form-group pt-3 col-1">
                                <x-shdw-input name="positions.{{$i}}.quantity" :label="trans('accounting.forms.quantity_label')"/>
                            </div>
                            <div class="form-group pt-3 col-8">
                                <x-shdw-input name="positions.{{$i}}.description" :label="trans('accounting.forms.description_label')"/>
                            </div>
                            <div class="form-group pt-3 col-1">
                                <x-shdw-input name="positions.{{$i}}.unit_price" :label="trans('accounting.forms.unit_price_label')"/>
                            </div>
                            <div class="form-group pt-3 col-2">
                                <x-shdw-input name="positions.{{$i}}.discount" :label="trans('accounting.forms.discount_label')"/>
                            </div>
                        </div>
                        @endfor
                        <div class="row">
                            <div class="col-12 pt-3">
                                <x-label for="free_text" :value="trans('accounting.forms.free_text_label')" />
                                <x-shdw-textarea name="free_text" label="trans('accounting.forms.free_text_label')" rows="10" class="w-full"/>

                            <div class="row">
                                <div class="col-12">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            {{trans('accounting.forms.direct_invoice_label')}}<x-shdw-checkbox name="invoice" label=""/>
                                            <x-shdw-input type="date" name="due_date" label="Frist" class="w-25"/>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>


                                                <td>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <div class="row pt-3">
                            <div class="col-12 d-grid gap-2">
                                <button wire:click.prevent="store()">{{trans('accounting.buttons.new')}}</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>

</div>
