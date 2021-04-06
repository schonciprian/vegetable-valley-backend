<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\Controller;
use App\Models\Garden;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GardenController extends Controller
{
    public function index()
    {
        return Response([Garden::all()]);
    }

    public function store(Request $request): Response
    {
        return Response(Garden::create([
            'user_id' => $request->user()->id,
            'cell_id' => $request->cell_id,
            'cell_name' => $request->cell_name,
            'cell_picture_url' => $request->cell_picture_url,
        ]));
    }
}
