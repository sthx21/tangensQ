<div class="row col-12 pt-3 pb-3">
    <div class="col-9">
        <div class="ml-6"><strong>{{ trans('companies.labels.staff') }}</strong></div>
        @if (count($staff) > 0)
            <div class="ml-6">
                <table class="staffTable">
                    <thead>
                    <tr>
                    <th>Position</th>
                    <th>Anrede</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Telefon</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Newsletter</th>
                    <th>Optionen</th>
                        </tr>
                    </thead>
{{--                    TODO Active & Newsletter--}}
                @foreach($staff as $key => $staffMember)
                    <tr>
                        <td>{{$staffMember->position}}</td>
                        <td>{{$staffMember->title}}</td>
                        <td>{{$staffMember->first_name}}</td>
                        <td>{{$staffMember->last_name}}</td>
                        <td>{{$staffMember->phone}}</td>
                        <td>@if ($staffMember->email)
                                {{ Html::mailto($staffMember->email, $staffMember->email) }}</td>
                        @endif
                        <td>
                            @if ($staffMember->active)
                                <button wire:click="toggleActive({{$key}})" class="buttonToggle" wire:key="active.{{$staffMember->id}}">Aktiv</button>
                            @else
                            <button wire:click.prevent="toggleActive({{$key}})" class="buttonToggled" wire:key="inactive.{{$staffMember->id}}">Inaktiv</button>
                            @endif
                          </td>
                        <td>
                            @if ($staffMember->newsletter)
                                <button wire:click.prevent="toggleNewsletter({{$key}})" class="buttonToggle" wire:key="newsletter.{{$staffMember->id}}">Ja</button>
                            @else
                                <button wire:click.prevent="toggleNewsletter({{$key}})" class="buttonToggled" wire:key="noNewsletter.{{$staffMember->id}}">Nein</button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td></td><td></td><td></td><td></td>
                        <td>{{$staffMember->phone}}</td>
                        <td>
                            @if ($staffMember->second_email)
                                {{ Html::mailto($staffMember->second_email, $staffMember->second_email) }}
                            @endif
                           </td>
                        <td>
                            @if (!$staffMember->active)
                            <input type="date" name="inactive_date"
                                   wire:model="staff.{{$key}}.inactive_date"
                                   wire:key="inactive_date.{{$staffMember->id}}"
                                   wire:keydown.enter="setInactiveDate({{$key}})">
                            @endif
                        </td>
                        <td></td>
                        <td style="display: flex; justify-content: right">

                                <a href="/staff/{{$staffMember->slug}}">
                                    <button class="detailsButton">Details</button>
                                </a>
                                <a href="/staff/{{$staffMember->slug}}/edit">
                                    <button class="editButton">Bearbeiten</button>
                                </a>


                        </td>

                    </tr>
                    <tr class="dividerLine"></tr>
                @endforeach
                </table>
            </div>
        @else
            <div class="ml-6">{{trans('companies.labels.noStaff')}}</div>
        @endif
    </div>
</div>
