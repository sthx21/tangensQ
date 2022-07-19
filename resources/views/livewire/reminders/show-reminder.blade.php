<div>
    <div>
        <div class="card">
            <div class="card-header">
                <span style="font-weight: bold">{{$reminder->title}}</span>
                <br>
                Fällig am :
                <span>
                    {{$reminder->due_date}}
                </span>
                <button wire:click.prevent="isCompleted({{$reminder->id}})" class="completedButton">Erledigt</button>
            </div>
            <div class="card-body">
                {{$reminder->description}}
            </div>
        </div>
    </div>
</div>
