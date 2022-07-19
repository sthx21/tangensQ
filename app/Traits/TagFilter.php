<?php

namespace App\Traits;

use App\Models\Staff;
use App\Models\Tag;
use Illuminate\Http\Request;

trait TagFilter {
    public $advancedFilter = false;
    public $advancedTags;
    public $advancedNotTags;
    public $whereFilter;
    public $whereNotFilter;
    public $whereIds = [];
    public $whereNotIds = [];
    public $whereTags;
    public $whereNotTags;
    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function advancedTagFilter($model, $whereIds, $whereNotIds, $paginateNo)
    {

        $query = $model::with('tags');
        $query->whereHas('tags', function ($q) use ($whereIds)
        {
            return $q->whereIn('id', $whereIds);
        })->whereDoesntHave('tags', function ($q) use ($whereNotIds)
        {
            return $q->whereIn('id', $whereNotIds);
        });
        return  $query->paginate($paginateNo);
    }

    public function setAdvancedFilterIds($type, $id)
    {
        $whereIds = $this->whereIds;
        $whereNotIds = $this->whereNotIds;
        if ($type === 'where'){
            $whereIds[] = $id;
        }
        $this->whereTags = Tag::whereIn('id', $whereIds)->get();
        $this->whereFilter = '';
        if ($type === 'whereNot'){
            $whereNotIds[] = $id;
        }
        $this->whereNotTags = Tag::whereIn('id', $whereNotIds)->get();
        $this->whereNotIds = $whereNotIds;
        $this->whereIds = $whereIds;
        $this->whereNotFilter = '';
        $this->advancedTags = '';
        $this->advancedNotTags = '';
        $this->paginators = ['page' => 1];
    }
    public function setAdvancedFilter()
    {
        if (!$this->whereIds){
            return;
        }
        $this->advancedFilter = !$this->advancedFilter;
    }


}
