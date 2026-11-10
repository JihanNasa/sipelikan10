<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
</head>
<body>
    <h2>Halo {{ $user->name ?? 'User' }},</h2>
    <p>Kami menerima permintaan untuk mengatur ulang kata sandi Anda.</p>

    @if($isVerificationCode)
        <p>Kode verifikasi Anda adalah:</p>
        <h3>{{ $user->verification_code ?? 'XXXXXX' }}</h3>
    @else
      <p>Silakan klik link berikut untuk reset password:</p>
      <a href="{{ url('/auth/reset-password/' . $user->email_token) }}">
          Reset Password
      </a>
    @endif

    <p>Jika Anda tidak merasa meminta reset password, abaikan email ini.</p>
</body>
</html>
