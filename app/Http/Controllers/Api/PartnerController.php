<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function index()
    {
        // فقط الشركاء الفعالين (الظاهرين)
        $partners = Partner::where('is_active', true)->latest()->get();

        return PartnerResource::collection($partners);
    }

    public function show(Partner $partner)
    {
        // لو عايز تمنع عرض الغير فعالين تقدر تضيف شرط هنا
        if (! $partner->is_active) {
            abort(404, 'Partner not found or inactive.');
        }

        return new PartnerResource($partner);
    }
}