<?php

namespace App\Http\Livewire\Reminders;

use App\Models\Reminder;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class ShowReminder extends ModalComponent
{
    public $reminder;


    protected $rules = [
        'reminder.complete' => ''
    ];
    public function mount(Reminder $reminder)
    {
        $this->today = Carbon::today();
        $this->reminder = $reminder;

    }

    public function isCompleted($id)
    {
        $reminder = Reminder::whereId($id)->firstOrFail();
        $reminder->complete = true;
        $this->closeModal();
        $reminder->save();

        $this->emit('refreshReminders');
    }
    public function render()
    {
        return view('livewire.reminders.show-reminder');
    }
}
