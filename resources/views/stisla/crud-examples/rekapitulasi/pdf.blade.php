<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Rekapitulasi Laporan</title>
  <style>
    body {
      font-family: 'Helvetica', 'Arial', sans-serif;
      font-size: 11px;
      /* Ukuran font sedikit lebih kecil untuk landscape */
      color: #333;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header h1 {
      margin: 0;
      font-size: 22px;
    }

    .header h2 {
      margin: 5px 0;
      font-size: 16px;
      font-weight: normal;
    }

    .table-container {
      margin-bottom: 20px;
    }

    h3 {
      font-size: 14px;
      margin-bottom: 5px;
      border-bottom: 1px solid #333;
      padding-bottom: 5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th,
    td {
      border: 1px solid #ccc;
      padding: 6px;
      text-align: left;
      vertical-align: top;
    }

    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    tfoot tr th,
    tfoot tr td {
      font-weight: bold;
      background-color: #e9e9e9;
    }

    .text-right {
      text-align: right;
    }

    .text-center {
      text-align: center;
    }

    .signature-block {
      margin-top: 50px;
      width: 100%;
    }

    .signature-content {
      float: right;
      /* Menggunakan float untuk posisi kanan */
      width: 250px;
      /* Lebar area tanda tangan */
      text-align: center;
    }

    .signature-content p {
      margin: 0;
      line-height: 1.5;
    }

    .signature-space {
      height: 60px;
    }

    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }
  </style>
</head>

