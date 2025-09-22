<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetYourConsultationResource;
use App\Models\GetYourConsultation;
use Illuminate\Http\Request;

class GetYourConsultationController extends Controller
{
    public function index()
    {
        return GetYourConsultationResource::collection(GetYourConsultation::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'mobile_phone' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $record = GetYourConsultation::create($data);

        return new GetYourConsultationResource($record);
    }

    public function show(GetYourConsultation $getYourConsultation)
    {
        return new GetYourConsultationResource($getYourConsultation);
    }

    public function destroy(GetYourConsultation $getYourConsultation)
    {
        $getYourConsultation->delete();
        return response()->noContent();
    }
}