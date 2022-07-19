<?php

namespace App\Imports;

use App\Models\Staff;
use App\Models\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Row;



class StaffTagsImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        foreach ($collection->chunk(100) as $rows)
        {
            foreach ($rows as $row){

            $tagArray = explode(",", $row[1]);
            foreach ($tagArray as $t) {
                if (!Tag::whereName($t)->exists()) {
                    $tag = new Tag(
                        ['old_id' => $row[0],
                            'name' => $t ?? 'DELETE',
                        ]);
                    $tag->save();

                }

                    if (Tag::whereName($t)->exists()) {
                        $tag = Tag::whereName($t)->firstOrFail();

                        $staff = Staff::whereOldId($row[0])->firstOrFail();
                        $staff->tags()->syncWithoutDetaching($tag->id);
                    }
            }
            }

        }


    }
}

//class StaffTagsImport implements  OnEachRow
//{
//    public function onRow(Row $row)
//    {
//        $tagArray = explode(",", $row[1]);
//        foreach ($tagArray as $t) {
//            if (!Tag::whereName($t)->exists()) {
//                $tag = new Tag(
//                    ['old_id' => $row[0],
//                        'name' => $t ?? 'DELETE',
//                        'slug' => SlugService::createSlug(Tag::class, 'slug', $row[0]),
//                    ]);
//                $tag->save();
//            }
//        }    }
//    public function model(array $row)
//    {
//
//
////        'company_id' => $row[5],
////         'tags' => $row[23],
//        $tagArray = explode(",", $row[1]);
//        foreach ($tagArray as $t) {
//            if (!Tag::whereName($t)->exists()) {
//                return new Tag(
//                    ['old_id' => $row[0],
//                        'name' => $t ?? 'DELETE',
//                        'slug' => SlugService::createSlug(Tag::class, 'slug', $row[0]),
//                    ]);
//            }
//        }
//    }
//    public function batchSize(): int
//    {
//        return 500;
//    }
//    public function chunkSize(): int
//    {
//        return 500;
//    }

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



//}



