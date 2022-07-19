<?php

namespace App\Listeners;

use App\Models\Attachment;
use App\Models\Offer;
use Webklex\IMAP\Events\MessageNewEvent;
use Webklex\PHPIMAP\Message;


class AttachNewEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageNewEvent  $message
     * @return void
     */
    public function handle(MessageNewEvent $message)
    {
        $attachment = new Attachment();
        $attachment->text = $message->message->from;
        $attachment->user_id = 99;
        $attachment->save();
//        $offer = Offer::whereOfferNumber($message->getSubject())->get();
//        $offer->attachments()->attach($attachment->id);
        // Access the order using $event->order...
    }
}
