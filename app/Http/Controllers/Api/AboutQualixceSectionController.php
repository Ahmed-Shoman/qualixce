<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutQualixceSectionResource;
use App\Models\AboutQualixceSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutQualixceSectionController extends Controller
{
    /**
     * Display all About Qualixce sections.
     */
    public function index()
    {
        return AboutQualixceSectionResource::collection(AboutQualixceSection::all());
    }

    /**
     * Store a newly created About Qualixce section.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required|array',
            'subtitle'   => 'nullable|array',
            'cards'      => 'nullable|array',
            'image'      => 'nullable|image|max:2048',
            'image_alt'  => 'nullable|array',
        ]);

        // ✅ Handle main image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('about-qualixce', 'public');
        }

        // ✅ Handle cards icons if any are uploaded via base64 or file paths
        if (isset($validated['cards']) && is_array($validated['cards'])) {
            $validated['cards'] = collect($validated['cards'])->map(function ($card) {
                if (isset($card['icon']) && $card['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $card['icon']->store('about-qualixce/icons', 'public');
                    $card['icon'] = $path;
                }
                return $card;
            })->toArray();
        }

        $section = AboutQualixceSection::create($validated);

        return new AboutQualixceSectionResource($section);
    }

    /**
     * Display a specific section.
     */
    public function show(AboutQualixceSection $aboutQualixceSection)
    {
        return new AboutQualixceSectionResource($aboutQualixceSection);
    }

    /**
     * Update an existing section.
     */
    public function update(Request $request, AboutQualixceSection $aboutQualixceSection)
    {
        $validated = $request->validate([
            'title'      => 'sometimes|required|array',
            'subtitle'   => 'nullable|array',
            'cards'      => 'nullable|array',
            'image'      => 'nullable|image|max:2048',
            'image_alt'  => 'nullable|array',
        ]);

        // ✅ Replace main image if new one is uploaded
        if ($request->hasFile('image')) {
            if ($aboutQualixceSection->image) {
                Storage::disk('public')->delete($aboutQualixceSection->image);
            }
            $validated['image'] = $request->file('image')->store('about-qualixce', 'public');
        }

        // ✅ Process cards with icons
        if (isset($validated['cards']) && is_array($validated['cards'])) {
            $validated['cards'] = collect($validated['cards'])->map(function ($card) {
                if (isset($card['icon']) && $card['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $card['icon']->store('about-qualixce/icons', 'public');
                    $card['icon'] = $path;
                }
                return $card;
            })->toArray();
        }

        $aboutQualixceSection->update($validated);

        return new AboutQualixceSectionResource($aboutQualixceSection);
    }

    /**
     * Delete a section.
     */
    public function destroy(AboutQualixceSection $aboutQualixceSection)
    {
        if ($aboutQualixceSection->image) {
            Storage::disk('public')->delete($aboutQualixceSection->image);
        }

        // optionally delete icons if stored separately
        if (is_array($aboutQualixceSection->cards)) {
            foreach ($aboutQualixceSection->cards as $card) {
                if (!empty($card['icon'])) {
                    Storage::disk('public')->delete($card['icon']);
                }
            }
        }

        $aboutQualixceSection->delete();

        return response()->noContent();
    }
}
