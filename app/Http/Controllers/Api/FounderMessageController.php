<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FounderMessageResource;
use App\Models\FounderMessage;
use Illuminate\Http\Request;

class FounderMessageController extends Controller
{
    // GET /api/founder-messages
    public function index()
    {
        return FounderMessageResource::collection(FounderMessage::all());
    }

    // POST /api/founder-messages
    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|array',        // ['en' => '', 'ar' => '']
            'name' => 'required|array',           // ['en' => '', 'ar' => '']
            'position' => 'required|array',       // ['en' => '', 'ar' => '']
            'image' => 'nullable|string',
        ]);

        $record = FounderMessage::create($data);

        return new FounderMessageResource($record);
    }

    // GET /api/founder-messages/{id}
    public function show(FounderMessage $founderMessage)
    {
        return new FounderMessageResource($founderMessage);
    }

    // PUT/PATCH /api/founder-messages/{id}
    public function update(Request $request, FounderMessage $founderMessage)
    {
        $data = $request->validate([
            'message' => 'sometimes|required|array',
            'name' => 'sometimes|required|array',
            'position' => 'sometimes|required|array',
            'image' => 'nullable|string',
        ]);

        $founderMessage->update($data);

        return new FounderMessageResource($founderMessage);
    }

    // DELETE /api/founder-messages/{id}
    public function destroy(FounderMessage $founderMessage)
    {
        $founderMessage->delete();
        return response()->noContent();
    }
}
