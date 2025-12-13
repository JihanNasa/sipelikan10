@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Edit Data Tenaga Kerja' }}
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

  <div class="section-body">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Mohon periksa kembali input Anda:
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <h2 class="section-title">Form Edit Tenaga Kerja</h2>
    <p class="section-lead">Pastikan data yang Anda masukkan sudah benar sebelum menyimpan perubahan data.</p>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Tenaga Kerja</h4>
          </div>
          <div class="card-body">
            <div class="section-body">
              <form action="{{ route('tenagas.update', $tenaga->id) }}" method="POST" data-edit-confirm>
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label>Jumlah WNI Laki-laki</label>
                  <input type="number" name="jumlah_wni_laki" class="form-control" value="{{ old('jumlah_wni_laki', $tenaga->jumlah_wni_laki) }}" required>
                </div>
                <div class="form-group">
                  <label>Jumlah WNI Perempuan</label>
                  <input type="number" name="jumlah_wni_perempuan" class="form-control" value="{{ old('jumlah_wni_perempuan', $tenaga->jumlah_wni_perempuan) }}" required>
                </div>
                <div class="form-group">
                  <label>Jumlah WNA Laki-laki</label>
                  <input type="number" name="jumlah_wna_laki" class="form-control" value="{{ old('jumlah_wna_laki', $tenaga->jumlah_wna_laki) }}" required>
                </div>
                <div class="form-group">
                  <label>Jumlah WNA Perempuan</label>
                  <input type="number" name="jumlah_wna_perempuan" class="form-control" value="{{ old('jumlah_wna_perempuan', $tenaga->jumlah_wna_perempuan) }}" required>
                </div>
                <div class="form-group">
                  <label>Tahun</label>
                  <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $tenaga->tahun) }}" required>
                </div>
                <div class="form-group">
                  <label>Triwulan</label>
                  <select name="triwulan" class="form-control @error('triwulan') is-invalid @enderror" required>
                    <option value="" disabled selected>Pilih Triwulan</option>
                    <option value="1" {{ old('triwulan', $tenaga->triwulan) == 1 ? 'selected' : '' }}>(Januari - Maret)</option>
                    <option value="2" {{ old('triwulan', $tenaga->triwulan) == 2 ? 'selected' : '' }}>(April - Juni)</option>
                    <option value="3" {{ old('triwulan', $tenaga->triwulan) == 3 ? 'selected' : '' }}>(Juli - September)</option>
                    <option value="4" {{ old('triwulan', $tenaga->triwulan) == 4 ? 'selected' : '' }}>(Oktober - Desember)</option>
                  </select>
                  @error('triwulan')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-info"><i class="far fa-edit"></i>Simpan</button>
                <a href="{{ route('tenagatabel.index') }}" class="btn btn btn-icon icon-left btn-warning" data-cancel-confirm><i class="fas fa-times"></i>Batal</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('form[data-edit-confirm]');
      if (form) {
        form.addEventListener('submit', function(e) {
          if (!confirm('Pastikan data yang diubah sudah benar!')) {
            e.preventDefault();
          }
        });
      }
      const cancelBtn = document.querySelector('a[data-cancel-confirm]');
      if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
          if (!confirm('Ingin membatalkan perubahan data?')) {
            e.preventDefault();
          }
        });
      }
    });
  </script>
@endpush
