<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // حاول نمنع تكرار نفس المستخدم
        $user = User::firstOrCreate(
            ['phone' => $data['phone']],
            ['name' => $data['name']]
        );

        return response()->json([
            'user_id' => $user->id
        ]);
    }
}
