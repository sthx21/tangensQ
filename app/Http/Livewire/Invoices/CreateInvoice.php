<?php

namespace App\Http\Livewire\Invoices;

use Livewire\Component;

class CreateInvoice extends Component
{
    public $invoice_recipient, $positions, $invoice, $free_text, $due_date;
    protected $rules = [

        'invoice_recipient.title'                                 =>  '',
        'invoice_recipient.first_name'                            => 'min:3',
        'invoice_recipient.last_name'                             => 'required|min:3',
        'invoice_recipient.email'                                 => 'required|email|unique:users,email',
        'positions.*.quantity'                                      => 'int',
        'invoice'                                                   => '',
        'free_text'                                                 => '',
        'due_date'                                                  => 'date',

    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [
        'invoice_recipient.title.required' => 'Es muss eine Anrede gewählt werden.',
        'invoice_recipient.email.required' => 'Es muss eine Email Adresse angegeben werden.',
        'invoice_recipient.email.email' => 'Dies ist keine gültige Email.',
        'invoice_recipient.email.unique' => 'Diese Email ist schon in Benutzung.',
        'invoice_recipient.last_name.required' => 'Das Feld Nachname kann nicht leer sein.',
        'invoice_recipient.last_name.min' => 'Der Name ist zu kurz.(mind. 3 Zeichen)',
        'invoice_recipient.first_name.required' => 'Das Feld Nachname kann nicht leer sein.',
        'invoice_recipient.first_name.min' => 'Der Name ist zu kurz.(mind. 3 Zeichen)',


    ];

    public function store()
    {
        dd($this);
    }


    public function render()
    {
        return view('livewire.invoices.create-invoice');
    }
}
