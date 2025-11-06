<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
public function index()
{
$testimonials = Testimonial::where('is_active', true)->latest()->get();
return TestimonialResource::collection($testimonials);
}

public function show(Testimonial $testimonial)
{
if (! $testimonial->is_active) {
return response()->json(['message' => 'Testimonial is inactive'], 404);
}

return new TestimonialResource($testimonial);
}
}
