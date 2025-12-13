<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akun Diaktifkan - {{ config('app.name') }}</title>
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
      background: #38c172;
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
      background: #e6f4ea;
      border: 1px solid #38c172;
      color: #38c172;
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
      <h1>✅ Akun Diaktifkan</h1>
    </div>
    <div class="content">
      <p>Halo <strong>{{ $user->name }}</strong>,</p>
      <p>Kami dengan senang hati menginformasikan bahwa akun Anda pada sistem <strong>SiPELIKAN</strong> telah <strong>diaktifkan kembali</strong> oleh admin.</p>

      <div class="status-box">
        Status Akun: Aktif ✅
      </div>

      <p>Sekarang Anda sudah bisa login kembali dan menggunakan seluruh fitur yang tersedia di aplikasi.</p>

      <p style="text-align:center;">
        <a href="{{ route('login') }}" class="button">Login ke SiPELIKAN</a>
      </p>
    </div>
    <div class="footer">
      <p>Terima kasih telah menggunakan layanan kami.<br>
      Salam hangat,<br>
      Tim SiPELIKAN</p>
    </div>
  </div>
</body>
</html>
