<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi Berhasil - {{ config('app.name') }}</title>
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
      background: #f6993f; /* Oranye hangat */
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
      background: #fff7e6;
      border: 1px solid #f6993f;
      color: #d97706;
      padding: 15px;
      border-radius: 6px;
      margin: 20px 0;
      font-weight: bold;
      text-align: center;
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
      <h1>🙌 Registrasi Berhasil</h1>
    </div>
    <div class="content">
      <p>Halo <strong>{{ $user->name }}</strong>,</p>
      <p>Selamat! Anda berhasil mendaftar di <strong>SiPELIKAN</strong>.</p>

      <div class="status-box">
        Status Akun: Menunggu Verifikasi ⏳
      </div>

      <p>Saat ini akun Anda masih dalam tahap verifikasi. Proses ini dilakukan untuk memastikan keamanan dan validitas data Anda.</p>
      <p>Mohon bersabar ya, kami akan segera mengirimkan notifikasi ketika akun Anda sudah aktif.</p>
    </div>
    <div class="footer">
      <p>Terima kasih telah mendaftar.<br>
      Salam hangat,<br>
      Tim SiPELIKAN</p>
    </div>
  </div>
</body>
</html>
