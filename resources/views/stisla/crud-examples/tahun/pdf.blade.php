<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Laporan Tahunan {{ $selectedYear }}</title>
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

  <div class="header" herf="https://www.google.com">
    <div style="text-align: center; margin-bottom: 20px;">
      <table style="width: 100%; border: none;">
        <tr>
          {{-- Logo Jabar (kiri) --}}
          <td style="width:90px; text-align:right; vertical-align:middle;">
            <img src="{{ public_path($logoJabar) }}" alt="Logo Jabar" style="width:100px">
          </td>

          {{-- Judul (tengah) --}}
          <td style="text-align:center;">
            <h1 style="margin:15;">LAPORAN KEGIATAN USAHA</h1>
            <h1 style="margin:15;">{{ auth()->user()->name ?? '-' }}</h1>
          </td>

          {{-- Logo User (kanan) --}}
          <td style="width:90px; text-align:left; vertical-align:middle;">
            @if ($logoUser)
              <img src="{{ $logoUser }}" style="width:100px; height:auto;" alt="Logo User">
            @endif
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="section">
    <h3>PERIODE :
      <h5>
        TAHUN {{ $selectedYear }}
      </h5>
    </h3>
  </div>

  <div class="section">
    <h3>I. DATA PERUSAHAAN</h3>
    <table>
      <tr>
        <td>Nama Pelaku Usaha/Perusahaan</td>
        <td>:</td>
        <td>{{ auth()->user()->name ?? '-' }}</td>
      </tr>
      <tr>
        <td>Nama Penanggung Jawab</td>
        <td>:</td>
        <td>{{ auth()->user()->name2 ?? '-' }}</td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ auth()->user()->jabatan ?? '-' }}</td>
      </tr>
      <tr>
        <td>NIB</td>
        <td>:</td>
        <td>{{ auth()->user()->nib ?? '-' }}</td>
      </tr>
      <tr>
        <td>Kabupaten</td>
        <td>:</td>
        <td>{{ auth()->user()->address2 ?? '-' }}</td>
      </tr>
      <tr>
        <td>Alamat Lokasi Kantor</td>
        <td>:</td>
        <td>{{ auth()->user()->address ?? '-' }}</td>
      </tr>
      <tr>
        <td>Telepon</td>
        <td>:</td>
        <td>{{ auth()->user()->phone_number ?? '-' }}</td>
      </tr>
      <tr>
        <td>Email</td>
        <td>:</td>
        <td>{{ auth()->user()->email ?? '-' }}</td>
      </tr>
    </table>
  </div>

  {{-- Tabel Sarana --}}
  <div class="table-container">
    <h3>II. Data Sarana dan Prasarana</h3>
    <table>
      <thead>
        <tr>
          <th>Jenis Sarana</th>
          <th class="text-left">Kapasitas (Kg)</th>
          <th>Pengolahan Teknologi</th>
          <th class="text-center">Triwulan</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($saranas as $item)
          <tr>
            <td>{{ $item->jenis_sarana ?? '-' }}</td>
            <td class="text-left">{{ number_format($item->kapasitas, 0, ',', '.') }} Kg</td>
            <td>{{ $item->pengolahan_teknologi ?? '-' }}</td>
            <td class="text-center">{{ $item->triwulan }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center">Tidak ada data.</td>
          </tr>
        @endforelse
      </tbody>
      <tfoot>
        <tr>
          <th>Total Kapasitas</th>
          <td class="text-left">{{ number_format($totalKapasitas, 0, ',', '.') }} Kg</td>
          <td colspan="2"></td>
        </tr>
      </tfoot>
    </table>
  </div>

  {{-- Tabel Tenaga Kerja --}}
  <div class="table-container">
    <h3>III. Data Tenaga Kerja</h3>
    <table>
      <thead>
        <tr>
          <th class="text-left">WNI (Laki-laki)</th>
          <th class="text-left">WNI (Perempuan)</th>
          <th class="text-left">WNA (Laki-laki)</th>
          <th class="text-left">WNA (Perempuan)</th>
          <th class="text-center">Triwulan</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($tenagas as $item)
          <tr>
            <td class="text-left">{{ number_format($item->jumlah_wni_laki, 0, ',', '.') }}</td>
            <td class="text-left">{{ number_format($item->jumlah_wni_perempuan, 0, ',', '.') }}</td>
            <td class="text-left">{{ number_format($item->jumlah_wna_laki, 0, ',', '.') }}</td>
            <td class="text-left">{{ number_format($item->jumlah_wna_perempuan, 0, ',', '.') }}</td>
            <td class="text-center">{{ $item->triwulan }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">Tidak ada data.</td>
          </tr>
        @endforelse
      </tbody>
      <tfoot>
        <tr>
          <th colspan="2" class="text-center">Total Warga Negara Indonesia: {{ number_format($totalWni, 0, ',', '.') }} Orang</th>
          <th colspan="2" class="text-center">Total Warga Negara Asing: {{ number_format($totalWna, 0, ',', '.') }} Orang</th>
          <td></td>
        </tr>
      </tfoot>
    </table>
  </div>

  {{-- Tabel Bahan Baku --}}
  <div class="table-container">
    <h3>IV.Data Bahan Baku</h3>
    <table>
      <thead>
        <tr>
          <th>Jenis Ikan</th>
          <th class="text-left">Volume Bahan Baku (Kg)</th>
          <th>Asal Bahan Baku</th>
          <th class="text-center">Triwulan</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($bahans as $item)
          <tr>
            <td>{{ $item->jenis_ikan ?? '-' }}</td>
            <td class="text-left">{{ number_format($item->volume_bahanbaku, 0, ',', '.') }} Kg</td>
            <td>{{ $item->asal_bahanbaku ?? '-' }}</td>
            <td class="text-center">{{ $item->triwulan }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center">Tidak ada data.</td>
          </tr>
        @endforelse
      </tbody>
      <tfoot>
        <tr>
          <th>Total Volume Bahan Baku</th>
          <td class="text-left">{{ number_format($totalVolumeBahanBaku, 0, ',', '.') }} Kg</td>
          <td colspan="2"></td>
        </tr>
      </tfoot>
    </table>
  </div>

  {{-- Tabel Produk --}}
  {{-- <div class="table-container">
    <h3>V. Data Produk</h3>
    <table>
      <thead>
        <tr>
          <th>Jenis Produk</th>
          <th class="text-left">Volume Produk (Kg)</th>
          <th>Pemasaran</th>
          <th class="text-center">Triwulan</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($produks as $item)
          <tr>
            <td>{{ $item->jenis_produk ?? '-' }}</td>
            <td class="text-left">{{ number_format($item->volume_produk, 0, ',', '.') }} Kg</td>
            <td>{{ $item->pemasaran ?? '-' }}</td>
            <td class="text-center">{{ $item->triwulan }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center">Tidak ada data.</td>
          </tr>
        @endforelse
      </tbody>
      <tfoot>
        <tr>
          <th>Total Volume Produk</th>
          <td class="text-left">{{ number_format($totalVolumeProduk, 0, ',', '.') }} Kg</td>
          <td colspan="2"></td>
        </tr>
      </tfoot>
    </table>
  </div> --}}

  {{-- Tabel Omzet --}}
  <div class="table-container">
    <h3>V. Data Omzet</h3>
    <table>
      <thead>
        <tr>
          <th>Jenis Produk</th>
          <th>Tujuan Domestik</th>
          <th class="text-left">Nilai Domestik (Rp)</th>
          <th class="text-left">Volume Domestik (Kg)</th>
          <th>Tujuan Luar Negeri</th>
          <th class="text-left">Nilai Luar Negeri ($)</th>
          <th class="text-left">Volume Luar Negeri (Kg)</th>
          <th class="text-center">Triwulan</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($omzets as $item)
          <tr>
            <td>{{ $item->jenis_produk ?? '-' }}</td>
            <td>{{ $item->tujuan_domes ?? '-' }}</td>
            <td class="text-left">Rp {{ number_format($item->nilai_domes, 2, ',', '.') }}</td>
            <td class="text-left">{{ number_format($item->volume_domes, 0, ',', '.') }} Kg</td>
            <td>{{ $item->tujuan_luarnegeri ?? '-' }}</td>
            <td class="text-left">$ {{ number_format($item->nilai_luarnegeri, 0, ',', '.') }}</td>
            <td class="text-left">{{ number_format($item->volume_luarnegeri, 0, ',', '.') }} Kg</td>
            <td class="text-center">{{ $item->triwulan }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center">Tidak ada data.</td>
          </tr>
        @endforelse
      </tbody>
      <tfoot>
        <tr>
          <th></th>
          <th>Total Domestik</th>
          <td class="text-left">Rp {{ number_format($totalNilaiDomestik, 2, ',', '.') }}</td>
          <td class="text-left">{{ number_format($totalVolumeDomestik, 0, ',', '.') }} Kg</td>
          <th>Total Luar Negeri</th>
          <td class="text-left">$ {{ number_format($totalNilaiLuarNegeri, 0, ',', '.') }}</td>
          <td class="text-left">{{ number_format($totalVolumeLuarNegeri, 0, ',', '.') }} Kg</td>
          <td></td>
        </tr>
      </tfoot>
    </table>
    <h5>Laporan ini disusun dengan sebenarnya</h5>
  </div>

  {{-- Blok Tanda Tangan --}}
  <div class="signature-block clearfix">
    <div class="signature-content">
      <p>{{ auth()->user()->address2 ?? '' }}, {{ $tanggalExport }}</p>
      <p>Penanggung Jawab,</p>
      <div class="signature-space"></div>
      <p><strong>{{ auth()->user()->name2 ?? '' }}</strong></p>
      <p>{{ auth()->user()->jabatan ?? '' }}</p>
    </div>
  </div>

</body>

</html>
