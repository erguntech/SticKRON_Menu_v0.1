<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome to Our Platform</title>
    <style>
        /* Inline styles for simplicity, consider using CSS classes for larger templates */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #1f2222;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }

        .message {
            padding: 20px;
            background-color: #ffffff;
        }

        .message p {
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="mb-14" style="text-align: center;">
        <img alt="Logo" src="{{ asset('assets/media/logos/login_logo_dark-01.svg') }}" style="height: 100px; margin-bottom: 10px;"/>
    </div>
    <div class="message">
        <p><strong>Sn. {{ $name }}</strong> SticKRON Digital Menu'ye Hoşgeldiniz!</p>

        <p>Aşağıda bağlantı üzerinden yeni şifrenizi belirleyebilirsiniz.</p>
        <a class="btn btn-sm btn-primary" href="{{ $url }}">
            Şifre Sıfırlama
        </a>
        <p>Stickron ailesi olarak iyi günler dileriz.</p>
    </div>
</div>
</body>

</html>
