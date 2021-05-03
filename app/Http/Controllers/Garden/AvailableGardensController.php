<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\Controller;
use App\Models\AvailableGardens;
use App\Models\FilledCells;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvailableGardensController extends Controller
{
    public function getUserGardens(Request $request)
    {
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
        AvailableGardens::where('id', $request->garden_id)
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

    public function updateGardenName(Request $request)
    {
        return Response(AvailableGardens::where('id', $request->garden_id)
            ->update([
                'garden_name' => $request->new_garden_name,
            ]), 201);
    }

    public function removeColumn(Request $request)
    {
        DB::beginTransaction();
        try {
            $actual_column_count = AvailableGardens::where('id', $request->garden_id)->value('column_count');
            AvailableGardens::where('id', $request->garden_id)
                ->update(['column_count' => $actual_column_count - 1]);
            FilledCells::where('available_garden_id', $request->garden_id)
                ->where('cell_column', $request->column_index)
                ->delete();

            FilledCells::where('available_garden_id', $request->garden_id)
                ->where('cell_column', '>', $request->column_index)
                ->decrement('cell_column');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return Response(["Error"], 500);
        }
        return Response(["Success"], 201);
    }
}
