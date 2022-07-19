<?php

namespace App\Exports;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CompaniesExport implements FromView
{
    protected $companies;

    public function __construct(array $companies)
    {
        $this->companies = $companies;
    }

    public function view(): View
    {
        return view('excelExports.companies', [
            'companies' => $this->companies
        ]);
    }
}
