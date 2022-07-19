<?php

namespace App\Http\Livewire\Attachments;

use App\Models\Client;
use App\Models\Offer;
use App\Models\Staff;
use App\Models\Attachment;
use App\Models\Reminder;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Webklex\PHPIMAP\Folder;
use Webklex\IMAP\Facades\Client as InboundMail;

class GetAttachments extends Component
{
    public $messages;
    public $status;
    public $folder;
    public $headers;


    protected $rules = [
        'reminder.complete' => ''
    ];
    public function mount()
    {
        $mailClient = InboundMail::account('default');
        $mailClient->connect();
        $this->status = $mailClient->isConnected();
        $messages = $mailClient->getFolderByName('INBOX')->messages()->all()->get();
        $folders = $mailClient->getFolders($hierarchical = true);
        $this->folders = $folders;
        foreach ($messages as $message){
            $this->createAttachment($message);
            $message->move($folder_path = "processed");
        }
        $this->messages = $messages;

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

    public function render()
    {
        $headers  = '';
        return view('livewire.attachments.show-new-attachments', compact('headers'));

    }
}
