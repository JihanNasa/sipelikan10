<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akun Diverifikasi - {{ config('app.name') }}</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      color: #333;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 40px auto;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .header {
      background: #3490dc; /* Biru */
      color: #fff;
      text-align: center;
      padding: 25px;
    }
    .header h1 {
      margin: 0;
      font-size: 22px;
    }
    .content {
      padding: 30px;
      line-height: 1.6;
    }
    .status-box {
      background: #e8f1fb;
      border: 1px solid #3490dc;
      color: #3490dc;
      padding: 15px;
      border-radius: 6px;
      margin: 20px 0;
      font-weight: bold;
      text-align: center;
    }
    .button {
      display: inline-block;
      padding: 12px 20px;
      background-color: #3490dc;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      margin-top: 20px;
      font-weight: bold;
    }
    .footer {
      background: #f9fafb;
      text-align: center;
      padding: 20px;
      font-size: 12px;
      color: #777;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>🎉 Akun Diverifikasi</h1>
    </div>
    <div class="content">
      <p>Halo <strong>{{ $user->name }}</strong>,</p>
      <p>Selamat! Akun Anda telah berhasil <strong>diverifikasi</strong> oleh tim kami. Kini Anda dapat login dan menggunakan seluruh fitur yang tersedia di <strong>SiPelikan</strong>.</p>

      <div class="status-box">
        Status Akun: Diverifikasi ✅
      </div>

      <p style="text-align:center;">
        <a href="{{ route('login') }}" class="button">Login Sekarang</a>
      </p>
    </div>
    <div class="footer">
      <p>Terima kasih telah menggunakan layanan kami.<br>
      Salam hangat,<br>
      Tim SiPelikan</p>
    </div>
  </div>
</body>
</html>
