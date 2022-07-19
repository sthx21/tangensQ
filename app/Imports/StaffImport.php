<?php

namespace App\Imports;

use App\Models\Staff;
use App\Models\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;



class StaffImport implements ToModel, WithBatchInserts, WithChunkReading
{
    public function model(array $row)
    {


//        'company_id' => $row[5],
//         'tags' => $row[23],
        return new Staff(
            ['old_id' => $row[0],
            'title' => $row[1],
            'academic_title' => $row[2],
            'first_name' => $row[3],
            'last_name' => $row[4],
            'position' => $row[6],
            'department' => $row[7],
            'lead_position' => $row[8],
            'second_name' => $row[9],
            'street' => $row[10],
            'zip' => $row[11],
            'city' => $row[12],
            'state' => $row[13],
            'country' => $row[14],
            'homepage' => $row[15],
            'email' => $row[16],
            'newsletter' => $row[17],
            'phone' => $row[18],
            'second_phone' => $row[19],
            'fax_number' => $row[20],
            'about' => $row[21],
            'revenue' => $row[22],
            'last_note' => $row[23],

            'function' => $row[24],
                'slug' => SlugService::createSlug(Staff::class, 'slug', $row[0]),
        ]);
    }
        public function batchSize(): int
    {
        return 200;
    }
        public function chunkSize(): int
    {
        return 200;
    }
//            if (!Staff::whereOldId($row[0])->exists()) {
//                $newStaff = new Staff($collect);
//                $newStaff->save();
//            }
//
//                $tags = [
//                    'name' => $row[23],
//                ];
//                $tagArray = explode(",", $tags['name']);
//                foreach ($tagArray as $t) {
//                    if (!Tag::whereName($t)->exists()) {
//                        $newTag = new Tag([
//                                'name' => $t]
//                        );
//                        $newTag->save();
//                    }
//                }
//
//                $oldId = $row[0];
//
//                $staff = Staff::whereOldId($oldId)->firstOrFail();
//                $tagArray = explode(",", $tags['name']);
//                $tagIds = [];
//                foreach ($tagArray as $t) {
//                    if (Tag::whereName($t)->exists()) {
//                        $tag = Tag::whereName($t)->firstOrFail();
//                        $tagIds[] = $tag->id;
//                    }
//                }
//                $staff->tags()->attach($tagIds);
//                $staff->company()->attach($row[5]);

        }



