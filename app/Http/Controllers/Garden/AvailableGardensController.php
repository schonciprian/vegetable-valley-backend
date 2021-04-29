<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\Controller;
use App\Models\AvailableGardens;
use Illuminate\Http\Request;

class AvailableGardensController extends Controller
{
    public function getUserGardens(Request $request) {
        return Response(AvailableGardens::select('id', 'garden_name')
            ->where('user_id', $request->user()->id)
            ->get()
        );
    }

    public function getGardenName(Request $request)
    {
        return Response(AvailableGardens::select('garden_name')
            ->where('id', $request->garden_id)
            ->get()
        );
    }

    public function getGardenSize(Request $request)
    {
        return Response(AvailableGardens::select('row_count', 'column_count')
            ->where('user_id', $request->user()->id)
            ->where('id', $request->garden_id)
            ->get()
        );
    }

    public function updateGardenSize(Request $request)
    {
        AvailableGardens::where('user_id', $request->user()->id)
            ->update([
                'row_count' => $request->row_count,
                'column_count' => $request->column_count,
            ]);
        return response(['row_count' => $request->row_count,
                         'column_count' => $request->column_count], 201);
    }

    public function addNewGarden(Request $request)
    {
        $id = AvailableGardens::create([
            'user_id' => $request->user()->id,
            'row_count' => 5,
            'column_count' => 6,
        ])->id;

        return response(['id' => $id], 201);
    }
}
