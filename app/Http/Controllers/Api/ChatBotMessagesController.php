<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatbotMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatBotMessagesController extends Controller
{
    public function index(Request $request)
    {
        $messages = ChatbotMessage::all();
        return response()->json($messages);
    }
    public function store(Request $request)
    {
        // ✅ Validation
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'user_name' => 'required|string',
            'user_phone' => 'required|string',

            'session_id' => 'required|integer',
            'messages' => 'required|array|min:1',

            'messages.*.sender' => 'required|in:user,bot',
            'messages.*.text' => 'required|string',
            'messages.*.ts' => 'required|integer',

            'last_active_at' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // ✅ Store or update messages (snapshot JSON)
        ChatbotMessage::updateOrCreate(
            [
                'session_id' => $request->session_id,
            ],
            [
                'messages' => $request->messages,
            ]
        );

        // ✅ Required response
        return response()->json([
            'success' => true,
        ]);
    }
}
