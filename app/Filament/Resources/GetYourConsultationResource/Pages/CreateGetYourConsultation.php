<?php

namespace App\Filament\Resources\GetYourConsultationResource\Pages;

use App\Filament\Resources\GetYourConsultationResource;
use App\Models\GetYourConsultation;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client; // لو هتبعت واتساب عبر Twilio

class CreateGetYourConsultation extends CreateRecord
{
    protected static string $resource = GetYourConsultationResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;

        // 1️⃣ إرسال رسالة إيميل
        try {
            Mail::raw("
                📩 New Consultation Request
                Name: {$record->name}
                Phone: {$record->mobile_phone}
                Email: {$record->email}
                Message: {$record->message}
            ", function ($message) use ($record) {
                $message->to('youremail@gmail.com')
                        ->subject('New Consultation Request');
            });
        } catch (\Exception $e) {
            info('Mail send failed: ' . $e->getMessage());
        }

        // 2️⃣ إرسال رسالة واتساب (باستخدام Twilio)
        try {
            $sid    = env('TWILIO_SID');
            $token  = env('TWILIO_TOKEN');
            $from   = 'whatsapp:' . env('TWILIO_WHATSAPP_FROM'); // رقم واتساب المرسل
            $to     = 'whatsapp:+201234567890'; // رقمك لاستقبال الرسالة

            $twilio = new Client($sid, $token);
            $twilio->messages->create($to, [
                'from' => $from,
                'body' => "📩 New Consultation Request\nName: {$record->name}\nPhone: {$record->mobile_phone}\nEmail: {$record->email}\nMessage: {$record->message}",
            ]);
        } catch (\Exception $e) {
            info('WhatsApp send failed: ' . $e->getMessage());
        }
    }
}