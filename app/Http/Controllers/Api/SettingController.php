<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;

class SettingController extends Controller
{

    public function index()
    {
        $setting = Setting::first();

        if (!$setting) {
            return response()->json(['message' => 'Settings not found'], 404);
        }

        return new SettingResource($setting);
    }
}