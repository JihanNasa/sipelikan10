@extends('stisla.layouts.app-table')

@section('title')
  {{ $title = 'Laporan UPI' }}
@endsection

@section('content')
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
      <div class="breadcrumb-item">{{ $title }}</div>
    </div>
  </div>

  <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>Informasi untuk kamu!:</strong><br>
    Daftar UPI di bawah ini berfungsi untuk memantau status pelaporan setiap UPI (Unit Pengolahan Ikan) pada periode <b>tahun</b> dan <b>triwulan</b> yang dipilih.<br>
    <ul class="mb-1">
      <li><b>UPI Sudah Membuat Laporan</b>: UPI yang telah melengkapi seluruh laporan (Sarana & Prasarana, Tenaga Kerja, Bahan Baku, dan Omzet) pada triwulan tersebut.</li>
      <li><b>UPI Belum Lengkap Membuat Laporan</b>: UPI yang sudah mengisi sebagian laporan, namun belum lengkap pada triwulan tersebut.</li>
      <li><b>UPI Belum Membuat Laporan</b>: UPI yang sama sekali belum mengisi laporan apapun pada triwulan tersebut.</li>
    </ul>
    <span class="mb-1"> <b>Progress Laporan Setiap UPI</b> ini <b>berdasarkan periode triwulan</b> yang dipilih pada filter di atas. Silakan pilih tahun dan triwulan untuk melihat status pelaporan user
      pada periode tersebut.</span>
    <span class="mb-1"> Untuk melihat data laporan UPI kamu bisa mengklik pada <b>Status Laporan</b> di daftar tabel <b>Progress Laporan Setiap UPI</b> .</span>

  </div>


  <div class="row">
    <div class="col-12 mb-4">
      {{-- MODIFIKASI: Menggunakan class flexbox untuk layout form yang lebih baik --}}
      <form method="GET" class="d-flex flex-wrap align-items-center">
        <div class="form-group mb-2 mr-3">
          <label for="tahun" class="mr-2">Tahun:</label>
          <select name="tahun" id="tahun" class="form-control">
            @for ($y = date('Y') - 2; $y <= date('Y') + 1; $y++)
              <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
          </select>
        </div>
        <div class="form-group mb-2 mr-3">
          <label for="triwulan" class="mr-2">Triwulan:</label>
          <select name="triwulan" id="triwulan" class="form-control">
            @for ($t = 1; $t <= 4; $t++)
              <option value="{{ $t }}" {{ $triwulan == $t ? 'selected' : '' }}>Triwulan {{ $t }}</option>
            @endfor
          </select>
        </div>

        {{-- BAGIAN BARU: Filter UPI untuk Admin/Superadmin --}}
        @if (auth()->user()->hasAnyRole(['superadmin', 'admin']))
          <div class="form-group mb-2 mr-3">
            <label for="user_id" class="mr-2">UPI:</label>
            <select name="user_id" id="user_id" class="form-control" style="width: 200px;">
              <option value="">Semua UPI</option>
              @foreach ($upiUsers as $upi)
                <option value="{{ $upi->id }}" {{ $selectedUpiId == $upi->id ? 'selected' : '' }}>
                  {{ $upi->name }}
                </option>
              @endforeach
            </select>
          </div>
        @endif
        <div class="form-group mb-2">
          <button type="submit" class="btn btn-primary">Filter</button>
        </div>
      </form>
    </div>
    @push('css')
      <style>
        .scrollable-user-list {
          max-height: 220px;
          overflow-y: auto;
        }

        .card-body {
          min-height: 260px;
        }

        .scrollable-user-list::-webkit-scrollbar {
          width: 8px;
          background: #f1f1f1;
          border-radius: 8px;
        }

        .scrollable-user-list::-webkit-scrollbar-thumb {
          background: #bdbdbd;
          border-radius: 8px;
        }

        .scrollable-user-list::-webkit-scrollbar-thumb:hover {
          background: #888;
        }
      </style>
    @endpush

    <div class="row">
      <div class="col-md-4">
        <div class="card card-success" style="height: 100%;">
          <div class="card-header">
            <h4>User Sudah Membuat Laporan</h4>
          </div>
          <div class="card-body">
            <div class="scrollable-user-list">
              @if ($userSudahLapor->count())
                <ul class="list-group">
                  @foreach ($userSudahLapor as $user)
                    <li class="list-group-item">
                      {{-- MODIFIKASI: Route diubah ke laporan tahunan --}}
                      <a href="{{ route('tahun.index', ['user_id' => $user->id, 'tahun' => $tahun]) }}" target="_blank" class="text-decoration-none">
                          {{ $user->name }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              @else
                <p class="text-muted">Belum ada user yang membuat laporan lengkap pada periode ini.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-warning" style="height: 100%;">
          <div class="card-header">
            <h4>User Belum Lengkap Membuat Laporan</h4>
          </div>
          <div class="card-body">
            <div class="scrollable-user-list">
              @if ($userBelumLengkapLapor->count())
                <ul class="list-group">
                  @foreach ($userBelumLengkapLapor as $user)
                    <li class="list-group-item">
                      {{-- MODIFIKASI: Route diubah ke laporan tahunan --}}
                      <a href="{{ route('tahun.index', ['user_id' => $user->id, 'tahun' => $tahun]) }}" target="_blank" class="text-decoration-none">
                          {{ $user->name }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              @else
                <p class="text-muted">Tidak ada user yang belum lengkap membuat laporan pada periode ini.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-danger" style="height: 100%;">
          <div class="card-header">
            <h4>User Belum Membuat Laporan</h4>
          </div>
          <div class="card-body">
            <div class="scrollable-user-list">
              @if ($userBelumLapor->count())
                <ul class="list-group">
                  @foreach ($userBelumLapor as $user)
                    <li class="list-group-item">
                      {{-- MODIFIKASI: Route diubah ke laporan tahunan --}}
                      <a href="{{ route('tahun.index', ['user_id' => $user->id, 'tahun' => $tahun]) }}" target="_blank" class="text-decoration-none">
                          {{ $user->name }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              @else
                <p class="text-muted">Semua user sudah membuat laporan pada periode ini.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 mt-4">
      <div class="card">
        <div class="card-header">
          <h4>Progress Laporan Setiap UPI</h4>
        </div>
        <div class="card-body table-responsive">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              Show
              <select id="showEntriesUpi" class="custom-select custom-select-sm" style="width:auto; display:inline-block;">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select>
              entries
            </div>
            <div style="width: 250px;">
              <input type="text" id="searchUserUpi" class="form-control" placeholder="Cari Nama UPI...">
            </div>
          </div>
          <table class="table table-bordered table-hover" id="tableUpiProgress">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>Nama UPI</th>
                <th>Sarana & Prasarana</th>
                <th>Tenaga Kerja</th>
                <th>Bahan Baku</th>
                <th>Omzet</th>
                <th>Status Laporan</th>
              </tr>
            </thead>
            <tbody>
              @forelse($dataLaporan as $i => $row)
                <tr>
                  <td>{{ $i + 1 }}</td>
                  <td>{{ $row['user']->name }}</td>
                  <td class="text-center">
                    @if ($row['sarana'])
                      <span class="text-success" title="Sudah isi"><i class="fas fa-check-circle"></i></span>
                    @else
                      <span class="text-danger" title="Belum isi"><i class="fas fa-times-circle"></i></span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($row['tenaga'])
                      <span class="text-success" title="Sudah isi"><i class="fas fa-check-circle"></i></span>
                    @else
                      <span class="text-danger" title="Belum isi"><i class="fas fa-times-circle"></i></span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($row['bahan'])
                      <span class="text-success" title="Sudah isi"><i class="fas fa-check-circle"></i></span>
                    @else
                      <span class="text-danger" title="Belum isi"><i class="fas fa-times-circle"></i></span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($row['omzet'])
                      <span class="text-success" title="Sudah isi"><i class="fas fa-check-circle"></i></span>
                    @else
                      <span class="text-danger" title="Belum isi"><i class="fas fa-times-circle"></i></span>
                    @endif
                  </td>
                  <td class="text-center">
                    <a href="{{ route('triwulan.index', ['user_id' => $row['user']->id, 'tahun' => $tahun, 'triwulan' => $triwulan]) }}" target="_blank"
                      @if ($row['status'] == 'Lengkap') class="badge badge-dark"
                                 @else
                                      class="badge badge-warning text-dark" @endif>
                      {{ $row['status'] }}
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center text-muted">Tidak ada data user.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="d-flex justify-content-between align-items-center mt-2">
            <div id="showingEntriesUpi" class="small text-muted"></div>
            <nav>
              <ul class="pagination pagination-sm mb-0" id="paginationUpi"></ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

    @push('js')
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          const input = document.getElementById('searchUserUpi');
          const table = document.getElementById('tableUpiProgress');
          const showEntries = document.getElementById('showEntriesUpi');
          const showingEntries = document.getElementById('showingEntriesUpi');
          const pagination = document.getElementById('paginationUpi');
          let rows = Array.from(table.querySelectorAll('tbody tr'));
          let currentPage = 1;
          let perPage = parseInt(showEntries.value);

          function filterRows() {
            const filter = input.value.toLowerCase();
            rows.forEach(row => {
              const namaUpi = row.querySelector('td:nth-child(2)');
              if (namaUpi && namaUpi.textContent.toLowerCase().includes(filter)) {
                row.style.display = '';
              } else {
                row.style.display = 'none';
              }
            });
          }

          function paginateRows() {
            const filter = input.value.toLowerCase();
            const filteredRows = rows.filter(row => {
              const namaUpi = row.querySelector('td:nth-child(2)');
              return namaUpi && namaUpi.textContent.toLowerCase().includes(filter);
            });
            const total = filteredRows.length;
            const totalPages = Math.ceil(total / perPage) || 1;
            if (currentPage > totalPages) currentPage = totalPages;

            // Hide all first
            rows.forEach(row => row.style.display = 'none');
            // Show only paginated & filtered
            const start = (currentPage - 1) * perPage;
            const end = start + perPage;
            filteredRows.slice(start, end).forEach(row => row.style.display = '');

            // Showing entries text
            if (total === 0) {
              showingEntries.textContent = "Showing 0 entries";
            } else {
              showingEntries.textContent = `Showing ${start+1} to ${Math.min(end, total)} of ${total} entries`;
            }

            // Pagination
            pagination.innerHTML = '';
            const prevClass = currentPage === 1 ? 'disabled' : '';
            const nextClass = currentPage === totalPages ? 'disabled' : '';
            pagination.innerHTML += `<li class="page-item ${prevClass}"><a class="page-link" href="#" data-page="${currentPage-1}">Previous</a></li>`;
            for (let i = 1; i <= totalPages; i++) {
              pagination.innerHTML += `<li class="page-item ${i===currentPage?'active':''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
            }
            pagination.innerHTML += `<li class="page-item ${nextClass}"><a class="page-link" href="#" data-page="${currentPage+1}">Next</a></li>`;
          }

          // Event listeners
          if (input && table) {
            input.addEventListener('keyup', function() {
              currentPage = 1;
              paginateRows();
            });
          }
          if (showEntries) {
            showEntries.addEventListener('change', function() {
              perPage = parseInt(this.value);
              currentPage = 1;
              paginateRows();
            });
          }
          if (pagination) {
            pagination.addEventListener('click', function(e) {
              if (e.target.tagName === 'A') {
                e.preventDefault();
                const page = parseInt(e.target.getAttribute('data-page'));
                if (!isNaN(page) && page >= 1) {
                  currentPage = page;
                  paginateRows();
                }
              }
            });
          }

          // Inisialisasi
          paginateRows();
        });
      </script>
    @endpush
  </div>
@endsection
