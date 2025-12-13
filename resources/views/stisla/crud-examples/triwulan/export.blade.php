<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Triwulan {{ $triwulan }} Tahun {{ $tahun }}</title>
</head>
<body>
    <h2 style="text-align: center;">Laporan Triwulan {{ $triwulan }} Tahun {{ $tahun }}</h2>
    <p><strong>{{ $sumberData }}</strong></p>
    <hr>

    {{-- SARANA --}}
    <h3 style="text-align: center;">Data Sarana</h3>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr style="font-weight: bold; text-align: center;">
                <th>Jenis Sarana</th>
                <th>Kapasitas (Kg)</th>
                <th>Pengolahan Teknologi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($saranas as $sarana)
                <tr>
                    <td>{{ $sarana->jenis_sarana }}</td>
                    <td>{{ $sarana->kapasitas }}</td>
                    <td>{{ $sarana->pengolahan_teknologi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    {{-- TENAGA --}}
    <h3 style="text-align: center;">Data Tenaga Kerja</h3>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr style="font-weight: bold; text-align: center;">
                <th>WNI (L)</th>
                <th>WNI (P)</th>
                <th>WNA (L)</th>
                <th>WNA (P)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenagas as $tenaga)
                <tr>
                    <td>{{ $tenaga->jumlah_wni_laki }}</td>
                    <td>{{ $tenaga->jumlah_wni_perempuan }}</td>
                    <td>{{ $tenaga->jumlah_wna_laki }}</td>
                    <td>{{ $tenaga->jumlah_wna_perempuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    {{-- BAHAN --}}
    <h3 style="text-align: center;">Data Bahan Baku</h3>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr style="font-weight: bold; text-align: center;">
                <th>Jenis Ikan</th>
                <th>Volume Bahan Baku (Kg)</th>
                <th>Asal Bahan Baku</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bahans as $bahan)
                <tr>
                    <td>{{ $bahan->jenis_ikan }}</td>
                    <td>{{ $bahan->volume_bahanbaku }}</td>
                    <td>{{ $bahan->asal_bahanbaku }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    {{-- OMZET --}}
    <h3 style="text-align: center;">Data Omzet</h3>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr style="font-weight: bold; text-align: center;">
                <th>Jenis Produk</th>
                <th>Tujuan Domestik</th>
                <th>Nilai Domestik (Rp)</th>
                <th>Volume Domestik (Kg)</th>
                <th>Tujuan Luar Negeri</th>
                <th>Nilai Luar Negeri ($)</th>
                <th>Volume Luar Negeri (Kg)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($omzets as $omzet)
                <tr>
                    <td>{{ $omzet->jenis_produk }}</td>
                    <td>{{ $omzet->tujuan_domes }}</td>
                    <td>{{ number_format($omzet->nilai_domes, 2, ',', '.') }}</td>
                    <td>{{ $omzet->volume_domes }}</td>
                    <td>{{ $omzet->tujuan_luarnegeri }}</td>
                    <td>{{ number_format($omzet->nilai_luarnegeri, 0, ',', '.') }}</td>
                    <td>{{ $omzet->volume_luarnegeri }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
