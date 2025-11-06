<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * ✅ Get all active testimonials
     */
    public function index()
    {
        $testimonials = Testimonial::where('is_active', true)->get();

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