<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\Controller;
use App\Models\FilledCells;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GardenController extends Controller
{
    public function index(Request $request)
    {
        return Response([FilledCells::select('cell_row', 'cell_column', 'cell_name', 'cell_picture_url')
            ->where('user_id', $request->user()->id)
            ->get()
        ]);
    }

    public function store(Request $request): Response
    {
        FilledCells::where('cell_row', $request->cell_row)
            ->where('cell_column', $request->cell_column)
            ->where('user_id', $request->user()->id)
            ->delete();

        $created = FilledCells::create([
            'user_id' => $request->user()->id,
            'cell_row' => $request->cell_row,
            'cell_column' => $request->cell_column,
            'cell_name' => $request->cell_name,
            'cell_picture_url' => $request->cell_picture_url,
        ]);

        if ($created) {
            return Response(["Success"], 201);
        }
        return Response(["Failed"], 400);

    }

    public function delete(Request $request)
    {
        return Response([FilledCells::where('cell_row', $request->cell_row)
            ->where('cell_column', $request->cell_column)
            ->where('user_id', $request->user()->id)
            ->delete()
        ]);
    }
}
