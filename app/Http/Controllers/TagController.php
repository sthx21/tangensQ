<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Show Global Search Results
     *
     * @return JsonResponse
     */
    public function manageTags(Request $request)
    {
        $tags = Tag::all('id', 'name');
        if ($request->has('q')) {
            $tags = $tags->filter(function ($item) use ($request) {
                return str_contains($item->name,  $request->q);
            });
        }


        return response()->json($tags);
    }
    /**
     * Show Global Search Results
     *
     * @return JsonResponse
     */
    public function selectedTags($id)
    {
        $attachedTags = DB::table("client_tag")->where("client_tag.client_id",$id)
            ->pluck('client_tag.tag_id','client_tag.tag_id')
//            added ->values() to convert to json array
            ->values()
            ->all();

        $tags = Tag::all()->only($attachedTags);
        return response()->json($tags);
    }
    /**
     * Create Tags Globally
     *
     * @return JsonResponse
     */
    public function createTags(Request $request)
    {
        $tags = Tag::all('id', 'name');
        if ($request->has('q')) {
            $tags = $tags->filter(function ($item) use ($request) {
                return str_contains($item->name,  $request->q);
            });
        }


        return response()->json($tags);
    }

}
