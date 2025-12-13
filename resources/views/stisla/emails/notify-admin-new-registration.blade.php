<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Registrasi UPI Baru</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:20px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; margin:auto; background:#ffffff; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
        <tr>
            <td style="padding:20px; text-align:center; background:#4CAF50; color:#ffffff; border-radius:8px 8px 0 0;">
                <h2 style="margin:0;">Notifikasi Registrasi UPI Baru</h2>
            </td>
        </tr>
        <tr>
            <td style="padding:20px; color:#333;">
                <p>Halo Admin,</p>
                <p>Ada UPI baru telah melakukan registrasi pada sistem <strong>SiPELIKAN</strong>.</p>

                <table cellpadding="6" cellspacing="0" width="100%" style="border-collapse:collapse; margin-top:15px;">
                    <tr>
                        <td width="30%" style="background:#f2f2f2; border:1px solid #ddd;">Nama UPI</td>
                        <td style="border:1px solid #ddd;">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td width="30%" style="background:#f2f2f2; border:1px solid #ddd;">Email</td>
                        <td style="border:1px solid #ddd;">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td width="30%" style="background:#f2f2f2; border:1px solid #ddd;">Tanggal Registrasi</td>
                        <td style="border:1px solid #ddd;">{{ $user->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                </table>

                <p style="margin-top:20px;">Silakan cek dashboard admin untuk melakukan verifikasi akun UPI ini.</p>
            </td>
        </tr>
        <tr>
            <td style="padding:15px; text-align:center; background:#f2f2f2; font-size:12px; color:#777; border-radius:0 0 8px 8px;">
                Copyright &copy; {{ date('Y') }} <strong>SiPelikan</strong>. All rights reserved
            </td>
        </tr>
    </table>
</body>
</html>
