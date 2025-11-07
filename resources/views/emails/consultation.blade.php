<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'رد على الاستشارة' }}</title>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #007bff; text-align: center; }
        p { margin-bottom: 15px; }
        .greeting { font-size: 18px; font-weight: bold; }
        .content { background: #f8f9fa; padding: 15px; border-radius: 5px; border-right: 4px solid #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $subject ?? 'رد على طلب الاستشارة' }}</h1>

        <p class="greeting">مرحبًا {{ $record->name ?? 'العميل العزيز' }}،</p>

        <p><strong>الإيميل:</strong> {{ $record->email ?? '' }}</p>
        <p><strong>الهاتف:</strong> {{ $record->mobile_phone ?? '' }}</p>
        <p><strong>الرسالة الأصلية:</strong><br>{{ $record->message ?? 'لم يتم إضافة رسالة.' }}</p>

        <hr>

        <h2>ردنا عليك:</h2>
        <div class="content">
            {!! $messageContent ?? 'لم يتم إضافة رد بعد.' !!}
        </div>

        <p>تحياتنا !<br>فريق Qualixce</p>
    </div>
</body>
</html>
