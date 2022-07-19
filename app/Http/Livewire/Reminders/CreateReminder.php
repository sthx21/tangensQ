<?php

namespace App\Http\Livewire\Reminders;

use App\Models\Reminder;
use App\Models\User;
use LivewireUI\Modal\ModalComponent as Component;

class CreateReminder extends Component
{
    public $reminder;



    protected $rules = [
        'reminder.title' => '',
        'reminder.description' => '',
        'reminder.due_date' => '',
        'reminder.company_id' => '',
        'reminder.trainer_id' => '',
        'reminder.client_id' => '',
        'reminder.workshop_id' => '',
        'reminder.webex_id' => '',
        'reminder.staff_id' => '',
        'reminder.inhouse_id' => '',
    ];
//    public function mount()
//    {
//
//    }
    public function store()
    {
        $this->validate();
        $reminder = new Reminder($this->reminder);
        $reminder->user_id = \Auth::id();
        $reminder->save();
        $this->closeModal();
        $this->emit('refreshReminders');

    }

    public function render()
    {

        return view('livewire.reminders.create-reminder');
    }
}
