<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Staff;
use App\Models\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Row;



class StaffAttachCompanyImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        foreach ($collection->chunk(250) as $rows)
        {
            foreach ($rows as $row){

                if ($row[0] && $row[1]) {
                    $staff = Staff::whereOldId($row[0])->first();
                    $company = Company::whereOldId($row[1])->first();

//                dd($staff, $company, $row);
                    $staff->company_id = $company->id ?? 1;
                    $staff->save();
                }
            }

        }


    }
}





