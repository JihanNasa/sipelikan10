<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Penolakan Verifikasi Akun</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 30px;">
    <div style="max-width: 600px; margin: auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
        
        <div style="background: #dc3545; color: #fff; padding: 20px; text-align: center;">
            <h2 style="margin: 0;">Verifikasi Akun Ditolak</h2>
        </div>

        <div style="padding: 20px; color: #333;">
            <p>Halo <strong>{{ $user->name }}</strong>,</p>
            <p>Terima kasih telah melakukan registrasi pada sistem <strong>SiPelikan</strong>. 
               Namun, setelah dilakukan pemeriksaan data, akun Anda <span style="color: #dc3545; font-weight: bold;">tidak dapat diverifikasi</span>.</p>

            <p><strong>Alasan penolakan:</strong></p>
            <blockquote style="border-left: 4px solid #dc3545; padding: 10px 15px; margin: 10px 0; background: #f8d7da; color: #721c24;">
                {{ $reason }}
            </blockquote>

            <p>Silakan melakukan registrasi ulang dengan memperbaiki data sesuai ketentuan.</p>
        </div>

        <div style="background: #f1f1f1; padding: 15px; text-align: center; font-size: 12px; color: #666;">
          Copyright &copy; {{ date('Y') }} <strong>SiPelikan</strong>. All rights reserved
        </div>
    </div>
</body>
</html>
