<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OurValueResource as OurValueApiResource;
use App\Models\OurValueSection;
use Illuminate\Http\Request;


class OurValueSectionController extends Controller
{
    // GET /api/our-values
    public function index()
    {
        return OurValueApiResource::collection(OurValueSection::all());
    }

    // POST /api/our-values
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cards' => 'required|array',
            'cards.*.title' => 'required|array', // ['ar' => '', 'en' => '']
            'cards.*.subtitle' => 'nullable|array',
        ]);

        $ourValueSection = OurValueSection::create($validated);

        return new OurValueApiResource($ourValueSection);
    }

    // GET /api/our-values/{id}
    public function show(OurValueSection $ourValueSection)
    {
        return new OurValueApiResource($ourValueSection);
    }

    // PUT/PATCH /api/our-values/{id}
    public function update(Request $request, OurValueSection $ourValueSection)
    {
        $validated = $request->validate([
            'cards' => 'sometimes|required|array',
            'cards.*.title' => 'required|array',
            'cards.*.subtitle' => 'nullable|array',
        ]);

        $ourValueSection->update($validated);

        return new OurValueApiResource($ourValueSection);
    }

    // DELETE /api/our-values/{id}
    public function destroy(OurValueSection $ourValueSection)
    {
        $ourValueSection->delete();
        return response()->noContent();
    }
}
