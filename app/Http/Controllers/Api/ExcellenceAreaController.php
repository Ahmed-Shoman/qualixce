<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExcellenceAreaResource;
use App\Models\ExcellenceArea;
use Illuminate\Http\Request;

class ExcellenceAreaController extends Controller
{
    public function index()
    {
        return ExcellenceAreaResource::collection(ExcellenceArea::all());
    }

    public function show(ExcellenceArea $excellenceArea)
    {
        return new ExcellenceAreaResource($excellenceArea);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'subtitle' => 'required|array',
            'cards' => 'required|array',
        ]);

        $record = ExcellenceArea::create($data);

        return new ExcellenceAreaResource($record);
    }

    public function update(Request $request, ExcellenceArea $excellenceArea)
    {
        $data = $request->validate([
            'title' => 'sometimes|array',
            'subtitle' => 'sometimes|array',
            'cards' => 'sometimes|array',
        ]);

        $excellenceArea->update($data);

        return new ExcellenceAreaResource($excellenceArea);
    }

    public function destroy(ExcellenceArea $excellenceArea)
    {
        $excellenceArea->delete();
        return response()->noContent();
    }
}
