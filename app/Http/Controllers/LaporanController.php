<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sarana;
use App\Models\Tenaga;
use App\Models\Bahan;
use App\Models\Produk;
use App\Models\Omzet;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    private function applyUserScope($query)
    {
        if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())) {
            return $query;
        } elseif (Auth::check()) {
            return $query->where('user_id', Auth::id());
        }
        return $query->whereRaw('1 = 0');
    }

    public function showSaranaForm()
    {
        return view('stisla.examples.sarana.index');
    }

    public function showTenagaForm()
    {
        return view('stisla.examples.tenaga.index');
    }

    public function showBahanForm()
    {
        return view('stisla.examples.bahan.index');
    }

    public function showProdukForm()
    {
        return view('stisla.examples.produk.index');
    }

    public function showOmzetForm()
    {
        return view('stisla.examples.omzet.index');
    }

    public function storeSarana(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_sarana' => 'required|string|max:255',
            'kapasitas' => 'nullable|string|max:255',
            'pengolahan_teknologi' => 'nullable|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'triwulan' => 'required|integer|min:1|max:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['user_id'] = Auth::id();

        Sarana::create($data);

        return redirect()->back()->with('success', 'Data Sarana berhasil disimpan!');
    }

    public function storeTenaga(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_wni_laki' => 'required|integer|min:0',
            'jumlah_wni_perempuan' => 'required|integer|min:0',
            'jumlah_wna_laki' => 'required|integer|min:0',
            'jumlah_wna_perempuan' => 'required|integer|min:0',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'triwulan' => 'required|integer|min:1|max:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['user_id'] = Auth::id();

        Tenaga::create($data);

        return redirect()->back()->with('success', 'Data Tenaga Kerja berhasil disimpan!');
    }

    public function storeBahan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_ikan' => 'required|string|max:255',
            'volume_bahanbaku' => 'required|numeric|min:0',
            'asal_bahanbaku' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'triwulan' => 'required|integer|min:1|max:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['user_id'] = Auth::id();

        Bahan::create($data);

        return redirect()->back()->with('success', 'Data Bahan Baku berhasil disimpan!');
    }

    public function storeProduk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_produk' => 'required|string|max:255',
            'volume_produk' => 'required|numeric|min:0',
            'pemasaran' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'triwulan' => 'required|integer|min:1|max:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['user_id'] = Auth::id();

        Produk::create($data);

        return redirect()->back()->with('success', 'Data Produk berhasil disimpan!');
    }

    public function storeOmzet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tujuan_domes' => 'nullable|string|max:255',
            'nilai_domes' => 'nullable|numeric|min:0',
            'volume_domes' => 'nullable|numeric|min:0',
            'tujuan_luarnegeri' => 'nullable|string|max:255',
            'nilai_luarnegeri' => 'nullable|numeric|min:0',
            'volume_luarnegeri' => 'nullable|numeric|min:0',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'triwulan' => 'required|integer|min:1|max:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['user_id'] = Auth::id();

        Omzet::create($data);

        return redirect()->back()->with('success', 'Data Omzet berhasil disimpan!');
    }

    // ===================== SARANA =====================
    public function indexSarana()
    {
        $saranas = $this->applyUserScope(Sarana::with('user'))->orderBy('tahun', 'desc')->orderBy('triwulan', 'desc')->get();
        return view('stisla.crud-examples.saranatabel.index', compact('saranas'));
    }

    public function editSarana($id)
    {
        $sarana = Sarana::findOrFail($id);
        return view('stisla.examples.sarana.edit', compact('sarana'));
    }

    public function destroySarana($id)
    {
        $sarana = Sarana::findOrFail($id);
        if (!Auth::user()->isAdmin() && !Auth::user()->isSuperAdmin() && $sarana->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
        }
        $sarana->delete();
        return redirect()->back()->with('success', 'Data Sarana berhasil dihapus!');
    }

    // ===================== TENAGA =====================
    public function indexTenaga()
    {
        $tenagas = $this->applyUserScope(Tenaga::with('user'))->orderBy('tahun', 'desc')->orderBy('triwulan', 'desc')->get();
        return view('stisla.crud-examples.tenagatabel.index', compact('tenagas'));
    }

    public function editTenaga($id)
    {
        $tenaga = Tenaga::findOrFail($id);
        return view('stisla.examples.tenaga.edit', compact('tenaga'));
    }

    public function destroyTenaga($id)
    {
        $tenaga = Tenaga::findOrFail($id);
        if (!Auth::user()->isAdmin() && !Auth::user()->isSuperAdmin() && $tenaga->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
        }
        $tenaga->delete();
        return redirect()->back()->with('success', 'Data Tenaga berhasil dihapus!');
    }

    // ===================== BAHAN =====================
    public function indexBahan()
    {
        $bahans = $this->applyUserScope(Bahan::with('user'))->orderBy('tahun', 'desc')->orderBy('triwulan', 'desc')->get();
        return view('stisla.crud-examples.bahantabel.index', compact('bahans'));
    }

    public function editBahan($id)
    {
        $bahan = Bahan::findOrFail($id);
        return view('stisla.examples.bahan.edit', compact('bahan'));
    }

    public function destroyBahan($id)
    {
        $bahan = Bahan::findOrFail($id);
        if (!Auth::user()->isAdmin() && !Auth::user()->isSuperAdmin() && $bahan->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
        }
        $bahan->delete();
        return redirect()->back()->with('success', 'Data Bahan berhasil dihapus!');
    }

    // ===================== PRODUK =====================
    public function indexProduk()
    {
        $produks = $this->applyUserScope(Produk::with('user'))->orderBy('tahun', 'desc')->orderBy('triwulan', 'desc')->get();
        return view('stisla.crud-examples.produktabel.index', compact('produks'));
    }

    public function editProduk($id)
    {
        $produk = Produk::findOrFail($id);
        return view('stisla.examples.produk.edit', compact('produk'));
    }

    public function destroyProduk($id)
    {
        $produk = Produk::findOrFail($id);
        if (!Auth::user()->isAdmin() && !Auth::user()->isSuperAdmin() && $produk->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
        }
        $produk->delete();
        return redirect()->back()->with('success', 'Data Produk berhasil dihapus!');
    }

    // ===================== OMZET =====================
    public function indexOmzet()
    {
        $omzets = $this->applyUserScope(Omzet::with('user'))->orderBy('tahun', 'desc')->orderBy('triwulan', 'desc')->get();
        return view('stisla.crud-examples.omzettabel.index', compact('omzets'));
    }

    public function editOmzet($id)
    {
        $omzet = Omzet::findOrFail($id);
        return view('stisla.examples.omzet.edit', compact('omzet'));
    }

    public function destroyOmzet($id)
    {
        $omzet = Omzet::findOrFail($id);
        if (!Auth::user()->isAdmin() && !Auth::user()->isSuperAdmin() && $omzet->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
        }
        $omzet->delete();
        return redirect()->back()->with('success', 'Data Omzet berhasil dihapus!');
    }
    

    public function indexTahun(Request $request)
    {
        $selectedYear = $request->input('tahun', date('Y'));
        $availableYears = Sarana::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        $saranas = $this->applyUserScope(Sarana::query())->where('tahun', $selectedYear)->get();
        $tenagas = $this->applyUserScope(Tenaga::query())->where('tahun', $selectedYear)->get();
        $bahans = $this->applyUserScope(Bahan::query())->where('tahun', $selectedYear)->get();
        $produks = $this->applyUserScope(Produk::query())->where('tahun', $selectedYear)->get();
        $omzets = $this->applyUserScope(Omzet::query())->where('tahun', $selectedYear)->get();

        $totalSaranaTahun = $saranas->sum('kapasitas');
        $totalVolumeBahanTahun = $bahans->sum('volume_bahanbaku');
        $totalVolumeProdukTahun = $produks->sum('volume_produk');
        $totalNilaiOmzetDomesTahun = $omzets->sum('nilai_domes');
        $totalVolumeOmzetDomesTahun = $omzets->sum('volume_domes');
        $totalNilaiOmzetLuarNegeriTahun = $omzets->sum('nilai_luarnegeri');
        $totalVolumeOmzetLuarNegeriTahun = $omzets->sum('volume_luarnegeri');
        //$totalTenagaKerjaTahunWni = $tenagas->sum('jumlah_wni_laki') + $tenagas->sum('jumlah_wni_perempuan');
        //$totalTenagaKerjaTahunWna = $tenagas->sum('jumlah_wna_laki') + $tenagas->sum('jumlah_wna_perempuan');
        $totalTenagaKerjaTahun = $tenagas->sum('jumlah_wni_laki') +
                                 $tenagas->sum('jumlah_wni_perempuan') +
                                 $tenagas->sum('jumlah_wna_laki') +
                                 $tenagas->sum('jumlah_wna_perempuan');

        return view('stisla.crud-examples.tahun.index', compact(
            'selectedYear',
            'availableYears',
            'saranas',
            'tenagas',
            'bahans',
            'produks',
            'omzets',
            'totalVolumeBahanTahun',
            'totalVolumeProdukTahun',
            'totalNilaiOmzetDomesTahun',
            'totalVolumeOmzetDomesTahun',
            'totalNilaiOmzetLuarNegeriTahun',
            'totalVolumeOmzetLuarNegeriTahun',
            'totalTenagaKerjaTahun'
        ));
    }

    public function indexTriwulan(Request $request)
    {
        $selectedYear = $request->input('tahun', date('Y'));
        $selectedTriwulan = $request->input('triwulan', ceil(date('n') / 3));

        $saranas = $this->applyUserScope(Sarana::query())->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();
        $tenagas = $this->applyUserScope(Tenaga::query())->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();
        $bahans = $this->applyUserScope(Bahan::query())->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();
        $produks = $this->applyUserScope(Produk::query())->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();
        $omzets = $this->applyUserScope(Omzet::query())->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();

        $totalSaranaTriwulan = $saranas->sum('kapasitas');
        $totalVolumeBahanTriwulan = $bahans->sum('volume_bahanbaku');
        $totalVolumeProdukTriwulan = $produks->sum('volume_produk');
        $totalNilaiOmzetDomesTriwulan = $omzets->sum('nilai_domes');
        $totalVolumeOmzetDomesTriwulan = $omzets->sum('volume_domes');
        $totalNilaiOmzetLuarNegeriTriwulan = $omzets->sum('nilai_luarnegeri');
        $totalVolumeOmzetLuarNegeriTriwulan = $omzets->sum('volume_luarnegeri');
        //$totalTenagaKerjaTriwulanWni = $tenagas->sum('jumlah_wni_laki') + $tenagas->sum('jumlah_wni_perempuan');
        //$totalTenagaKerjaTriwulanWna = $tenagas->sum('jumlah_wna_laki') + $tenagas->sum('jumlah_wna_perempuan');
        $totalTenagaKerjaTriwulan = $tenagas->sum('jumlah_wni_laki') +
                                    $tenagas->sum('jumlah_wni_perempuan') +
                                    $tenagas->sum('jumlah_wna_laki') +
                                    $tenagas->sum('jumlah_wna_perempuan');

        return view('stisla.crud-examples.triwulan.index', compact(
            'selectedYear',
            'selectedTriwulan',
            'saranas',
            'tenagas',
            'bahans',
            'produks',
            'omzets',
            'totalVolumeBahanTriwulan',
            'totalVolumeProdukTriwulan',
            'totalNilaiOmzetDomesTriwulan',
            'totalVolumeOmzetDomesTriwulan',
            'totalNilaiOmzetLuarNegeriTriwulan',
            'totalVolumeOmzetLuarNegeriTriwulan',
            'totalTenagaKerjaTriwulan'
        ));
    }

    public function indexRekapitulasi(Request $request)
{
    $availableYears = Sarana::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

    $rekapData = [];
    foreach ($availableYears as $year) {
        $saranasYear = $this->applyUserScope(Sarana::query())->where('tahun', $year)->get();
        $tenagasYear = $this->applyUserScope(Tenaga::query())->where('tahun', $year)->get();
        $bahansYear = $this->applyUserScope(Bahan::query())->where('tahun', $year)->get();
        $produksYear = $this->applyUserScope(Produk::query())->where('tahun', $year)->get();
        $omzetsYear = $this->applyUserScope(Omzet::query())->where('tahun', $year)->get();

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
            $bahansTriwulan = $this->applyUserScope(Bahan::query())->where('tahun', $year)->where('triwulan', $i)->get();
            $produksTriwulan = $this->applyUserScope(Produk::query())->where('tahun', $year)->where('triwulan', $i)->get();
            $omzetsTriwulan = $this->applyUserScope(Omzet::query())->where('tahun', $year)->where('triwulan', $i)->get();
            $tenagasTriwulan = $this->applyUserScope(Tenaga::query())->where('tahun', $year)->where('triwulan', $i)->get();

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

    return view('stisla.crud-examples.rekapitulasi.index', compact('rekapData', 'availableYears'));      
    }
}