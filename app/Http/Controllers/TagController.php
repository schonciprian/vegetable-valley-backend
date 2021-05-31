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
}
