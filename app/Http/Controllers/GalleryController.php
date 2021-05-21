<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function getUserImages(Request $request)
    {
        return Response(Gallery::select('id', 'image_id', 'original_filename', 'format', 'type', 'created_at')
            ->where('user_id', $request->user()->id)
            ->get()
        );
    }

    public function saveUserImage(Request $request)
    {
        return Response(Gallery::create([
            'user_id' => $request->user()->id,
            'image_id' => $request->image_id,
            'original_filename' => $request->original_filename,
            'format' => $request->file_format,
            'type' => $request->type,
        ]));
    }

    public function removeUserImage(Request $request)
    {
        return Response(Gallery::where('image_id', $request->image_id)
            ->delete());
    }
}
