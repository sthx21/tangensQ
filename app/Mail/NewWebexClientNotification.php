<?php

namespace App\Mail;

use App\Models\Webex;
use App\Models\Workshop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class NewWebexClientNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Workshop instance.
     *
     * @@param Collection $webex
     */
    public $webex;
    public $clients;
    public $trainer;

    /**
     * Create a new message instance.
     * @param Webex $webex
     *
     * @return void
     */
    public function __construct(Webex $webex, $clients, $trainer)
    {
        $this->webex = $webex;
        $this->clients = $clients;
        $this->trainer = $trainer;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Aktuelle Teilnehmerliste für das Webinar:'.' '.$this->webex->title.' am '.$this->webex->start_date)->view('emails.newWebexClient');
    }
}
