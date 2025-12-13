<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akun Dinonaktifkan - {{ config('app.name') }}</title>
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
      background: #e3342f;
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
      background: #fbeaea;
      border: 1px solid #e3342f;
      color: #e3342f;
      padding: 15px;
      border-radius: 6px;
      margin: 20px 0;
      font-weight: bold;
      text-align: center;
    }
    .reason-box {
      background: #f9fafb;
      border-left: 4px solid #e3342f;
      padding: 15px;
      margin: 20px 0;
      font-style: italic;
      color: #444;
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
      <h1>🚫 Akun Dinonaktifkan</h1>
    </div>
    <div class="content">
      <p>Halo <strong>{{ $user->name }}</strong>,</p>
      <p>Kami informasikan bahwa akun Anda pada sistem <strong>SiPELIKAN</strong> telah <strong>dinonaktifkan</strong> oleh admin.</p>

      <div class="status-box">
        Status Akun: Tidak Aktif ❌
      </div>

      @if(isset($reason) && $reason)
      <div class="reason-box">
        <strong>Alasan Penonaktifan:</strong><br>
        {{ $reason }}
      </div>
      @endif

      <p>Jika menurut Anda ini adalah kesalahan atau masih ada pertanyaan, silakan hubungi tim admin kami untuk klarifikasi lebih lanjut.</p>

      <p style="text-align:center;">
        <a href="mailto:sipelikan.dkpjabar@gmail.com?subject=Klarifikasi Akun SiPELIKAN&body=Halo Tim SiPELIKAN,%0D%0A%0D%0ASaya ingin melakukan klarifikasi terkait status akun saya." 
           class="button">
           Klarifikasi via Email
        </a>
      </p>
      <p><em>Catatan: Anda tidak akan dapat mengakses sistem SiPELIKAN sampai akun Anda diaktifkan kembali.</em></p>      
    </div>
    <div class="footer">
      <p>Terima kasih telah menggunakan layanan kami.<br>
      Salam hangat,<br>
      Tim SiPELIKAN</p>
    </div>
  </div>
</body>
</html>
