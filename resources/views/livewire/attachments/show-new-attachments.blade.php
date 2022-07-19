<div>
    <div>
        <div class="card">
            <div class="card-header">
                @if ($status)
                    <span>Connected..</span>
                    <blockquote>
                    </blockquote>
                @endif
            </div>
            <div class="card-body">
                @foreach($messages as  $message)
                    Von: {{$message->from}} An: {{$message->to}} <br>
                    Subject: {{$message->subject->first()}}<br>
                    @foreach($message->bodies as $type => $body)
                        <span> {{$type}}:</span><br>
                        <blockquote>
                            {{$body}}
                        </blockquote>
                    @endforeach
                    --------------------<br>
                @endforeach
                <br>
                <br>
            </div>
        </div>
    </div>
</div>

