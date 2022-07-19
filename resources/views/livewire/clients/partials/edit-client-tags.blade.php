
<div>

    <div class="row">
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
        <div class="col-md-6 col-12">
            @foreach ($client->tags as $tag)
                <span class="mt-1 addedTag">{{$tag['name']}}<span class="removeTag" wire:click.prevent="removeTag({{$tag['id']}})" wire:key="tag.{{$tag->id}}">X</span></span>
            @endforeach
        </div>

    </div>
        </div>


