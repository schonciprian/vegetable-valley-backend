<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\ImageTagsMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function getUserImages(Request $request)
    {
//        return Response(Gallery::select(
//            'galleries.id',
//            'galleries.image_id',
//            'galleries.original_filename',
//            'galleries.format',
//            'galleries.type',
//            'galleries.created_at',

//            'image_tags.tag_name',
//            'image_tags.tag_color'
//        )
//            ->leftJoin('image_tags_maps', 'image_tags_maps.image_id', 'galleries.id')
//            ->leftJoin('image_tags', 'image_tags.id', 'image_tags_maps.tag_id')
//            ->select('image_tags.tag_name', 'image_tags.tag_color')
//            ->select(DB::raw("STRING_AGG(image_tags.tag_name, ',')"))
//            ->where('galleries.user_id', $request->user()->id)
//            ->groupBy('galleries.id')
//            ->orderBy('created_at','DESC')
//            ->get(array(DB::raw("STRING_AGG(image_tags.tag_name, ',')")),'galleries.id')
//            ->get()


        return Response(DB::table('galleries')
            ->leftJoin('image_tags_maps', 'image_tags_maps.image_id', '=', 'galleries.id')
            ->leftJoin('image_tags', 'image_tags.id', '=', 'image_tags_maps.tag_id')
            ->select('galleries.id',
                'galleries.image_id',
                'galleries.original_filename',
                'galleries.format',
                'galleries.type',
                'galleries.created_at',

                DB::raw("GROUP_CONCAT(image_tags.id) as tagId"),
                DB::raw("GROUP_CONCAT(image_tags.tag_name) as tagName"),
                DB::raw("GROUP_CONCAT(image_tags.tag_color) as tagColor"),
//                'image_tags.tag_name',
//                'image_tags.tag_color'
            )
            ->where('galleries.user_id', '=', $request->user()->id)
            ->groupBy('galleries.id')
            ->orderBy('created_at','DESC')
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
        ImageTagsMap::whereIn('image_id', $request->image_ids)
            ->delete();

        return Response(Gallery::whereIn('id', $request->image_ids)
            ->delete());
    }
}
