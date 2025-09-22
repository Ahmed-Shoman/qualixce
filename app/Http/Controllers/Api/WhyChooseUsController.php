<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WhyChooseUsResource;
use App\Models\WhyChooseUs;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all WhyChooseUs items
        $items = WhyChooseUs::all();

        // Transform each item using the resource
        return WhyChooseUsResource::collection($items);
    }

    public function show(WhyChooseUs $whyChooseUs)
    {
        return new WhyChooseUsResource($whyChooseUs);
    }
}
