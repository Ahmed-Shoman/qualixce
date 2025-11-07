<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'رد على طلب الاستشارة' }}</title>
</head>
<body style="margin: 0; padding: 0; font-family: Tahoma, Arial, sans-serif; background-color: #f4f4f4; line-height: 1.6; color: #333333; direction: ltr; text-align: left;"> <!-- LTR للـ layout عشان ميعكسش -->
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 600px;">
                    <!-- Header - فوق دائماً، مع الـ subject -->
                    <tr>
                        <td style="background-color: #007bff; padding: 30px; text-align: center; color: #ffffff; border-radius: 10px 10px 0 0;">
                            <h1 style="margin: 0; font-size: 24px;">{{ $subject ?? 'رد على استشارتك' }}</h1>
                            <p style="margin: 10px 0 0 0; font-size: 14px; direction: rtl;">Qualixce</p> <!-- RTL للنص العربي فقط -->
                        </td>
                    </tr>
                    <!-- Body - المحتوى تحت -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 18px; color: #007bff; margin-bottom: 20px; direction: rtl; text-align: right;">مرحبًا {{ $record->name ?? 'العميل العزيز' }}،</p>

                            <!-- Info Box - بدون original message -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; margin: 15px 0;">
                                <tr>
                                    <td style="padding: 15px;">
                                        <p style="margin: 5px 0; direction: rtl; text-align: right;"><strong>الإيميل:</strong> {{ $record->email ?? '' }}</p>
                                        <p style="margin: 5px 0; direction: rtl; text-align: right;"><strong>الهاتف:</strong> {{ $record->mobile_phone ?? '' }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Reply Box - المحتوى الرئيسي -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #e3f2fd; border: 1px solid #007bff; border-radius: 8px; margin: 20px 0;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <h2 style="margin: 0 0 10px 0; color: #007bff;">ردنا عليك:</h2>
                                        <p style="margin: 0; white-space: pre-line; direction: rtl; text-align: right;">{{ $messageContent ?? 'لم يتم إضافة رد بعد.' }}</p> <!-- RTL و pre-line للسطور -->
                                    </td>
                                </tr>
                            </table>

                            <!-- Button -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 20px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="mailto:{{ $record->email ?? '' }}?subject=رد على ردك&body=شكراً لردك،..." style="background-color: #28a745; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">رد سريع</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px; text-align: center; font-size: 12px; color: #6c757d; border-top: 1px solid #dee2e6; border-radius: 0 0 10px 10px;">
                            <p style="direction: rtl;">شكراً لثقتك بـ Qualixce! | <a href="https://your-site.com" style="color: #007bff;">زور موقعنا</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
