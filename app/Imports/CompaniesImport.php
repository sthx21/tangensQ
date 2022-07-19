<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;



class CompaniesImport implements ToModel, WithBatchInserts, WithChunkReading
{
    public function model(array $row)
    {

        return new Company([

            'old_id' => $row[0],
            'name' => $row[1],
            'street' => $row[2],
            'zip' => $row[3],
            'city' => $row[4],
            'state' => $row[5],
            'country' => $row[6],
            'address_origin' => $row[7],
            'homepage' => $row[8],
            'main_email' => $row[9],
            'newsletter' => $row[10],
            'second_email' => $row[11],
            'main_phone' => $row[12],
            'fax_number' => $row[14],
            'second_phone' => $row[13],
            'info' => $row[15],
            'revenue' => $row[16],
            'last_note' => $row[17],
            'slug' => SlugService::createSlug(Company::class, 'slug', $row[0]),
        ]);
    }

    public function batchSize(): int
    {
        return 500;
    }
    public function chunkSize(): int
    {
        return 500;
    }
//            $collect = [
//                'old_id' => $row[0],
//                'name' => $row[1],
//                'street' => $row[2],
//                'zip' => $row[3],
//                'city' => $row[4],
//                'state' => $row[5],
//                'country' => $row[6],
//                'address_origin' => $row[7],
//                'homepage' => $row[8],
//                'main_email' => $row[9],
//                'newsletter' => $row[10],
//                'second_email' => $row[11],
//                'main_phone' => $row[12],
//                'fax_number' => $row[14],
//                'second_phone' => $row[13],
//                'info' => $row[15],
//                'revenue' => $row[16],
//                'last_note' => $row[17],
//            ];
//            if (!Company::whereOldId($row[0])->exists()) {
//                $newCompany = new Company($collect);
//                $newCompany->save();
//            }
//        }
//        foreach ($rows as $row) {
//            $tags = [
//
//                'name' => $row[18],
//            ];
//            $tagArray = explode(",", $tags['name']);
//            foreach ($tagArray as $t) {
//                if (!Tag::whereName($t)->exists()) {
//                    $newTag = new Tag([
//                            'name' => $t,
//                            'slug' => $t]
//                    );
//                    $newTag->save();
//                }
//            }
//            $oldId = $row[0];
//
//            $company = Company::whereOldId($oldId)->firstOrFail();
//            $tagArray = explode(",", $tags['name']);
//            $tagIds = [];
//            foreach ($tagArray as $t) {
//                if (Tag::whereName($t)->exists()) {
//                    $tag = Tag::whereName($t)->firstOrFail();
//                    $tagIds[] = $tag->id;
//                }
//            }
//            $company->tags()->attach($tagIds);
//        }

}

