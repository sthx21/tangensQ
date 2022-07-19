<?php

namespace App\Imports;

use App\Models\Activity;
use App\Models\Company;
use App\Models\Offer;
use App\Models\Staff;
use App\Models\Tag;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class OffersImport implements ToCollection
{

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $offer_number = 2200001;
            if (Offer::count() > 0){
                $latestOffer = Offer::latest()->firstOrFail();
                $offer_number = ++$latestOffer->offer_number;
            }
            $company = Company::whereOldId($row[5])->first();
            $staff = Staff::whereOldId($row[6])->first();
            $target_date = Carbon::create($row[3]);
            $completion_date = Carbon::create($row[4]);
            $offer = new Offer(
                [
                    'title'                     => $row[0],
                    'offer_number'              => $offer_number,
                    'amount'                    => $row[1],
                    'user_id'                   => 4,
                    'status'                    => $row[2],
                    'target_date'               => $target_date,
                    'completion_date'           => $completion_date,
                    'about'                     => $row[7],
                    'company_id'                => $company->id ?? '',
                    'staff_id'                  => $staff->id ?? '',
                    'special_agreement'         => $row[9],
                ]
            );
            $offer->offer_date = Carbon::today();
            $offer->save();
            if ($row[8]){
                $activity = new Activity(
                    [
                        'title' => $offer->offer_number,
                        'description' => $row[0],
                        'user_id'       => 4,
                        'company_id' => $company->id ?? '',
                        'trainer_id',
                        'webex_id',
                        'workshop_id',
                        'inhouse_id',
                        'offer_id'  => $offer->id,
                        'client_id',
                        'staff_id',
                    ]
                );
                $activity->save();
            }
        }
    }
}
