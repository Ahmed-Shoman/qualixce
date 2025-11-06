<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        return TestimonialResource::collection(Testimonial::all());
    }

    public function show(Testimonial $testimonial)
    {
        return new TestimonialResource($testimonial);
    }
}