<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    protected $fillable = [
        'name',
        'phone',
    ];

    public function chatUser()
    {
        return $this->belongsTo(ChatUser::class);
    }
}
