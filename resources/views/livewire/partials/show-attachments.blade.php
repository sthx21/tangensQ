<style>
.attachment{
    width: fit-content;
}
.attachment:hover{
    cursor: pointer;
}
</style>

<div class="card">
    <div class="card-header">
        <div class="pb-sm-4 pl-md-2">
            <span>Zum lesen klicken</span>
        </div>

    </div>
    <div class="card-body pl-2">
        @foreach ($attachments as $attachment)
        <div class="card attachment" onclick="Livewire.emit('openModal', 'attachments.show-attachment', {{ json_encode(["attachment" => $attachment]) }})">
            <div class="card-header">
                <div class="pb-sm-4 pl-md-2">
                    <span>{{$attachment->subject}}</span>
                </div>

            </div>
            <div class="card-body pl-2">

            </div>
        </div>
        @endforeach
    </div>
</div>
