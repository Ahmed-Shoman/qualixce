<?php
namespace App\Mail;

use App\Models\GetYourConsultation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsultationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $consultation;
    public $content;

    public function __construct(GetYourConsultation $consultation, string $content)
    {
        $this->consultation = $consultation;
        $this->content = $content;
    }

    public function build()
    {
        return $this->view('emails.consultation')
                    ->with([
                        'consultation' => $this->consultation,
                        'content' => $this->content,
                    ]);
    }
}