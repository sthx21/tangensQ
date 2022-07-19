<?php

namespace App\Console\Commands;

use App\Models\Attachment;
use App\Models\Client;
use App\Models\Offer;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Webklex\IMAP\Facades\Client as InboundMail;

class GetAttachments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attachments:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process received attachments';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function getCleanEmail($string, $start = "", $end = ""){
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
    public function createAttachment($message)
    {
        $staffId = 0;
        $userId = 0;
        $offerId = 0;
        $clientId = 0;

        $recipient = $this->getCleanEmail($message->to,"<", ">");
        if (!$recipient){
            $recipient = 'noRecipient@susi.de';
        }
        $sender = $this->getCleanEmail($message->from,"<", ">");
        $staff = Staff::whereEmail($recipient)->first();
        if ($staff){
            $staffId = $staff->id;
        }
        $client = Client::whereEmail($recipient)->first();
        if ($client){
            $clientId = $client->id;
        }
        $offer = Offer::whereOfferNumber($message->subject->first())->first();
        if ($offer){
            $offerId = $offer->id;
        }
        $user = User::whereAttachmentIdentifierEmail($sender)->first() ?? User::whereId(1)->first();
        if ($user){
            $userId = $user->id;
        }

        $newAttachment = new Attachment();
        $newAttachment->subject = $message->subject->first();
        $newAttachment->bodies = $message->bodies;
        $newAttachment->from = $sender;
        $newAttachment->to = $recipient;
        $newAttachment->staff_id = $staffId;
        $newAttachment->offer_id = $offerId;
        $newAttachment->user_id = $userId;
        $newAttachment->client_id = $clientId;
        $newAttachment->save();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mailClient = InboundMail::account('default');
        $mailClient->connect();
        $this->status = $mailClient->isConnected();
        $messages = $mailClient->getFolderByName('INBOX')->messages()->all()->get();

        foreach ($messages as $message){
            $this->createAttachment($message);
            $message->move($folder_path = "processed");
        }
        $mailClient->disconnect();
    }
}
