<?php

namespace App\Exports;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StaffExport implements FromView
{
    protected $staff;

    public function __construct(array $staff)
    {
        $this->staff = $staff[0]['data'];
    }

    public function view(): View
    {
        return view('excelExports.staff', [
            'staff' => $this->staff
        ]);
    }
}
