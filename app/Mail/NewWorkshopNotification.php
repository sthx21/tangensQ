<?php

namespace App\Mail;

use App\Models\Trainer;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class NewWorkshopNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Workshop instance.
     *
     * @@param Collection $workshop
     */
    public $workshop;
    public $trainer;
    public $today;

    /**
     * Create a new message instance.
     * @param Workshop $workshops
     *
     * @return void
     */
    public function __construct(Workshop $workshop, $trainer)
    {
        $this->workshop = $workshop;
        $this->trainer = $trainer;
        $this->today = Carbon::today();

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->workshop->start_date = createDate($this->workshop->start_date);
        $this->workshop->end_date = createDate($this->workshop->end_date);
        $this->workshop->cancellation_date = createDate($this->workshop->cancellation_date);
        return $this->subject('Neuer tangensQ Workshop')->view('emails.newWorkshop');
    }
}
