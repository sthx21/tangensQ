<?php

namespace App\Exports;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClientsNewsletterExport implements FromView
{
    protected $clients;

    public function __construct(array $clients)
    {
        $this->clients = $clients;
    }

    public function view(): View
    {
        return view('excelExports.clientsNewsletter', [
            'clients' => $this->clients
        ]);
    }
}