<body>

  <div class="header">
    <h1>REKAPITULASI LAPORAN</h1>
  </div>

  @foreach ($availableYears as $year)
    <div class="section">
      <h2>Tahun: {{ $year }}</h2>
    </div>

    {{-- Tabel Sarana --}}
    <div class="table-container">
      <h3>Data Sarana dan Prasarana</h3>
      <table>
        <thead>
          <tr>
            <th>Jenis Sarana</th>
            <th class="text-right">Kapasitas (Kg)</th>
            <th>Pengolahan Teknologi</th>
          </tr>
        </thead>
        <tbody>
          @php
            $totalKapasitas = 0;
          @endphp
          @forelse ($rekapData[$year]['sarana_data'] as $item)
            <tr>
              <td>{{ $item->jenis_sarana ?? '-' }}</td>
              <td class="text-right">{{ number_format($item->kapasitas, 0, ',', '.') }}</td>
              <td>{{ $item->pengolahan_teknologi ?? '-' }}</td>
            </tr>
            @php
              $totalKapasitas += $item->kapasitas ?? 0;
            @endphp
          @empty
            <tr>
              <td colspan="3" class="text-center">Tidak ada data.</td>
            </tr>
          @endforelse
        </tbody>
        <tfoot>
          <tr>
            <th>TOTAL KAPASITAS</th>
            <td class="text-right">{{ number_format($totalKapasitas, 0, ',', '.') }}</td>
            <td></td>
          </tr>
        </tfoot>
      </table>
    </div>

    {{-- Tabel Tenaga Kerja --}}
    <div class="table-container">
      <h3>Data Tenaga Kerja</h3>
      <table>
        <thead>
          <tr>
            <th class="text-right">WNI (Laki-laki)</th>
            <th class="text-right">WNI (Perempuan)</th>
            <th class="text-right">WNA (Laki-laki)</th>
            <th class="text-right">WNA (Perempuan)</th>
          </tr>
        </thead>
        <tbody>
          @php
            $totalWniLaki = 0;
            $totalWniPerempuan = 0;
            $totalWnaLaki = 0;
            $totalWnaPerempuan = 0;
          @endphp
          @forelse ($rekapData[$year]['tenaga_data'] as $item)
            <tr>
              <td class="text-right">{{ number_format($item->jumlah_wni_laki, 0, ',', '.') }}</td>
              <td class="text-right">{{ number_format($item->jumlah_wni_perempuan, 0, ',', '.') }}</td>
              <td class="text-right">{{ number_format($item->jumlah_wna_laki, 0, ',', '.') }}</td>
              <td class="text-right">{{ number_format($item->jumlah_wna_perempuan, 0, ',', '.') }}</td>
            </tr>
            @php
              $totalWniLaki += $item->jumlah_wni_laki ?? 0;
              $totalWniPerempuan += $item->jumlah_wni_perempuan ?? 0;
              $totalWnaLaki += $item->jumlah_wna_laki ?? 0;
              $totalWnaPerempuan += $item->jumlah_wna_perempuan ?? 0;
            @endphp
          @empty
            <tr>
              <td colspan="4" class="text-center">Tidak ada data.</td>
            </tr>
          @endforelse
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2" class="text-center">Total WNI: {{ number_format($totalWniLaki + $totalWniPerempuan, 0, ',', '.') }} Orang</th>
            <th colspan="2" class="text-center">Total WNA: {{ number_format($totalWnaLaki + $totalWnaPerempuan, 0, ',', '.') }} Orang</th>
          </tr>
        </tfoot>
      </table>
    </div>

    {{-- Tabel Bahan Baku --}}
    <div class="table-container">
      <h3>Data Bahan Baku</h3>
      <table>
        <thead>
          <tr>
            <th>Jenis Ikan</th>
            <th class="text-right">Volume Bahan Baku (Kg)</th>
            <th>Asal Bahan Baku</th>
          </tr>
        </thead>
        <tbody>
          @php
            $totalVolumeBahanBaku = 0;
          @endphp
          @forelse ($rekapData[$year]['bahan_data'] as $item)
            <tr>
              <td>{{ $item->jenis_ikan ?? '-' }}</td>
              <td class="text-right">{{ number_format($item->volume_bahanbaku, 0, ',', '.') }}</td>
              <td>{{ $item->asal_bahanbaku ?? '-' }}</td>
            </tr>
            @php
              $totalVolumeBahanBaku += $item->volume_bahanbaku ?? 0;
            @endphp
          @empty
            <tr>
              <td colspan="3" class="text-center">Tidak ada data.</td>
            </tr>
          @endforelse
        </tbody>
        <tfoot>
          <tr>
            <th>TOTAL VOLUME BAHAN BAKU</th>
            <td class="text-right">{{ number_format($totalVolumeBahanBaku, 0, ',', '.') }}</td>
            <td></td>
          </tr>
        </tfoot>
      </table>
    </div>

    {{-- Tabel Produk --}}
    <div class="table-container">
      <h3>Data Produk</h3>
      <table>
        <thead>
          <tr>
            <th>Jenis Produk</th>
            <th class="text-right">Volume Produk (Kg)</th>
            <th>Pemasaran</th>
          </tr>
        </thead>
        <tbody>
          @php
            $totalVolumeProduk = 0;
          @endphp
          @forelse ($rekapData[$year]['produk_data'] as $item)
            <tr>
              <td>{{ $item->jenis_produk ?? '-' }}</td>
              <td class="text-right">{{ number_format($item->volume_produk, 0, ',', '.') }}</td>
              <td>{{ $item->pemasaran ?? '-' }}</td>
            </tr>
            @php
              $totalVolumeProduk += $item->volume_produk ?? 0;
            @endphp
          @empty
            <tr>
              <td colspan="3" class="text-center">Tidak ada data.</td>
            </tr>
          @endforelse
        </tbody>
        <tfoot>
          <tr>
            <th>TOTAL VOLUME PRODUK</th>
            <td class="text-right">{{ number_format($totalVolumeProduk, 0, ',', '.') }}</td>
            <td></td>
          </tr>
        </tfoot>
      </table>
    </div>

    {{-- Tabel Omzet --}}
    <div class="table-container">
      <h3>Data Omzet</h3>
      <table>
        <thead>
          <tr>
            <th>Tujuan Domestik</th>
            <th class="text-right">Nilai Domestik (Rp)</th>
            <th class="text-right">Volume Domestik (Kg)</th>
            <th>Tujuan Luar Negeri</th>
            <th class="text-right">Nilai Luar Negeri ($)</th>
            <th class="text-right">Volume Luar Negeri (Kg)</th>
          </tr>
        </thead>
        <tbody>
          @php
            $totalNilaiDomestik = 0;
            $totalVolumeDomestik = 0;
            $totalNilaiLuarNegeri = 0;
            $totalVolumeLuarNegeri = 0;
          @endphp
          @forelse ($rekapData[$year]['omzet_data'] as $item)
            <tr>
              <td>{{ $item->tujuan_domes ?? '-' }}</td>
              <td class="text-right">{{ number_format($item->nilai_domes, 2, ',', '.') }}</td>
              <td class="text-right">{{ number_format($item->volume_domes, 0, ',', '.') }}</td>
              <td>{{ $item->tujuan_luarnegeri ?? '-' }}</td>
              <td class="text-right">{{ number_format($item->nilai_luarnegeri, 0, ',', '.') }}</td>
              <td class="text-right">{{ number_format($item->volume_luarnegeri, 0, ',', '.') }}</td>
            </tr>
            @php
              $totalNilaiDomestik += $item->nilai_domes ?? 0;
              $totalVolumeDomestik += $item->volume_domes ?? 0;
              $totalNilaiLuarNegeri += $item->nilai_luarnegeri ?? 0;
              $totalVolumeLuarNegeri += $item->volume_luarnegeri ?? 0;
            @endphp
          @empty
            <tr>
              <td colspan="6" class="text-center">Tidak ada data.</td>
            </tr>
          @endforelse
        </tbody>
        <tfoot>
          <tr>
            <th>TOTAL DOMESTIK</th>
            <td class="text-right">Rp {{ number_format($totalNilaiDomestik, 2, ',', '.') }}</td>
            <td class="text-right">{{ number_format($totalVolumeDomestik, 0, ',', '.') }} Kg</td>
            <th>TOTAL LUAR NEGERI</th>
            <td class="text-right">$ {{ number_format($totalNilaiLuarNegeri, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($totalVolumeLuarNegeri, 0, ',', '.') }} Kg</td>
          </tr>
        </tfoot>
      </table>
    </div>
    {{-- Blok Tanda Tangan --}}
    <div class="signature-block clearfix">
      <div class="signature-content">
        <p>{{ auth()->user()->address2 ?? '' }}, {{ $tanggalExport }}</p>
        <p>Penanggung Jawab,</p>
        <div class="signature-space"></div>
        <p><strong><u>{{ auth()->user()->name2 ?? '' }}</u></strong></p>
      </div>
    </div>
  @endforeach

</body>

</html>
