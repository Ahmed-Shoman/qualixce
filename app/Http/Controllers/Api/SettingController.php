<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index(Request $request)
    {
        $query = Setting::query();

        if ($request->has('key')) {
            $query->where('key', $request->key);
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $settings = $query->get();

        return SettingResource::collection($settings);
    }


    public function show($id)
    {
        $setting = Setting::where('id', $id)
            ->orWhere('key', $id)
            ->firstOrFail();

        return new SettingResource($setting);
    }


    public function update(Request $request, $id)
    {
        $setting = Setting::where('id', $id)
            ->orWhere('key', $id)
            ->firstOrFail();

        $request->validate([
            'value' => 'required',
        ]);

        $setting->update([
            'value' => $request->value,
        ]);

        return response()->json([
            'message' => 'Setting updated successfully.',
            'data' => new SettingResource($setting),
        ]);
    }
}