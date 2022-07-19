<?php

namespace App\Mail;

use App\Models\Trainer;
use App\Models\Webex;
use App\Models\Workshop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class NewWebexNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Workshop instance.
     *
     * @@param Collection $workshop
     */
    public $webex;
    public $trainer;


    /**
     * Create a new message instance.
     * @param Webex $webex
     *
     * @return void
     */
    public function __construct(Webex $webex, $trainer)
    {
        $this->webex = $webex;
        $this->trainer = $trainer;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Workshop erstellt')->view('emails.newWebex');
    }
}
