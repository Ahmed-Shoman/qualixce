<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'chat_user_id' => 'required|exists:chat_users,id',
            'session_id'   => 'required|integer',
            'message'      => 'required|string|max:5000',
        ]);


    }
}
