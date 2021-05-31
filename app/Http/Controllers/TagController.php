<?php

namespace App\Http\Controllers;

use App\Models\ImageTags;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getTags(Request $request)
    {
        return Response(ImageTags::select('tag_name as tagName', 'tag_color as color')
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
}
