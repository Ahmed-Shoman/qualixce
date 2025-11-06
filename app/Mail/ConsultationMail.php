<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\GetYourConsultation;

class ConsultationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $record;

    public function __construct(GetYourConsultation $record)
    {
        $this->record = $record;
    }

    public function build()
    {
        return $this->subject('طلب استشارة جديد')
            ->view('emails.consultation')
            ->with(['record' => $this->record]);
    }
}