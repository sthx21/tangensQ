<div class="d-flex">
<div class="dropdown-content" style="z-index: 9999">
    <div class="header">
        <h2>Ergebnisse:</h2>
    </div>
    <div class="flex">
        <div class="column">
            <h3>Produkte</h3>
            <ul>
            @foreach ($firstResults as $first)
                <li><button class="dropdown-item" wire:click="$emit('changeShopView', 'product' ,'{{$first->id}}')">{{$first->name}}</button></li>
            @endforeach
            </ul>
        </div>

        <div class="column">
            <h3>Kategorien</h3>
            <ul>
                @foreach ($secondResults as $second)
                    <li><button class="dropdown-item" wire:click="$emit('changeShopView', 'category' ,'{{$second->id}}')">{{$second->name}}</button></li>
                @endforeach
            </ul>
            <h3>Unterkategorien</h3>
            <ul>
                @foreach ($thirdResults as $third)
                    <li><button class="dropdown-item" wire:click="$emit('changeShopView', 'subCategory' ,'{{$third->id}}')">{{$third->name}}</button></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
</div>
