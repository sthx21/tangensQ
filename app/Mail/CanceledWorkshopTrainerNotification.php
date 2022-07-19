<?php

namespace App\Mail;

use App\Models\Workshop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class CanceledWorkshopTrainerNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $workshop;
    public $trainer;

    /**
     * Create a new message instance.
     * @param Workshop $workshop
     *
     * @return void
     */
    public function __construct(Workshop $workshop, $trainer)
    {
        $this->workshop = $workshop;
        $this->trainer = $trainer;

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
