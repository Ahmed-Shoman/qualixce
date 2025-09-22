<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProvenProcessResource;
use App\Models\ProvenProcess;
use Illuminate\Http\Request;

class ProvenProcessController extends Controller
{
    public function index()
    {
        return ProvenProcessResource::collection(ProvenProcess::all());
    }

    public function show(ProvenProcess $provenProcess)
    {
        return new ProvenProcessResource($provenProcess);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'subtitle' => 'required|array',
            'cards' => 'required|array',
        ]);

        $record = ProvenProcess::create($data);

        return new ProvenProcessResource($record);
    }

    public function update(Request $request, ProvenProcess $provenProcess)
    {
        $data = $request->validate([
            'title' => 'sometimes|array',
            'subtitle' => 'sometimes|array',
            'cards' => 'sometimes|array',
        ]);

        $provenProcess->update($data);

        return new ProvenProcessResource($provenProcess);
    }

    public function destroy(ProvenProcess $provenProcess)
    {
        $provenProcess->delete();
        return response()->noContent();
    }
}