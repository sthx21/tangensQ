
<div class="col-md-3 col-12">
{{--    <label class="accordion-wrapper">--}}
{{--        <input type="checkbox" class="accordion" hidden />--}}
{{--        <div class="title">--}}
{{--            @if ($whereIds)--}}
{{--                @foreach($whereIds as $wTag)--}}
{{--                    {{$wTag}}--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--            <strong> Erweiterte Filter</strong>--}}
{{--            <svg viewBox="0 0 256 512" width="12" title="angle-right" class="side-icon" fill="white">--}}
{{--                <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" />--}}
{{--            </svg>--}}
{{--            <svg viewBox="0 0 320 512" height="24" title="angle-down" class="down-icon" fill="white">--}}
{{--                <path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z" />--}}
{{--            </svg>--}}
{{--        </div>--}}
{{--        <div class="content">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <button wire:click.prevent="setAdvancedFilter()">Filtern</button>--}}

{{--                    <div class="advancedFilterBox">--}}
{{--                        @if ($whereTags)--}}
{{--                            @foreach($whereTags as $wTag)--}}
{{--                                {{$wTag->name}}--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body w-100">--}}
{{--                    <x-shdw-input name="whereFilter" label="Hat Tag"/>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    @if ($advancedTags)--}}
{{--                        <ul class="searchResults">--}}
{{--                            @foreach($advancedTags as $tag)--}}
{{--                                <li wire:click.prevent="setAdvancedFilterIds('where', {{$tag->id}})" wire:key="advFil{{$tag->id}}">{{ $tag->name }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <div class="advancedFilterBox"></div>--}}
{{--                </div>--}}
{{--                <div class="card-body w-100">--}}
{{--                    <x-shdw-input name="whereNotFilter" label="Hat Tag NICHT"/>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    @if ($advancedNotTags)--}}
{{--                        <ul class="searchResults">--}}
{{--                            @foreach($advancedNotTags as $tag)--}}
{{--                                <li wire:click.prevent="setAdvancedFilterIds('whereNot', {{$tag->id}})" wire:key="advNotFil{{$tag->id}}">{{ $tag->name }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </label>--}}







    <div class="showRightMenu">
     <div class="card right-menu">


            <div class="card-header">
            <span>Nach Tags filtern</span>

                <x-shdw-input name="tagFilterName" label="Tagfilter" disabled=""/>
            </div>
                <div class="card-body">
                    <div>
                        <div class="tagFilter unset" wire:click.prevent="unsetTagFilter()" wire:key="tagFilterUnset">
                            Tagfilter löschen
                        </div>
                   @foreach($assignedTags as $tag)
                       <div class="tagFilter" wire:click.prevent="setTagFilter({{$tag['id']}})" wire:key="tagFilter{{$tag['id']}}">
                       {{$tag['name']}}
                       </div>
                    @endforeach
                    </div>
            </div>
        </div>

    </div>
</div>
