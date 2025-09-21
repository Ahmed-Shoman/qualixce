<?php
// API Controller: AboutQualixceSectionController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutQualixceSectionResource;
use App\Models\AboutQualixceSection;
use Illuminate\Http\Request;

class AboutQualixceSectionController extends Controller
{
    public function index()
    {
        return AboutQualixceSectionResource::collection(AboutQualixceSection::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|array',
            'subtitle' => 'nullable|array',
            'cards' => 'nullable|array',
            'image' => 'nullable|image',
            'image_alt' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('about_qualixce', 'public');
        }

        $section = AboutQualixceSection::create($validated);

        return new AboutQualixceSectionResource($section);
    }

    public function show(AboutQualixceSection $aboutQualixceSection)
    {
        return new AboutQualixceSectionResource($aboutQualixceSection);
    }

    public function update(Request $request, AboutQualixceSection $aboutQualixceSection)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|array',
            'subtitle' => 'nullable|array',
            'cards' => 'nullable|array',
            'image' => 'nullable|image',
            'image_alt' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('about_qualixce', 'public');
        }

        $aboutQualixceSection->update($validated);

        return new AboutQualixceSectionResource($aboutQualixceSection);
    }

    public function destroy(AboutQualixceSection $aboutQualixceSection)
    {
        $aboutQualixceSection->delete();
        return response()->noContent();
    }
}