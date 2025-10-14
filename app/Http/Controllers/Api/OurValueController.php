<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OurValueResource as OurValueApiResource;
use App\Models\OurValue;
use Illuminate\Http\Request;

class OurValueController extends Controller
{
    public function index()
    {
        return OurValueApiResource::collection(OurValue::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cards' => 'required|array|min:1',
            'cards.*.title' => 'required|array', // expects ['ar' => '', 'en' => '']
            'cards.*.subtitle' => 'nullable|array',
        ]);

        $ourValue = OurValue::create($validated);

        return new OurValueApiResource($ourValue);
    }

    public function show(OurValue $ourValue)
    {
        return new OurValueApiResource($ourValue);
    }

    public function update(Request $request, OurValue $ourValue)
    {
        $validated = $request->validate([
            'cards' => 'sometimes|required|array|min:1',
            'cards.*.title' => 'required|array',
            'cards.*.subtitle' => 'nullable|array',
        ]);

        $ourValue->update($validated);

        return new OurValueApiResource($ourValue);
    }

    public function destroy(OurValue $ourValue)
    {
        $ourValue->delete();
        return response()->noContent();
    }
}
