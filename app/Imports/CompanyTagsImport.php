<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Tag;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class CompanyTagsImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $tags = [

                'name' => $row[1],
            ];
            $tagArray = explode(",", $tags['name']);
            foreach ($tagArray as $t) {
                if (!Tag::whereName($t)->exists()) {
                    $newTag = new Tag([
                            'name' => $t,
                            'old_id' => 'compImp']
                    );
                    $newTag->save();
                }
            }
        }
        foreach ($rows as $row) {
            $oldId = $row[0];
            $tags = [
                'name' => $row[1],
            ];
            $company = Company::whereOldId($oldId)->firstOrFail();
            $tagArray = explode(",", $tags['name']);
            $tagIds = [];
            foreach ($tagArray as $t) {
                if (Tag::whereName($t)->exists()) {
                    $tag = Tag::whereName($t)->firstOrFail();
                    $tagIds[] = $tag->id;
                }
            }
            $company->tags()->attach($tagIds);
        }
    }
}
