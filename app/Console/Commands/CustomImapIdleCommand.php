<?php
namespace App\Console\Commands;

use App\Models\Attachment;
use App\Models\Offer;
use App\Models\Staff;
use Webklex\IMAP\Commands\ImapIdleCommand;
use Webklex\PHPIMAP\Message;

class CustomImapIdleCommand extends ImapIdleCommand {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imapIdle';

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



    /**
     * Callback used for the idle command and triggered for every new received message
     * @param Message $message
     */
    public function onNewMessage(Message $message){
        $attachment = new Attachment();
        $recipient = $this->getBetween($message->to,"<", ">");
        $attachment->user_id = 88;

            $staff = Staff::whereEmail($recipient)->first();
            $attachment->text = $message->bodies;
            $attachment->save();
            $staff->attachments()->attach($attachment->id);

    }

}
