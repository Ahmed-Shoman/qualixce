<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ChatUser;


class UserRegistrationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $user = ChatUser::firstOrCreate(
            ['phone' => $data['phone']],
            ['name' => $data['name']]
        );

        return response()->json([
            'user_id' => $user->id
        ]);
    }
}
