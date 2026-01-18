<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatSyncController extends Controller
{
    public function sync(Request $request)
    {
        $data = $request->validate([
            'user_id'          => 'required|exists:users,id',
            'session_id'       => 'required|integer',
            'last_active_at'   => 'required|date',
            'messages'         => 'required|array',
            'messages.*.sender'=> 'required|in:user,bot',
            'messages.*.text'  => 'required|string',
            'messages.*.ts'    => 'required|integer',
        ]);

        $session = ChatSession::firstOrCreate(
            [
                'user_id'    => $data['user_id'],
                'session_id' => $data['session_id'],
            ],
            [
                'last_active_at' => $data['last_active_at'],
            ]
        );

        foreach ($data['messages'] as $msg) {
            ChatMessage::updateOrCreate(
                [
                    'chat_session_id' => $session->id,
                    'ts'              => $msg['ts'],
                ],
                [
                    'sender' => $msg['sender'],
                    'text'   => $msg['text'],
                ]
            );
        }

        return response()->json([
            'success' => true
        ]);
    }
}