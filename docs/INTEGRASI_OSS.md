# Integrasi Cek NIB OSS RBA (JELITA DPMPTSP via SPLPD Jabar)

SiPelikan mengecek NIB UPI ke data OSS RBA melalui API **JELITA** milik DPMPTSP Jawa Barat,
yang diakses lewat **SPLPD Jawa Barat**.

## Cara kerja singkat

| Lapisan | File |
|---|---|
| Antarmuka | `resources/views/stisla/auth/register/index.blade.php` (cek otomatis saat NIB 13 digit diketik), `resources/views/stisla/verifikasi/_oss-status.blade.php` (kolom Status OSS + tombol Cek OSS) |
| Pintu masuk | Route `POST /oss/cek-nib` (`OssNibController`, dibatasi `OSS_RATE_PER_MINUTE` per IP), aturan `App\Rules\NibTerdaftarOss`, route `POST /verifikasi/{id}/cek-oss` |
| Layanan | `App\Services\Oss\OssService` (cache, riwayat `oss_check_logs`, simpan ke kolom `oss_*` tabel `users`) |
| Driver | `DisabledOssClient`, `DummyOssClient`, `JelitaOssClient`; dipilih lewat `OSS_DRIVER` |
| Terjadwal | `php artisan oss:cek-ulang`, otomatis tiap tanggal 1 pukul 02.00 WIB (`routes/console.php`) |

Perilaku yang disepakati: **NIB yang tidak ditemukan tetap boleh mendaftar, tetapi ditandai untuk dicek admin**
(`OSS_STRICT=false`). Gangguan layanan OSS/SPLP tidak pernah menghalangi registrasi.

## Pengaturan `.env` di server

```
OSS_DRIVER=api                 # disabled | dummy | api
OSS_STRICT=false
OSS_CACHE_MINUTES=720
OSS_RATE_PER_MINUTE=10
OSS_TIMEOUT=10
OSS_JELITA_BASE_URL=https://api-splp.layanan.go.id/t/jabarprov.go.id
OSS_JELITA_PATH=/dpmptsp-jelita/1.00/nib/proyek/
OSS_JELITA_APIKEY=<apikey SPLP dari environment Postman>
OSS_JELITA_TOKEN=<JELITA-TOKEN dari environment Postman>
```

**Kredensial hanya ditulis di `.env` server. Jangan di-commit ke GitHub/GitLab.**

## Langkah pemasangan di VM

1. Backup database terlebih dahulu.
2. `git pull` branch ini, lalu `php artisan migrate`
   (menambah kolom `oss_*` di `users` dan tabel `oss_check_logs`; kolom `nib`, `name2`, `jabatan`, `address2`
   hanya ditambahkan bila belum ada).
3. Mulai dengan `OSS_DRIVER=dummy` untuk mencoba tampilan, lalu `php artisan config:clear`.
4. Ganti ke `OSS_DRIVER=api`, isi kredensial, `php artisan config:clear`.
5. Uji satu NIB: `php artisan oss:cek-ulang --user=<id>`.
6. Agar cek ulang bulanan berjalan, pastikan cron berikut ada:
   `* * * * * cd /home/ubuntu/sipelikan && php artisan schedule:run >> /dev/null 2>&1`

## Hal yang belum terkonfirmasi dari DPMPTSP

- Bentuk respons bila NIB **tidak ditemukan**. Saat ini dianggap tidak ditemukan bila HTTP 404,
  atau `data` kosong, atau `status` bukan `success`.
- Bila satu NIB memiliki **banyak proyek**, apakah `data` berupa daftar. Saat ini diambil proyek pertama.
- Respons tidak memuat **status aktif NIB** dan **alamat lengkap**; yang tersedia hanya kab/kota.
- Field `kbli` dikirim sebagai angka sehingga nol di depan hilang (contoh `1499` = KBLI `01499`);
  aplikasi menambahkan nol di depan hingga 5 digit.

## Pengujian

```
DB_CONNECTION=sqlite DB_DATABASE=:memory: php artisan test --filter=OssNibTest
```

Pengujian memakai respons tiruan (`Http::fake`) dengan data fiktif; tidak ada panggilan ke server SPLP.
