<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تأكيد التسجيل</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
            direction: rtl;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(120deg, #0d6efd, #198754);
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            color: white;
            margin: 0;
        }

        .content {
            padding: 20px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            color: #777;
        }

        .qr-container {
            text-align: center;
            margin: 20px 0;
        }

        .qr-code {
            border: 1px solid #eee;
            border-radius: 4px;
            padding: 10px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>تأكيد التسجيل في الفعالية</h1>
        </div>

        <div class="content">
            <h2>مرحباً {{ $name }},</h2>
            <p>شكراً لتسجيلك في فعاليتنا. نود تأكيد تفاصيل تسجيلك:</p>

            <ul>
                <li><strong>الفعالية:</strong> المؤتمر التقني السنوي</li>
                <li><strong>التاريخ:</strong> ١٥-١٦ سبتمبر ٢٠٢٥</li>
                <li><strong>المكان:</strong> قاعة المؤتمرات</li>
            </ul>

            <p>يمكنك استخدام رمز QR التالي عند الوصول لتسريع عملية الدخول:</p>

            <div class="qr-container">
                <!-- Use the variable passed to the view -->
                <img src="{{ $message->embed($qrCodePath) }}" alt="رمز QR" width="200" class="qr-code">
            </div>

            <p>يرجى الاحتفاظ بهذا البريد الإلكتروني أو تحميل رمز QR المرفق لتقديمه عند الدخول.</p>

            <div class="footer">
                <p>مع تحيات،</p>
                <p><strong>فريق المنظمين</strong></p>
                <p>contact@events.example.com</p>
            </div>
        </div>
    </div>
</body>

</html>
