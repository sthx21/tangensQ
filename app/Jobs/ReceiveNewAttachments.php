<?php

namespace App\Jobs;

use App\Models\Attachment;
use App\Models\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Webklex\IMAP\Events\MessageNewEvent;
use Webklex\PHPIMAP\Message;


class ReceiveNewAttachments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(MessageNewEvent $newMess)
    {
        $attachment = new Attachment();
        $attachment->text = $this->message;
        $attachment->save();
//        $recipient = $this->getBetween($message->to,"<", ">");
//        $attachment->text = $message->bodies['text'];
//        $attachment->user_id = 88;
//        $attachment->save();
//
//        $staff = Staff::whereEmail($recipient)->first();
//        $attachment->text = $staff;
//        $attachment->save();
//        $staff->attachments()->attach($attachment->id);
    }

    /**
     * Holds the account information
     *
     * @var string|array $account
     */
    protected $account = "default";

    public function getBetween($string, $start = "", $end = ""){
        if (strpos($string, $start)) { // required if $start not exist in $string
            $startCharCount = strpos($string, $start) + strlen($start);
            $firstSubStr = substr($string, $startCharCount, strlen($string));
            $endCharCount = strpos($firstSubStr, $end);
            if ($endCharCount == 0) {
                $endCharCount = strlen($firstSubStr);
            }
            return substr($firstSubStr, 0, $endCharCount);
        } else {
            return '';
        }
    }
}
