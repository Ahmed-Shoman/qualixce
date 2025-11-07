<?php

namespace App\Mail;

use App\Models\GetYourConsultation;  // تأكد من الـ import ده
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConsultationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public GetYourConsultation $record,  // ده تمام، خاصية جديدة
        public string $messageContent,       // ده تمام، خاصية جديدة
        string $subject                      // مش public، بس string عشان النوع
    ) {
        $this->subject = $subject;  // حدث الخاصية الأب يدوياً (مش promoted)
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,  // هنا بيستخدم اللي حدثناه
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.consultation',
            with: [
                'record' => $this->record,
                'subject' => $this->subject,        // مررها للـ view لو عايز
                'messageContent' => $this->messageContent,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}