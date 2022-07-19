<?php

namespace App\Exports;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClientsExport implements FromView
{
    protected $clients;

    public function __construct(array $clients)
    {
        $this->clients = $clients;
    }

    public function view(): View
    {
        return view('excelExports.clients', [
            'clients' => $this->clients
        ]);
    }
}
