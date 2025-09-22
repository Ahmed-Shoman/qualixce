<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OurServiceResource;
use App\Models\OurService;
use Illuminate\Http\Request;

class OurServiceController extends Controller
{
    public function index()
    {
        return OurServiceResource::collection(OurService::all());
    }

    public function show(OurService $ourService)
    {
        return new OurServiceResource($ourService);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'subtitle' => 'required|array',
            'cards' => 'required|array',
        ]);

        $record = OurService::create($data);

        return new OurServiceResource($record);
    }

    public function update(Request $request, OurService $ourService)
    {
        $data = $request->validate([
            'title' => 'sometimes|array',
            'subtitle' => 'sometimes|array',
            'cards' => 'sometimes|array',
        ]);

        $ourService->update($data);

        return new OurServiceResource($ourService);
    }

    public function destroy(OurService $ourService)
    {
        $ourService->delete();
        return response()->noContent();
    }
}