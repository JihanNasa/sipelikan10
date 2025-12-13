@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Daftar Verifikasi Akun' }}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/selectric/public/selectric.css') }}">
    <style>
        .modal-backdrop {
            display: none !important;
        }
    </style>
@endpush

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
    <h2 class="section-title">Manajemen Verifikasi Akun</h2>
    <p class="section-lead">
        Di halaman ini Anda dapat mengelola verifikasi untuk akun pengguna yang mendaftar.
    </p>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>
    @endif

    <div class="row">
        {{-- User Belum Diverifikasi --}}
        <div class="col-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h4><i class="fas fa-user-clock mr-2"></i> UPI Belum Diverifikasi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-unverified">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>NIB</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($usersUnverified as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->jabatan }}</td>
                                    <td>{{ $user->nib }}</td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('verifikasi.verify', $user->id) }}" class="d-inline form-verify">
                                            @csrf
                                            <button type="button" class="btn btn-success btn-sm btn-confirm-verify">
                                                <i class="fas fa-check"></i> Verifikasi
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm btn-reject"
                                            data-toggle="modal"
                                            data-target="#rejectModal"
                                            data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data pengguna yang perlu diverifikasi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- User Sudah Diverifikasi --}}
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h4><i class="fas fa-user-check mr-2"></i> UPI Sudah Diverifikasi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-verified">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>NIB</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($usersVerified as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->jabatan }}</td>
                                    <td>{{ $user->nib }}</td>
                                    <td class="text-center">
                                        @if($user->is_active)
                                            <button type="button" class="btn btn-warning btn-sm btn-deactivate"
                                                data-toggle="modal"
                                                data-target="#deactivateModal"
                                                data-user-id="{{ $user->id }}"
                                                data-user-name="{{ $user->name }}">
                                                <i class="fas fa-ban"></i> Nonaktifkan
                                            </button>
                                        @else
                                            <form method="POST" action="{{ route('verifikasi.activate', $user->id) }}" class="d-inline form-activate">
                                                @csrf
                                                <button type="button" class="btn btn-success btn-sm btn-confirm-activate">
                                                    <i class="fas fa-check"></i> Aktifkan
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data pengguna yang sudah diverifikasi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tolak Verifikasi --}}
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="" id="rejectForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="rejectModalLabel">Tolak Verifikasi</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menolak verifikasi untuk <strong id="rejectUserName"></strong>. Mohon berikan alasannya:</p>
                    <div class="form-group">
                        <textarea name="reason" class="form-control" rows="3" required placeholder="Contoh: NIB tidak sesuai, dokumen kurang jelas..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Nonaktifkan Akun --}}
<div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="deactivateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="" id="deactivateForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="deactivateModalLabel">Nonaktifkan Akun</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <p>Pilih alasan nonaktifkan untuk <strong id="deactivateUserName"></strong>:</p>
                    <div class="form-group">
                        <label for="deactivateReason">Alasan Nonaktifkan</label>
                        <select id="deactivateReason" name="reason" class="form-control selectric" required>
                            <option value="" disabled selected>-- Pilih Alasan --</option>
                            <option value="Tidak Aktif Dalam Waktu Yang Lama">Tidak Aktif Dalam Waktu Yang Lama</option>
                            <option value="Pelaporan Tidak Sesuai Atau Manipulatif Data">Pelaporan Tidak Sesuai Atau Manipulatif Data</option>
                            <option value="Tidak Memiliki Legalitas atau Perizinan Yang Berlaku">Tidak Memiliki Legalitas atau Perizinan Yang Berlaku</option>
                            <option value="Permintaan Resmi dari Pihak UPI">Permintaan Resmi dari Pihak UPI</option>
                            <option value="Pelanggaran Keamanan atau Penyalahgunaan">Pelanggaran Keamanan atau Penyalahgunaan</option>
                            <option value="Pergantian Penanggung Jawab atau Restrukturisasi">Pergantian Penanggung Jawab atau Restrukturisasi</option>
                            <option value="other">Alasan Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group d-none" id="otherReasonWrapper">
                        <label for="otherReason">Tuliskan Alasan Lainnya</label>
                        <textarea id="otherReason" name="other_reason" class="form-control" rows="3" placeholder="Tulis alasan lainnya di sini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Nonaktifkan Akun</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.selectric').selectric();

            setTimeout(() => {
                $('.alert').alert('close');
            }, 5000);

            $('#table-unverified').DataTable({
                language: {
                    "sEmptyTable": "Tidak ada data yang tersedia",
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "sInfoFiltered": "(disaring dari _MAX_ total data)",
                    "sSearch": "Cari:",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext": "Selanjutnya",
                        "sLast": "Terakhir"
                    }
                }
            });
            $('#table-verified').DataTable({
                language: {
                    "sEmptyTable": "Tidak ada data yang tersedia",
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "sInfoFiltered": "(disaring dari _MAX_ total data)",
                    "sSearch": "Cari:",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext": "Selanjutnya",
                        "sLast": "Terakhir"
                    }
                }
            });

            // Modal Tolak
            $('#rejectModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const userId = button.data('user-id');
                const userName = button.data('user-name');
                $('#rejectForm').attr('action', '/verifikasi/' + userId + '/reject');
                $('#rejectUserName').text(userName);
                $('#rejectModalLabel').text('Tolak Verifikasi: ' + userName);
            });

            // Modal Nonaktifkan
            $('#deactivateModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const userId = button.data('user-id');
                const userName = button.data('user-name');
                $('#deactivateForm').attr('action', '/verifikasi/' + userId + '/deactivate');
                $('#deactivateUserName').text(userName);
                $('#deactivateModalLabel').text('Nonaktifkan Akun: ' + userName);
            });

            $('#deactivateModal').on('hidden.bs.modal', function () {
                $(this).find('form')[0].reset();
                $('#otherReasonWrapper').addClass('d-none');
                $('#otherReason').removeAttr('required').val('');
                $('.selectric').selectric('refresh');
            });

            $('#deactivateReason').on('change', function() {
                if ($(this).val() === 'other') {
                    $('#otherReasonWrapper').removeClass('d-none');
                    $('#otherReason').attr('required', true);
                } else {
                    $('#otherReasonWrapper').addClass('d-none');
                    $('#otherReason').removeAttr('required').val('');
                }
            });

            // Konfirmasi sebelum Verifikasi
            $(document).on('click', '.btn-confirm-verify', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                swal({
                    title: 'Verifikasi Akun',
                    text: "Apakah Anda yakin ingin memverifikasi akun ini?",
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: "Batal",
                            visible: true,
                            className: "btn btn-secondary"
                        },
                        confirm: {
                            text: "Ya, Verifikasi!",
                            className: "btn btn-success"
                        }
                    },
                    dangerMode: false,
                    closeOnClickOutside: false
                }).then((willVerify) => {
                    if (willVerify) {
                        form.submit();
                    }
                });
            });

            // Konfirmasi sebelum Aktifkan Akun
            $(document).on('click', '.btn-confirm-activate', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                swal({
                    title: 'Aktifkan Akun',
                    text: "Apakah Anda yakin ingin mengaktifkan akun ini kembali?",
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: "Batal",
                            visible: true,
                            className: "btn btn-secondary"
                        },
                        confirm: {
                            text: "Aktifkan",
                            className: "btn btn-success"
                        }
                    },
                    dangerMode: false,
                    closeOnClickOutside: false
                }).then((willActivate) => {
                    if (willActivate) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
