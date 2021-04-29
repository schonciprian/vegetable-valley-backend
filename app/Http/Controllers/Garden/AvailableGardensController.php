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

    public function getGardenSize(Request $request)
    {
        return Response(AvailableGardens::select('row_count', 'column_count')
            ->where('user_id', $request->user()->id)
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
}
