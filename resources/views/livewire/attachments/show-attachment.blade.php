<div>
    <div>
        <div class="card">
            <div class="card-header">
                    <table style="width: 100%" id="showAttachmentTable" aria-label="Schriftverkehr Tabelle">
                        <tr>
                            <th>Betreff:</th>
                            <th>Von:</th>
                            <th>Am:</th>
                        </tr>
                        <tr>
                            <td>{{$attachment->subject}}</td>
                            <td>{{$attachment->from}}</td>
                            <td>{{$attachment->created_at}}</td>
                        </tr>
                    </table>
                <button wire:click.prevent="attachmentIsDone()" class="completedButton">Erledigt</button>
            </div>
            <div class="card-body">
                <p>
                    {{$attachment->bodies['text'] ?? ''}}
                </p>
                <label class="accordion-wrapper">
                    <input type="checkbox" class="accordion" hidden />
                    <div class="title">
                        <strong>HTML Teil</strong>
                        <svg viewBox="0 0 256 512" width="12" title="angle-right" class="side-icon" fill="white">
                            <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" />
                        </svg>
                        <svg viewBox="0 0 320 512" height="24" title="angle-down" class="down-icon" fill="white">
                            <path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z" />
                        </svg>
                    </div>
                    <div class="content">
                        <p>   {!! $attachment->bodies['html'] ?? '' !!}
                        </p>
                    </div>
                </label>
            </div>
        </div>
    </div>
</div>
