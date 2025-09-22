<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GetYourConsultation extends Model
{
    protected $fillable = [
        'name',
        'mobile_phone',
        'email',
        'message',
    ];
}
