<div class="row pt-3 pb-3">
    <div class="col-12">
        <div class="ml-6 pb-5">
            <strong>{{ trans('companies.labels.staff') }}</strong>
        </div>

            <div class="ml-6">
                <table class="staffTable">
                    <thead>
                    <tr>
                    <th style="width: 10%">Position</th>
                    <th style="width: 10%">Anrede</th>
                    <th style="width: 10%">Vorname</th>
                    <th style="width: 10%">Nachname</th>
                    <th style="width: 10%">Telefon</th>
                    <th style="width: 30%">Email</th>
                    <th>Entfernen                        <button class="editButton" name="editButton" wire:click.prevent="update()">{{trans('companies.buttons.saveChanges')}}</button>
                    </th>
                        </tr>
                    </thead>

                @foreach($staff as $key => $val)
                    <tr>
                        <td><x-shdw-input name="staff.{{$key}}.position" label="Posiiton" wire:key="position.{{$key}}"/></td>
                        <td>
                            <x-shdw-select name="staff.{{$key}}.title" :label="trans('companies.forms.title_label')" wire:key="title.{{$key}}" >
                                <option value="{{$val->title}}">{{$val->title}}</option>
                                <option value="{{trans('companies.forms.title_mr')}}" wire:key="title.{{$key}}">{{trans('companies.forms.title_mr')}}</option>
                                <option value="{{trans('companies.forms.title_mrs')}}" wire:key="title.{{$key}}">{{trans('companies.forms.title_mrs')}}</option>
                                <option value="{{trans('companies.forms.title_div')}}" wire:key="title.{{$key}}">{{trans('companies.forms.title_div')}}</option>
                            </x-shdw-select>
                        </td>
                        <td><x-shdw-input name="staff.{{$key}}.first_name" label="Vorname" wire:key="first_name.{{$key}}"/></td>
                        <td><x-shdw-input name="staff.{{$key}}.last_name" label="Nachname" wire:key="last_name.{{$key}}"/></td>
                        <td><x-shdw-input name="staff.{{$key}}.phone" label="Telefon" wire:key="phone.{{$key}}"/></td>
                        <td><x-shdw-input name="staff.{{$key}}.email" label="Email" wire:key="email.{{$key}}"/></td>
                        <td><button class="btn btn-danger w-full" wire:click.prevent="removeStaff({{$val->id}})" wire:key="remove.{{$key}}">ENTFERNEN</button> </td>
                    </tr>
                    <tr>
                        <td></td><td></td><td></td><td></td>
                        <td><x-shdw-input name="staff.{{$key}}.second_phone" label="Telefon" wire:key="second_phone.{{$key}}"/></td>
                        <td><x-shdw-input name="staff.{{$key}}.second_email" label="Email" wire:key="second_email.{{$key}}"/></td>
                        <td></td>
                    </tr>
                    <tr class="dividerLine"></tr>
                @endforeach

                    <tr>
                        <td><x-shdw-input name="newStaff.position" label="Posiiton"/></td>
                        <td>
                            <x-shdw-select name="newStaff.title" :label="trans('companies.forms.title_label')" >
                                <option selected>{{trans('companies.forms.title_choose')}}</option>
                                <option value="{{trans('companies.forms.title_mr')}}">{{trans('companies.forms.title_mr')}}</option>
                                <option value="{{trans('companies.forms.title_mrs')}}">{{trans('companies.forms.title_mrs')}}</option>
                                <option value="{{trans('companies.forms.title_div')}}">{{trans('companies.forms.title_div')}}</option>
                            </x-shdw-select>
                        </td>
                        <td><x-shdw-input name="newStaff.first_name" label="Vorname"/></td>
                        <td><x-shdw-input name="newStaff.last_name" label="Nachname"/></td>
                        <td><x-shdw-input name="newStaff.phone" label="Telefon"/></td>
                        <td><x-shdw-input name="newStaff.email" label="Email"/></td>
                        <td><button class="btn btn-success w-full" wire:click.prevent="addStaff()">HINZUFÜGEN</button> </td>
                    </tr>
                    <tr>
                        <td></td><td></td><td></td><td></td>
                        <td><x-shdw-input name="newStaff.second_phone" label="Telefon"/></td>
                        <td><x-shdw-input name="newStaff.second_email" label="Email"/></td>
                        <td></td>
                    </tr>
                    <tr class="dividerLine"></tr>
                </table>
            </div>
    </div>
</div>
