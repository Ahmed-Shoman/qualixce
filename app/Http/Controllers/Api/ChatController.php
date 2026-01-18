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

        $session = ChatSession::firstOrCreate(
            [
                'chat_user_id' => $data['chat_user_id'],
                'session_id'   => $data['session_id'],
            ]
        );

        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender'          => 'user',
            'text'            => $data['message'],
            'ts'              => now()->timestamp * 1000,
        ]);

        $reply = $this->generateReply($data['message']);

        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender'          => 'bot',
            'text'            => $reply,
            'ts'              => now()->addMilliseconds(1)->timestamp * 1000,
        ]);

        return response()->json([
            'reply' => $reply
        ]);
    }

    protected function generateReply(string $message): string
    {
        if (str_contains($message, 'سعر')) {
            return 'الأسعار بتبدأ من 18,000 جنيه. تحب أعرفك التفاصيل؟';
        }

        if (str_contains($message, 'تواصل')) {
            return 'تقدر تسيب رقمك، وهيتم التواصل معاك فورًا.';
        }

        return 'تمام، ممكن توضّح طلبك أكتر؟';
    }
}
