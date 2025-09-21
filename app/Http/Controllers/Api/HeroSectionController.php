<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroSectionResource as HeroSectionApiResource;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    public function index()
    {
        return HeroSectionApiResource::collection(HeroSection::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'background_image' => 'nullable|image',
            'background_image_alt' => 'required|string|max:255',
        ]);

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request->file('background_image')->store('hero_sections', 'public');
        }

        $heroSection = HeroSection::create($validated);

        return new HeroSectionApiResource($heroSection);
    }

    public function show(HeroSection $heroSection)
    {
        return new HeroSectionApiResource($heroSection);
    }

    public function update(Request $request, HeroSection $heroSection)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'background_image' => 'nullable|image',
            'background_image_alt' => 'sometimes|required|string|max:255',
        ]);

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request->file('background_image')->store('hero_sections', 'public');
        }

        $heroSection->update($validated);

        return new HeroSectionApiResource($heroSection);
    }

    public function destroy(HeroSection $heroSection)
    {
        $heroSection->delete();
        return response()->noContent();
    }
}