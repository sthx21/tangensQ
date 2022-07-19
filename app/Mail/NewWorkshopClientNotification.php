<?php

namespace App\Mail;

use App\Models\Workshop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class NewWorkshopClientNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Workshop instance.
     *
     * @@param Collection $workshop
     */
    public $workshop;
    public $clients;
    public $trainer;

    /**
     * Create a new message instance.
     * @param Workshop $workshops
     *
     * @return void
     */
    public function __construct(Workshop $workshop, $clients, $trainer)
    {
        $this->workshop = $workshop;
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
        return $this->subject('Aktuelle Teilnehmerliste für den Workshop:'.' '.$this->workshop->title.' am '.$this->workshop->start_date)->view('emails.newWorkshopClient');
    }
}
