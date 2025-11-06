<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->get();
        return PartnerResource::collection($partners);
    }

    public function show(Partner $partner)
    {
        return new PartnerResource($partner);
    }
}