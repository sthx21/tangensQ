<?php

namespace App\Mail;

use App\Models\Workshop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class CanceledWorkshopClientNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $workshop;
    public $client;

    /**
     * Create a new message instance.
     * @param Workshop $workshop
     *
     * @return void
     */
    public function __construct(Workshop $workshop, $client)
    {
        $this->workshop = $workshop;
        $this->client = $client;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Workshop'.' '.$this->workshop->title.' '.'gecanceled')->view('emails.canceledWorkshop');
    }
}
