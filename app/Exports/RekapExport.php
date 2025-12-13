<?php

namespace App\Exports;

use App\Models\Sarana;
use App\Models\Tenaga;
use App\Models\Bahan;
use App\Models\Produk;
use App\Models\Omzet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapExport implements FromView
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function view(): View
    {
        // Ambil tahun yang tersedia
        $availableYears = Sarana::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        $rekapData = [];
        foreach ($availableYears as $year) {
            // Scope user
            $saranasYear = $this->user->hasRole('admin') || $this->user->hasRole('superadmin')
                ? Sarana::where('tahun', $year)->get()
                : Sarana::where('tahun', $year)->where('user_id', $this->user->id)->get();

            $tenagasYear = $this->user->hasRole('admin') || $this->user->hasRole('superadmin')
                ? Tenaga::where('tahun', $year)->get()
                : Tenaga::where('tahun', $year)->where('user_id', $this->user->id)->get();

            $bahansYear = $this->user->hasRole('admin') || $this->user->hasRole('superadmin')
                ? Bahan::where('tahun', $year)->get()
                : Bahan::where('tahun', $year)->where('user_id', $this->user->id)->get();

            $produksYear = $this->user->hasRole('admin') || $this->user->hasRole('superadmin')
                ? Produk::where('tahun', $year)->get()
                : Produk::where('tahun', $year)->where('user_id', $this->user->id)->get();

            $omzetsYear = $this->user->hasRole('admin') || $this->user->hasRole('superadmin')
                ? Omzet::where('tahun', $year)->get()
                : Omzet::where('tahun', $year)->where('user_id', $this->user->id)->get();

            $rekapData[$year] = [
                'sarana_data' => $saranasYear,
                'tenaga_data' => $tenagasYear,
                'bahan_data' => $bahansYear,
                'produk_data' => $produksYear,
                'omzet_data' => $omzetsYear,
                'total_bahan_baku' => $bahansYear->sum('volume_bahanbaku'),
                'total_produk' => $produksYear->sum('volume_produk'),
                'total_omzet_domes' => $omzetsYear->sum('nilai_domes'),
                'total_volume_omzet_domes' => $omzetsYear->sum('volume_domes'),
                'total_omzet_luarnegeri' => $omzetsYear->sum('nilai_luarnegeri'),
                'total_volume_omzet_luarnegeri' => $omzetsYear->sum('volume_luarnegeri'),
                'total_tenaga_kerja' => $tenagasYear->sum('jumlah_wni_laki') +
                                        $tenagasYear->sum('jumlah_wni_perempuan') +
                                        $tenagasYear->sum('jumlah_wna_laki') +
                                        $tenagasYear->sum('jumlah_wna_perempuan'),
            ];

            for ($i = 1; $i <= 4; $i++) {
                $bahansTriwulan = $bahansYear->where('triwulan', $i);
                $produksTriwulan = $produksYear->where('triwulan', $i);
                $omzetsTriwulan = $omzetsYear->where('triwulan', $i);
                $tenagasTriwulan = $tenagasYear->where('triwulan', $i);

                $rekapData[$year]['triwulan_data'][$i] = [
                    'bahan_baku' => $bahansTriwulan->sum('volume_bahanbaku'),
                    'produk' => $produksTriwulan->sum('volume_produk'),
                    'omzet_domes' => $omzetsTriwulan->sum('nilai_domes'),
                    'volume_omzet_domes' => $omzetsTriwulan->sum('volume_domes'),
                    'omzet_luarnegeri' => $omzetsTriwulan->sum('nilai_luarnegeri'),
                    'volume_omzet_luarnegeri' => $omzetsTriwulan->sum('volume_luarnegeri'),
                    'tenaga_kerja' => $tenagasTriwulan->sum('jumlah_wni_laki') +
                                      $tenagasTriwulan->sum('jumlah_wni_perempuan') +
                                      $tenagasTriwulan->sum('jumlah_wna_laki') +
                                      $tenagasTriwulan->sum('jumlah_wna_perempuan'),
                ];
            }
        }

        $sumberData = $this->user->hasRole('admin') || $this->user->hasRole('superadmin')
            ? "Seluruh Data UPI (Admin/Superadmin)"
            : "Sumber Data ini Milik Dari " . ($this->user->name ?? 'Unknown');

        return view('stisla.crud-examples.rekapitulasi.export', [
            'availableYears' => $availableYears,
            'rekapData' => $rekapData,
            'sumberData' => $sumberData,
        ]);
    }
}
