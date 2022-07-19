<?php

namespace App\Http\Livewire\Attachments;

use App\Models\Attachment;
use App\Models\Reminder;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class ShowAttachment extends ModalComponent
{
    public $attachment;


    protected $rules = [
        'attachment.read' => ''
    ];
    protected $listeners = ['attachmentIsDone'];
    public function mount(Attachment $attachment)
    {
        $this->today = Carbon::today();
        $this->attachment = $attachment;

    }

    public function attachmentIsDone()
    {
        $attachmentIsDone = $this->attachment;
        $attachmentIsDone->read = true;
        $this->closeModal();
        $attachmentIsDone->save();
        $this->attachment = $attachmentIsDone;

//        $this->emit('refreshReminders');
    }
    public function render()
    {
        return view('livewire.attachments.show-attachment');
    }
}
