<?php

namespace App\Http\Controllers;

use App\Models\ImageTags;
use App\Models\ImageTagsMap;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getTags(Request $request)
    {
        return Response(ImageTags::select('id', 'tag_name as tagName', 'tag_color as color')
            ->where('user_id', $request->user()->id)
            ->get()
        );
    }

    public function saveTag(Request $request)
    {
        return Response(ImageTags::create([
            'user_id' => $request->user()->id,
            'tag_name' => $request->tagName,
            'tag_color' => $request->color,
        ]));
    }

    public function saveTagToImage(Request $request)
    {
        return Response(ImageTagsMap::create([
            'image_id' => $request->image_id,
            'tag_id' => $request->tag_id,
        ]));
    }

    public function removeTagFromImage(Request $request)
    {
        return Response(ImageTagsMap::where('image_id', $request->image_id)
            ->where('tag_id', $request->tag_id)
            ->delete());
    }
}