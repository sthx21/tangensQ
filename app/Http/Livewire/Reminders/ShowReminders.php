<?php

namespace App\Http\Livewire\Reminders;

use App\Models\Reminder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent as Component;
use Spatie\Permission\Models\Role;

class ShowReminders extends Component
{
    public $reminders ;


    protected $listeners = ['refreshReminders' => '$refresh'];

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
    public function mount()
    {
        $this->today = Carbon::today();

    }

    public function setCompleted()
    {
        $this->validate();
    }

    public function delete($id)
    {
        User::firstOrFail($id)->delete();

        session()->flash('message', 'Users Deleted Successfully.');
    }
    public function render()
    {
        $reminders = Reminder::whereUserId(\Auth::id())->whereComplete(0)->get();
        $dueReminders = collect();
        foreach ($reminders as $reminder){
            $reminder->due_date = Carbon::create($reminder->due_date);
            if ($reminder->due_date->between($this->today->copy()->subDays(21), $this->today->copy()->addDays(3) )){
                $dueReminders->add($reminder);

            }
        }
        $this->reminders = $dueReminders;

        return view('livewire.reminders.show-reminders');
    }
}
