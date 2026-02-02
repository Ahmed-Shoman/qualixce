<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotMessage extends Model
{
    protected $table = 'chatbot_messages';

    protected $fillable = [
        'session_id',
        'messages',
    ];

    protected $casts = [
        'messages' => 'array',
    ];

    public function chatBotMessage()
    {
        return $this->hasMany(ChatbotMessage::class);
    }
}
