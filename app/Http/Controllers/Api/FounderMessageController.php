<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoundationMessageResource;
use App\Http\Resources\FounderMessageResource;
use App\Models\FounderMessage;
use Illuminate\Http\Request;

class FounderMessageController extends Controller
{
    public function index()
    {
        return FounderMessageResource::collection(FounderMessage::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'description' => 'required|array',
            'name' => 'required|array',
            'position' => 'required|array',
            'image' => 'nullable|string',
        ]);

        $record = FounderMessage::create($data);

        return new FounderMessageResource($record);
    }

    public function show(FounderMessage $founderMessage)
    {
        return new FounderMessageResource($founderMessage);
    }

    public function update(Request $request, FounderMessage $founderMessage)
    {
        $data = $request->validate([
            'title' => 'sometimes|array',
            'description' => 'sometimes|array',
            'name' => 'sometimes|array',
            'position' => 'sometimes|array',
            'image' => 'nullable|string',
        ]);

        $founderMessage->update($data);

        return new FounderMessageResource($founderMessage);
    }

    public function destroy(FounderMessage $founderMessage)
    {
        $founderMessage->delete();
        return response()->noContent();
    }
}