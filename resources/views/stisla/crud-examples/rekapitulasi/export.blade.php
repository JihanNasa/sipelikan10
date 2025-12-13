<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Rekapitulasi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2, h3, h5, h6 { text-align: center; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
        th, td { border: 1px solid #333; padding: 8px; }
        th { background: #f2f2f2; font-weight: bold; text-align: center; }
        .table-title { text-align: center; font-size: 18px; font-weight: bold; margin: 20px 0 10px 0; }
        .triwulan-list { margin-bottom: 20px; }
        .triwulan-list td { border: none; }
    </style>
</head>
<body>
    <h2>Laporan Rekapitulasi Laporan Keseluruhan</h2>
    <p><strong>{{ $sumberData }}</strong></p>
    <hr>

    @forelse ($availableYears as $year)
        <h3 class="table-title">Tahun {{ $year }}</h3>
        <h4>Ringkasan Tahunan</h4>
        <table>
            <thead>
                <tr>
                    <th>Jenis Sarana</th>
                    <th>Kapasitas</th>
                    <th>Pengolahan Teknologi</th>
                    <th>WNI (L)</th>
                    <th>WNI (P)</th>
                    <th>WNA (L)</th>
                    <th>WNA (P)</th>
                    <th>Total Tenaga Kerja</th>
                    <th>Jenis Ikan</th>
                    <th>Total Volume Bahan Baku</th>
                    <th>Asal Bahan Baku</th>
                    <th>Jenis Produk</th>
                    <th>Total Volume Produk</th>
                    <th>Pemasaran</th>
                    <th>Jenis Produk</th>
                    <th>Tujuan Domestik</th>
                    <th>Total Nilai Omzet Domestik</th>
                    <th>Total Volume Omzet Domestik</th>
                    <th>Tujuan Luar Negeri</th>
                    <th>Total Nilai Omzet Luar Negeri</th>
                    <th>Total Volume Omzet Luar Negeri</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $tenaga = $rekapData[$year]['tenaga_data'];
                    $sarana = $rekapData[$year]['sarana_data'];
                    $bahan = $rekapData[$year]['bahan_data'];
                    $produk = $rekapData[$year]['produk_data'];
                    $omzet = $rekapData[$year]['omzet_data'];
                    $max = max(
                        $sarana->count(),
                        $tenaga->count(),
                        $bahan->count(),
                        $produk->count(),
                        $omzet->count(),
                        1
                    );
                @endphp
                @for ($i = 0; $i < $max; $i++)
                    <tr>
                        <td>{{ $sarana[$i]->jenis_sarana ?? '-' }}</td>
                        <td>{{ $sarana[$i]->kapasitas ?? '-' }}</td>
                        <td>{{ $sarana[$i]->pengolahan_teknologi ?? '-' }}</td>
                        <td>{{ $tenaga[$i]->jumlah_wni_laki ?? '-' }}</td>
                        <td>{{ $tenaga[$i]->jumlah_wni_perempuan ?? '-' }}</td>
                        <td>{{ $tenaga[$i]->jumlah_wna_laki ?? '-' }}</td>
                        <td>{{ $tenaga[$i]->jumlah_wna_perempuan ?? '-' }}</td>
                        <td>
                            @if(isset($tenaga[$i]))
                                {{ number_format(
                                    ($tenaga[$i]->jumlah_wni_laki ?? 0) +
                                    ($tenaga[$i]->jumlah_wni_perempuan ?? 0) +
                                    ($tenaga[$i]->jumlah_wna_laki ?? 0) +
                                    ($tenaga[$i]->jumlah_wna_perempuan ?? 0)
                                ) }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $bahan[$i]->jenis_ikan ?? '-' }}</td>
                        <td>{{ isset($bahan[$i]) ? number_format($bahan[$i]->volume_bahanbaku,0) : '-' }}</td>
                        <td>{{ $bahan[$i]->asal_bahanbaku ?? '-' }}</td>
                        <td>{{ $produk[$i]->jenis_produk ?? '-' }}</td>
                        <td>{{ isset($produk[$i]) ? number_format($produk[$i]->volume_produk,0) : '-' }}</td>
                        <td>{{ $produk[$i]->pemasaran ?? '-' }}</td>
                        <td>{{ $omzet[$i]->jenis_produk ?? '-' }}</td>
                        <td>{{ $omzet[$i]->tujuan_domes ?? '-' }}</td>
                        <td>{{ isset($omzet[$i]) ? number_format($omzet[$i]->nilai_domes,2) : '-' }}</td>
                        <td>{{ isset($omzet[$i]) ? number_format($omzet[$i]->volume_domes,0) : '-' }}</td>
                        <td>{{ $omzet[$i]->tujuan_luarnegeri ?? '-' }}</td>
                        <td>{{ isset($omzet[$i]) ? number_format($omzet[$i]->nilai_luarnegeri,0) : '-' }}</td>
                        <td>{{ isset($omzet[$i]) ? number_format($omzet[$i]->volume_luarnegeri,0) : '-' }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <h4>Detail per Triwulan</h4>
        <table class="triwulan-list">
            <thead>
                <tr>
                    <th>Triwulan</th>
                    <th>Total Volume Bahan Baku</th>
                    <th>Total Nilai Omzet Domestik</th>
                    <th>Total Volume Omzet Domestik</th>
                    <th>Total Nilai Omzet Luar Negeri</th>
                    <th>Total Volume Omzet Luar Negeri</th>
                    <th>Total Tenaga Kerja</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 4; $i++)
                    <tr>
                        <td style="text-align: center;">{{ $i }}</td>
                        <td style="text-align: right;">{{ number_format($rekapData[$year]['triwulan_data'][$i]['bahan_baku'], 0) }}</td>
                        <td style="text-align: right;">Rp {{ number_format($rekapData[$year]['triwulan_data'][$i]['omzet_domes'], 2) }}</td>
                        <td style="text-align: right;">{{ number_format($rekapData[$year]['triwulan_data'][$i]['volume_omzet_domes'] ?? 0, 0) }}</td>
                        <td style="text-align: right;">$ {{ number_format($rekapData[$year]['triwulan_data'][$i]['omzet_luarnegeri'], 0) }}</td>
                        <td style="text-align: right;">{{ number_format($rekapData[$year]['triwulan_data'][$i]['volume_omzet_luarnegeri'] ?? 0, 0) }}</td>
                        <td style="text-align: right;">{{ number_format($rekapData[$year]['triwulan_data'][$i]['tenaga_kerja']) }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
        <hr>
    @empty
        <div>Tidak ada data rekapitulasi yang tersedia.</div>
    @endforelse
</body>
</html>
