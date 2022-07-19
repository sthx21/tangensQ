
<div>
    <div class="card mb-md-6">
        <div class="card-header">
            Aktiv
        </div>
        <div class="card-body text-left">
            @if($trainer->active)
                <button class="activeButton" wire:click.prevent="toggleActive()">Aktiv</button>

            @elseif(!$trainer->active)
                <button class="inactiveButton" wire:click.prevent="toggleActive()">Abwesend bis:
                    <input type="date" name="inactive_date" style="color: black;"
                           wire:model="trainer.inactive_date"
                           wire:key="inactive_date.{{$trainer->id}}"
                           wire:keydown.enter="setInactiveDate()">
                </button>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body text-left">
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
            <div class="col-md-6 col-12">
                @foreach ($trainer->tags as $tag)
                    <span class="mt-1 addedTag">{{$tag['name']}}<span class="removeTag" wire:click.prevent="removeTag({{$tag['id']}})" wire:key="tag.{{$tag->id}}">X</span></span>
                @endforeach
            </div>
        </div>
    </div>
        </div>


