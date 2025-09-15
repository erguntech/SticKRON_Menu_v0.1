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
        <p><strong>Sn. {{ $emailData['user_name'] }}</strong> Relicwise Admin Center'a Hoşgeldiniz!</p>
        <p>Aşağıda yer alan bilgileri kullanarak sisteme giriş yapabilirsiniz</p>
        <p><strong>Kullanıcı Adı:</strong> {{ $emailData['email'] }}</p>
        <p><strong>Şifre:</strong> {{ $emailData['password'] }}</p>
        <p><strong>Admin Panel Bağlantısı: {{ Settings::get('app_domain') }}</strong></p>
        <p>Relicwise ailesi olarak iyi günler dileriz.</p>
    </div>
</div>
</body>

</html>
