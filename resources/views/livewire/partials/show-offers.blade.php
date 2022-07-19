<div>
    <x-slot name="header">
        <div class="lg:px-8" id="heads">
        </div>
    </x-slot>
    <div class="row">
        <div class="col-md-12 col-12 w-full">
            <div class="tableTopMenu">
                <div>
                </div>
                <div class="tableTopRight">
                    <a href="{{route('createOffer')}}"><button class="createReminderButton">{{trans('accounting.offers.create')}}</button> </a>
                </div>
            </div>
            <x-index-table>
                <table class="table table-striped table-sm data-table table-hover" id="companies_table">

                    <thead>
                    <tr class="border-black">
                        <th class="tableHeader" wire:click.prevent="sorting('offer_number')">{!! trans('accounting.offers.offer_number') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('title')">{!! trans('accounting.offers.title') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('amount')">{!! trans('accounting.offers.amount') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('target_date')">{!! trans('accounting.offers.targetDate') !!}</th>
                        <th class="tableHeader" wire:click.prevent="sorting('status')">{!! trans('accounting.offers.status') !!}</th>
                        <th style="text-align: center" class="tableHeader">{!! trans('companies.index.actions') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <div>
                        @foreach ($company->offers as $offer)
                            <tr>
                                <td>{{$offer->offer_number}}</td>
                                <td>
                                    {{--                                        {{$offer->companies->first()->name}}<br>--}}
                                    {{$offer->title}}</td>
                                <td>{{$offer->amount}}</td>
                                <td>{{$offer->target_date}}</td>
                                <td>{{$offer->status}}<br>
                                    @if ($offer->confirmation_date)
                                        {{\Carbon\Carbon::create($offer->confirmation_date)->format('d.m.y')}}
                                    @endif
                                </td>
                                <td style="display: flex; justify-content: right">
                                    <a href="/Angebote/{{$offer->slug}}/edit">
                                        <button class="editButton">{{trans('accounting.buttons.edit')}}</button>
                                    </a>
                                    <a href="/Angebote/{{$offer->slug}}">
                                        <button class="detailsButton">{{trans('accounting.buttons.show')}}</button>

                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </div>
                    </tbody>
                </table>
            </x-index-table>
        </div>
    </div>
</div>
