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
use App\Exports\TahunExport;
use App\Exports\TriwulanExport;
use App\Exports\RekapExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanMenuController extends Controller
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
            'kapasitas' => 'required|numeric|max:255',
            'pengolahan_teknologi' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'triwulan' => 'required|integer|min:1|max:4',
        ], [
            'jenis_sarana.required' => 'Jenis Sarana tidak boleh kosong.',
            'kapasitas.required' => 'Kapasitas (Kg) tidak boleh kosong.',
            'kapasitas.numeric' => 'Kapasitas harus berupa angka.',
            'pengolahan_teknologi.required' => 'Teknologi Pengolahan tidak boleh kosong, jika kolom Teknologi Pengolahan tidak diisi maka diisikan (-).',
            'tahun.required' => 'Tahun tidak boleh kosong.',
            'triwulan.required' => 'Triwulan tidak boleh kosong.',
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
        ], [
            'jumlah_wni_laki.required' => 'Jumlah WNI Laki-laki tidak boleh kosong.',
            'jumlah_wni_perempuan.required' => 'Jumlah WNI Perempuan tidak boleh kosong.',
            'jumlah_wna_laki.required' => 'Jumlah WNA Laki-laki tidak boleh kosong.',
            'jumlah_wna_perempuan.required' => 'Jumlah WNA Perempuan tidak boleh kosong.',
            'tahun.required' => 'Tahun tidak boleh kosong.',
            'triwulan.required' => 'Triwulan tidak boleh kosong.',
            'integer' => 'Nilai harus berupa angka.',
            'min' => 'Nilai tidak boleh kurang dari 0.',
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
        ], [
            'jenis_ikan.required' => 'Jenis Bahan Baku tidak boleh kosong.',
            'volume_bahanbaku.required' => 'Volume Bahan Baku tidak boleh kosong.',
            'volume_bahanbaku.numeric' => 'Volume Bahan Baku harus berupa angka.',
            'asal_bahanbaku.required' => 'Asal Bahan Baku tidak boleh kosong.',
            'tahun.required' => 'Tahun tidak boleh kosong.',
            'triwulan.required' => 'Triwulan tidak boleh kosong.',
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
        $data = $request->all();
    
        // Deteksi apakah bagian Domestik atau Luar Negeri diisi
        $hasDomestik = !empty($data['tujuan_domes']) || !empty($data['nilai_domes']) || !empty($data['volume_domes']);
        $hasLuarNegeri = !empty($data['tujuan_luarnegeri']) || !empty($data['nilai_luarnegeri']) || !empty($data['volume_luarnegeri']);
    
        // Jika tidak ada yang diisi sama sekali
        if (!$hasDomestik && !$hasLuarNegeri) {
            return redirect()->back()
                ->withErrors(['error' => 'Minimal salah satu data Omzet (Domestik atau Luar Negeri) harus diisi.'])
                ->withInput();
        }
    
        // Aturan dasar yang selalu wajib
        $rules = [
            'jenis_produk' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'triwulan' => 'required|integer|min:1|max:4',
        ];
    
        // Tambahkan aturan bersyarat untuk DOMESTIK jika diisi
        if ($hasDomestik) {
            $rules = array_merge($rules, [
                'tujuan_domes' => 'required|string|max:255',
                'nilai_domes' => 'required|numeric|min:0',
                'volume_domes' => 'required|numeric|min:0',
            ]);
        }
    
        // Tambahkan aturan bersyarat untuk LUAR NEGERI jika diisi
        if ($hasLuarNegeri) {
            $rules = array_merge($rules, [
                'tujuan_luarnegeri' => 'required|string|max:255',
                'nilai_luarnegeri' => 'required|numeric|min:0',
                'volume_luarnegeri' => 'required|numeric|min:0',
            ]);
        }
    
        // Pesan error khusus
        $messages = [
            'jenis_produk.required' => 'Jenis Produk tidak boleh kosong.',
            'tujuan_domes.required' => 'Tujuan Domestik tidak boleh kosong.',
            'nilai_domes.required' => 'Nilai Domestik (Rp) tidak boleh kosong, jika kolom Nilai Domestik tidak diisi maka diisikan 0',
            'nilai_domes.numeric' => 'Nilai Domestik (Rp) tidak boleh kosong, jika kolom Nilai Domestik tidak diisi maka diisikan 0',
            'volume_domes.required' => 'Volume Domestik (Kg) tidak boleh kosong, jika kolom Volume Domestik tidak diisi maka diisikan 0',
            'volume_domes.numeric' => 'Volume Domestik (Kg) tidak boleh kosong, jika kolom Volume Domestik tidak diisi maka diisikan 0',
            'tujuan_luarnegeri.required' => 'Tujuan Luar Negeri tidak boleh kosong.',
            'nilai_luarnegeri.required' => 'Nilai Luar Negeri ($) tidak boleh kosong, jika kolom Nilai Luar Negeri tidak diisi maka diisikan 0',
            'nilai_luarnegeri.numeric' => 'Nilai Luar Negeri ($) tidak boleh kosong, jika kolom Nilai Luar Negeri tidak diisi maka diisikan 0',
            'volume_luarnegeri.required' => 'Volume Luar Negeri (Kg) tidak boleh kosong, jika kolom Volume Luar Negeri tidak diisi maka diisikan 0',
            'volume_luarnegeri.numeric' => 'Volume Luar Negeri (Kg) tidak boleh kosong, jika kolom Volume Luar Negeri tidak diisi maka diisikan 0',
        ];
    
        // Jalankan validasi
        $validator = Validator::make($data, $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Isi default jika kosong
        $data['tujuan_domes'] = $data['tujuan_domes'] ?? '-';
        $data['nilai_domes'] = $data['nilai_domes'] ?? 0;
        $data['volume_domes'] = $data['volume_domes'] ?? 0;
        $data['tujuan_luarnegeri'] = $data['tujuan_luarnegeri'] ?? '-';
        $data['nilai_luarnegeri'] = $data['nilai_luarnegeri'] ?? 0;
        $data['volume_luarnegeri'] = $data['volume_luarnegeri'] ?? 0;
        $data['user_id'] = Auth::id();
    
        // Simpan ke database
        Omzet::create($data);
    
        return redirect()->back()->with('success', 'Data Omzet berhasil disimpan!');
    }
    

    // ===================== SARANA =====================
    public function indexSarana()
    {
        $saranas = $this->applyUserScope(Sarana::with('user'))->orderBy('tahun', 'desc')->orderBy('triwulan', 'desc')->get();
        return view('stisla.crud-examples.saranatabel.index', compact('saranas'));
    }

    // ===================== EDIT SARANA ===================== 
    public function editSarana($id)
    {
        $sarana = Sarana::findOrFail($id);
        return view('stisla.examples.saranaedit.index', compact('sarana'));
    }

    public function updateSarana(Request $request, $id)
    {
    $sarana = Sarana::findOrFail($id);

    $request->validate([
        'jenis_sarana' => 'required|string|max:255',
        'kapasitas' => 'nullable|string|max:255',
        'pengolahan_teknologi' => 'nullable|string|max:255',
        'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        'triwulan' => 'required|integer|min:1|max:4',
    ]);

    $sarana->update($request->only([
        'jenis_sarana',
        'kapasitas',
        'pengolahan_teknologi',
        'tahun',
        'triwulan',
    ]));

    return redirect()->route('saranatabel.index')->with('success', 'Perubahan data Sarana berhasil diperbarui!');
    }

    // ===================== HAPUS SARANA =====================
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

    // ===================== EDIT TENAGA =====================
    public function editTenaga($id)
    {
        $tenaga = Tenaga::findOrFail($id);
        return view('stisla.examples.tenagaedit.index', compact('tenaga'));
    }

    public function updateTenaga(Request $request, $id)
    {
    $tenaga = Tenaga::findOrFail($id);

    $request->validate([
        'jumlah_wni_laki' => 'required|integer|min:0',
        'jumlah_wni_perempuan' => 'required|integer|min:0',
        'jumlah_wna_laki' => 'required|integer|min:0',
        'jumlah_wna_perempuan' => 'required|integer|min:0',
        'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        'triwulan' => 'required|integer|min:1|max:4',
    ]);

    $tenaga->update($request->only([
        'jumlah_wni_laki',
        'jumlah_wni_perempuan',
        'jumlah_wna_laki',
        'jumlah_wna_perempuan',
        'tahun',
        'triwulan',
    ]));

    return redirect()->route('tenagatabel.index')->with('success', 'Perubahan Data Tenaga berhasil diperbarui!');
    }

    // ===================== HAPUS TENAGA =====================
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

    // ===================== EDIT BAHAN =====================
    public function editBahan($id)
    {
        $bahan = Bahan::findOrFail($id);
        return view('stisla.examples.bahanedit.index', compact('bahan'));
    }

    public function updateBahan(Request $request, $id)
    {
    $bahan = Bahan::findOrFail($id);

    $request->validate([
        'jenis_ikan' => 'required|string|max:255',
        'volume_bahanbaku' => 'required|numeric|min:0',
        'asal_bahanbaku' => 'required|string|max:255',
        'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        'triwulan' => 'required|integer|min:1|max:4',
    ]);

    $bahan->update($request->only([
        'jenis_ikan',
        'volume_bahanbaku',
        'asal_bahanbaku',
        'tahun',
        'triwulan',
    ]));

    return redirect()->route('bahantabel.index')->with('success', 'Perubahan Data Bahan berhasil diperbarui!');
    }

    // ===================== HAPUS BAHAN =====================
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

    // ===================== EDIT PRODUK =====================
    public function editProduk($id)
    {
        $produk = Produk::findOrFail($id);
        return view('stisla.examples.produkedit.index', compact('produk'));
    }

    public function updateProduk(Request $request, $id)
    {
    $produk = Produk::findOrFail($id);

    $request->validate([
        'jenis_produk' => 'required|string|max:255',
        'volume_produk' => 'required|numeric|min:0',
        'pemasaran' => 'required|string|max:255',
        'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        'triwulan' => 'required|integer|min:1|max:4',
    ]);

    $produk->update($request->only([
        'jenis_produk',
        'volume_produk',
        'pemasaran',
        'tahun',
        'triwulan',
    ]));

    return redirect()->route('produktabel.index')->with('success', 'Perubahan Data Produk berhasil diperbarui!'); 
    }

    // ===================== HAPUS PRODUK =====================
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

    // ===================== EDIT OMZET =====================
    public function editOmzet($id)
    {
        $omzet = Omzet::findOrFail($id);
        return view('stisla.examples.omzetedit.index', compact('omzet'));
    }

    public function updateOmzet(Request $request, $id)
    {
    $omzet = Omzet::findOrFail($id);

    $request->validate([
        'jenis_produk' => 'nullable|string|max:255',
        'tujuan_domes' => 'nullable|string|max:255',
        'nilai_domes' => 'nullable|numeric|min:0',
        'volume_domes' => 'nullable|numeric|min:0',
        'tujuan_luarnegeri' => 'nullable|string|max:255',
        'nilai_luarnegeri' => 'nullable|numeric|min:0',
        'volume_luarnegeri' => 'nullable|numeric|min:0',
        'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        'triwulan' => 'required|integer|min:1|max:4',
    ]);

    $omzet->update($request->only([
        'jenis_produk',
        'tujuan_domes',
        'nilai_domes',
        'volume_domes',
        'tujuan_luarnegeri',
        'nilai_luarnegeri',
        'volume_luarnegeri',
        'tahun',
        'triwulan',
    ]));

    return redirect()->route('omzettabel.index')->with('success', 'Perubahan Data Omzet berhasil diperbarui!');
    }

    // ===================== HAPUS OMZET =====================
    public function destroyOmzet($id)
    {
        $omzet = Omzet::findOrFail($id);
        if (!Auth::user()->isAdmin() && !Auth::user()->isSuperAdmin() && $omzet->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
        }
        $omzet->delete();
        return redirect()->back()->with('success', 'Data Omzet berhasil dihapus!');
    }

    // ===================== LAPORAN TAHUN & TRIWULAN =====================
    public function indexTahun(Request $request)
    {
        $selectedYear = $request->input('tahun', date('Y'));
        $availableYears = Sarana::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        
        // MODIFIKASI: Ambil user_id dari request
        $userId = $request->input('user_id');
        $targetUser = null;
        if ($userId) {
            $targetUser = \App\Models\User::find($userId);
        }
        
        // MODIFIKASI: Tambahkan ->when() untuk memfilter berdasarkan user_id jika ada
        $saranas = $this->applyUserScope(Sarana::query())
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->where('tahun', $selectedYear)->get();

        $tenagas = $this->applyUserScope(Tenaga::query())
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->where('tahun', $selectedYear)->get();

        $bahans = $this->applyUserScope(Bahan::query())
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->where('tahun', $selectedYear)->get();

        $produks = $this->applyUserScope(Produk::query())
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->where('tahun', $selectedYear)->get();

        $omzets = $this->applyUserScope(Omzet::query())
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->where('tahun', $selectedYear)->get();

        // Kalkulasi total tetap sama, tapi sekarang berdasarkan data yang sudah terfilter
        $totalVolumeBahanTahun = $bahans->sum('volume_bahanbaku');
        $totalVolumeProdukTahun = $produks->sum('volume_produk');
        $totalNilaiOmzetDomesTahun = $omzets->sum('nilai_domes');
        $totalVolumeOmzetDomesTahun = $omzets->sum('volume_domes');
        $totalNilaiOmzetLuarNegeriTahun = $omzets->sum('nilai_luarnegeri');
        $totalVolumeOmzetLuarNegeriTahun = $omzets->sum('volume_luarnegeri');
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
            'totalTenagaKerjaTahun',
            'targetUser'
        ));
    }


    public function indexTriwulan(Request $request)
    {
        $selectedYear = $request->input('tahun', date('Y'));
        $selectedTriwulan = $request->input('triwulan', ceil(date('n') / 3));
        
        // MODIFIKASI: Ambil user_id dari request
        $userId = $request->input('user_id');
        $targetUser = null;
        if ($userId) {
            $targetUser = \App\Models\User::find($userId);
        }

        // MODIFIKASI: Tambahkan ->when() untuk memfilter berdasarkan user_id jika ada
        $saranas = $this->applyUserScope(Sarana::query())
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();

        $tenagas = $this->applyUserScope(Tenaga::query())
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();

        $bahans = $this->applyUserScope(Bahan::query())
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();

        $produks = $this->applyUserScope(Produk::query())
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();

        $omzets = $this->applyUserScope(Omzet::query())
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();

        // Kalkulasi total tetap sama, tapi sekarang berdasarkan data yang sudah terfilter
        $totalVolumeBahanTriwulan = $bahans->sum('volume_bahanbaku');
        $totalVolumeProdukTriwulan = $produks->sum('volume_produk');
        $totalNilaiOmzetDomesTriwulan = $omzets->sum('nilai_domes');
        $totalVolumeOmzetDomesTriwulan = $omzets->sum('volume_domes');
        $totalNilaiOmzetLuarNegeriTriwulan = $omzets->sum('nilai_luarnegeri');
        $totalVolumeOmzetLuarNegeriTriwulan = $omzets->sum('volume_luarnegeri');
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
            'totalTenagaKerjaTriwulan',
            'targetUser'
        ));
    }


    // ===================== REKAPITULASI =====================
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

    public function exportRekapitulasiPdf()
    {
        // Ambil data rekapitulasi seperti pada view Rekapitulasi
        $availableYears = Sarana::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $rekapData = [];
        foreach ($availableYears as $year) {
            $rekapData[$year] = [
                'sarana_data' => $this->applyUserScope(Sarana::query())->where('tahun', $year)->get(),
                'tenaga_data' => $this->applyUserScope(Tenaga::query())->where('tahun', $year)->get(),
                'bahan_data'  => $this->applyUserScope(Bahan::query())->where('tahun', $year)->get(),
                'produk_data' => $this->applyUserScope(Produk::query())->where('tahun', $year)->get(),
                'omzet_data'  => $this->applyUserScope(Omzet::query())->where('tahun', $year)->get(),
                // dst...
            ];
    
            for ($i = 1; $i <= 4; $i++) {
                $rekapData[$year]['triwulan_data'][$i] = [
                    'bahan_baku' => $this->applyUserScope(Bahan::query())->where('tahun', $year)->where('triwulan', $i)->sum('volume_bahanbaku'),
                    'produk' => $this->applyUserScope(Produk::query())->where('tahun', $year)->where('triwulan', $i)->sum('volume_produk'),
                    'omzet_domes' => $this->applyUserScope(Omzet::query())->where('tahun', $year)->where('triwulan', $i)->sum('nilai_domes'),
                    'volume_omzet_domes' => $this->applyUserScope(Omzet::query())->where('tahun', $year)->where('triwulan', $i)->sum('volume_domes'),
                    'omzet_luarnegeri' => $this->applyUserScope(Omzet::query())->where('tahun', $year)->where('triwulan', $i)->sum('nilai_luarnegeri'),
                    'volume_omzet_luarnegeri' => $this->applyUserScope(Omzet::query())->where('tahun', $year)->where('triwulan', $i)->sum('volume_luarnegeri'),
                    'tenaga_kerja' => $this->applyUserScope(Tenaga::query())->where('tahun', $year)->where('triwulan', $i)->sum(DB::raw('jumlah_wni_laki + jumlah_wni_perempuan + jumlah_wna_laki + jumlah_wna_perempuan')),
                ];
            }
        }
    
        // Ambil data untuk tanda tangan
        $user = Auth::user();
        $namaPenanggungJawab = $user && isset($user->name2) ? $user->name2 : '-';
        $tanggalExport = now()->translatedFormat('d F Y');
    
        $pdf = Pdf::loadView('stisla.crud-examples.rekapitulasi.pdf', compact('availableYears', 'rekapData', 'namaPenanggungJawab', 'tanggalExport'));
        return $pdf->stream('rekapitulasi_laporan.pdf');
    }
// app/Http/Controllers/LaporanMenuController.php

// ... (kode lain di atasnya)

    public function exportTahunPdf(Request $request)
    {
        // 1. Ambil filter dari request
        $selectedYear = $request->input('tahun', date('Y'));
        $userId = $request->input('user_id');

        // 2. Ambil data dari database sesuai filter (termasuk filter user_id)
        $saranas = $this->applyUserScope(Sarana::query())
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->where('tahun', $selectedYear)->get();
            
        $tenagas = $this->applyUserScope(Tenaga::query())
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->where('tahun', $selectedYear)->get();
            
        $bahans = $this->applyUserScope(Bahan::query())
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->where('tahun', $selectedYear)->get();
            
        $produks = $this->applyUserScope(Produk::query())
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->where('tahun', $selectedYear)->get();
            
        $omzets = $this->applyUserScope(Omzet::query())
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->where('tahun', $selectedYear)->get();

        // 3. Hitung total berdasarkan data yang sudah terfilter
        $totalKapasitas = $saranas->sum('kapasitas');
        $totalWniLaki = $tenagas->sum('jumlah_wni_laki');
        $totalWniPerempuan = $tenagas->sum('jumlah_wni_perempuan');
        $totalWnaLaki = $tenagas->sum('jumlah_wna_laki');
        $totalWnaPerempuan = $tenagas->sum('jumlah_wna_perempuan');
        $totalWni = $totalWniLaki + $totalWniPerempuan;
        $totalWna = $totalWnaLaki + $totalWnaPerempuan;
        $totalVolumeBahanBaku = $bahans->sum('volume_bahanbaku');
        $totalVolumeProduk = $produks->sum('volume_produk');
        $totalNilaiDomestik = $omzets->sum('nilai_domes');
        $totalVolumeDomestik = $omzets->sum('volume_domes');
        $totalNilaiLuarNegeri = $omzets->sum('nilai_luarnegeri');
        $totalVolumeLuarNegeri = $omzets->sum('volume_luarnegeri');

        // 4. Ambil data user yang akan diekspor untuk header dan tanda tangan
        $exportUser = $userId ? User::find($userId) : Auth::user();
        $namaPenanggungJawab = $exportUser->name2 ?? '-';
        $tanggalExport = now()->translatedFormat('d F Y');
        $logoJabar = $exportUser->logo_jabar ?: 'assets/images/logo-jabar.png';
        $logoUser = $exportUser->cop_surat ? public_path($exportUser->cop_surat) : null;
        
        // 5. Kumpulkan semua data untuk dikirim ke view PDF
        $data = compact(
            'selectedYear', 'saranas', 'tenagas', 'bahans', 'produks', 'omzets',
            'totalKapasitas', 'totalWni', 'totalWna', 'totalVolumeBahanBaku', 'totalVolumeProduk',
            'totalNilaiDomestik', 'totalVolumeDomestik', 'totalNilaiLuarNegeri', 'totalVolumeLuarNegeri',
            'namaPenanggungJawab', 'tanggalExport', 'logoJabar', 'logoUser',
            'exportUser' // Variabel ini penting untuk view PDF
        );

        // 6. Load view PDF dengan data dan buat file PDF
        $pdf = Pdf::loadView('stisla.crud-examples.tahun.pdf', $data);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream("laporan-tahunan-{$selectedYear}-{$exportUser->name}.pdf");
    }

    public function exportTriwulanPdf(Request $request)
    {
        // 1. Ambil filter dari request
        $selectedYear = $request->input('tahun', date('Y'));
        $selectedTriwulan = $request->input('triwulan', ceil(date('n') / 3));
        $userId = $request->input('user_id');

        // 2. Ambil data dari database sesuai filter (termasuk filter user_id)
        $saranas = $this->applyUserScope(Sarana::query())
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();
            
        $tenagas = $this->applyUserScope(Tenaga::query())
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();
            
        $bahans = $this->applyUserScope(Bahan::query())
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();
            
        $produks = $this->applyUserScope(Produk::query())
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();
            
        $omzets = $this->applyUserScope(Omzet::query())
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->where('tahun', $selectedYear)->where('triwulan', $selectedTriwulan)->get();

        // 3. Hitung total berdasarkan data yang sudah terfilter
        $totalKapasitas = $saranas->sum('kapasitas');
        $totalWniLaki = $tenagas->sum('jumlah_wni_laki');
        $totalWniPerempuan = $tenagas->sum('jumlah_wni_perempuan');
        $totalWnaLaki = $tenagas->sum('jumlah_wna_laki');
        $totalWnaPerempuan = $tenagas->sum('jumlah_wna_perempuan');
        $totalWni = $totalWniLaki + $totalWniPerempuan;
        $totalWna = $totalWnaLaki + $totalWnaPerempuan;
        $totalVolumeBahanBaku = $bahans->sum('volume_bahanbaku');
        $totalVolumeProduk = $produks->sum('volume_produk');
        $totalNilaiDomestik = $omzets->sum('nilai_domes');
        $totalVolumeDomestik = $omzets->sum('volume_domes');
        $totalNilaiLuarNegeri = $omzets->sum('nilai_luarnegeri');
        $totalVolumeLuarNegeri = $omzets->sum('volume_luarnegeri');

        // 4. Ambil data user yang akan diekspor untuk header dan tanda tangan
        $exportUser = $userId ? User::find($userId) : Auth::user();
        $namaPenanggungJawab = $exportUser->name2 ?? '-';
        $tanggalExport = now()->translatedFormat('d F Y');
        $logoJabar = $exportUser->logo_jabar ?: 'assets/images/logo-jabar.png';
        $logoUser = $exportUser->cop_surat ? public_path($exportUser->cop_surat) : null;
        
        // 5. Kumpulkan semua data untuk dikirim ke view PDF
        $data = compact(
            'selectedYear', 'selectedTriwulan', 'saranas', 'tenagas', 'bahans', 'produks', 'omzets',
            'totalKapasitas', 'totalWni', 'totalWna', 'totalVolumeBahanBaku', 'totalVolumeProduk',
            'totalNilaiDomestik', 'totalVolumeDomestik', 'totalNilaiLuarNegeri', 'totalVolumeLuarNegeri',
            'namaPenanggungJawab', 'tanggalExport', 'logoJabar', 'logoUser',
            'exportUser' // Variabel ini penting untuk view PDF
        );

        // 6. Load view PDF dengan data dan buat file PDF
        $pdf = Pdf::loadView('stisla.crud-examples.triwulan.pdf', $data);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream("laporan-triwulan-{$selectedYear}-T{$selectedTriwulan}-{$exportUser->name}.pdf");
    }

// ... (sisa kode controller)


    // code untuk Laporan UPI
// app/Http/Controllers/LaporanMenuController.php

// ... (kode lain di atasnya)

    // code untuk Laporan UPI
    public function indexLaporanUpi(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $triwulan = $request->input('triwulan', ceil(date('n') / 3));
        
        // BARU: Ambil user_id yang dipilih dari filter
        $selectedUpiId = $request->input('user_id');

        // BARU: Ambil semua user UPI untuk ditampilkan di dropdown filter
        $upiUsers = \App\Models\User::where('is_active', 1)
            ->whereHas('roles', function($q) {
                $q->where('name', 'user');
            })
            ->orderBy('name')
            ->get();
    
        // MODIFIKASI: Terapkan filter user_id jika ada
        $usersQuery = \App\Models\User::where('is_active', 1)
            ->whereHas('roles', function($q) {
                $q->where('name', 'user');
            });

        if ($selectedUpiId) {
            $usersQuery->where('id', $selectedUpiId);
        }

        $users = $usersQuery->get();
    
        // User Sudah Membuat Laporan (semua lengkap)
        $userSudahLapor = $users->filter(function($user) use ($tahun, $triwulan) {
            $saranaAda = \App\Models\Sarana::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $tenagaAda = \App\Models\Tenaga::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $bahanAda  = \App\Models\Bahan::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $omzetAda  = \App\Models\Omzet::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            return $saranaAda && $tenagaAda && $bahanAda && $omzetAda;
        })->values();

        // User Belum Lengkap Membuat Laporan (sudah isi sebagian, tapi belum semua)
        $userBelumLengkapLapor = $users->filter(function($user) use ($tahun, $triwulan, $userSudahLapor) {
            $saranaAda = \App\Models\Sarana::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $tenagaAda = \App\Models\Tenaga::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $bahanAda  = \App\Models\Bahan::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $omzetAda  = \App\Models\Omzet::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $jumlahIsi = collect([$saranaAda, $tenagaAda, $bahanAda, $omzetAda])->filter()->count();
            return $jumlahIsi > 0 && $jumlahIsi < 4;
        })->values();

        // User yang belum buat laporan sama sekali
        $userBelumLapor = $users->filter(function($user) use ($tahun, $triwulan) {
            $saranaAda = \App\Models\Sarana::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $tenagaAda = \App\Models\Tenaga::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $bahanAda  = \App\Models\Bahan::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $omzetAda  = \App\Models\Omzet::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $jumlahIsi = collect([$saranaAda, $tenagaAda, $bahanAda, $omzetAda])->filter()->count();
            return $jumlahIsi === 0;
        })->values();

    
        // Data rekap status laporan setiap UPI (per triwulan)
        $dataLaporan = [];
        // MODIFIKASI: Loop dari $users yang sudah difilter
        foreach ($users as $user) {
            $saranaAda = \App\Models\Sarana::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $tenagaAda = \App\Models\Tenaga::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $bahanAda  = \App\Models\Bahan::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
            $omzetAda  = \App\Models\Omzet::where('user_id', $user->id)->where('tahun', $tahun)->where('triwulan', $triwulan)->exists();
    
            $lengkap = $saranaAda && $tenagaAda && $bahanAda && $omzetAda;
            $sebagian = ($saranaAda || $tenagaAda || $bahanAda || $omzetAda) && !$lengkap;

            $status = 'Belum Lapor';
            if ($lengkap) {
                $status = 'Lengkap';
            } elseif ($sebagian) {
                $status = 'Belum Lengkap';
            }
    
            $dataLaporan[] = [
                'user'   => $user,
                'sarana' => $saranaAda,
                'tenaga' => $tenagaAda,
                'bahan'  => $bahanAda,
                'omzet'  => $omzetAda,
                'status' => $status,
            ];
        }
    
        // MODIFIKASI: Tambahkan variabel baru ke view
        return view('stisla.crud-examples.laporanupi.index', [
            'tahun' => $tahun,
            'triwulan' => $triwulan,
            'userSudahLapor' => $userSudahLapor,
            'userBelumLengkapLapor' => $userBelumLengkapLapor,
            'userBelumLapor' => $userBelumLapor,
            'dataLaporan' => $dataLaporan,
            'upiUsers' => $upiUsers, // BARU
            'selectedUpiId' => $selectedUpiId, // BARU
        ]);
    }

// ... (kode lain di bawahnya)

    public function exportTahunExcel(Request $request)
    {
        $tahun = $request->tahun;
        
        // PENYESUAIAN: Tambahkan logika untuk memilih user yang benar
        $userId = $request->user_id;
        $userToExport = $userId ? User::find($userId) : auth()->user();

        // PENYESUAIAN: Kirim user yang benar dan nama file yang lebih deskriptif
        return Excel::download(new TahunExport($tahun, $userToExport), "Laporan_Tahun_{$tahun}_{$userToExport->name}.xlsx");
    }

    public function exportTriwulan(Request $request)
    {
        $tahun    = $request->tahun;
        $triwulan = $request->triwulan;
    
        // PENYESUAIAN: Tambahkan logika untuk memilih user yang benar
        $userId = $request->user_id;
        $userToExport = $userId ? User::find($userId) : auth()->user();
    
        // PENYESUAIAN: Kirim user yang benar dan nama file yang lebih deskriptif
        return Excel::download(new TriwulanExport($tahun, $triwulan, $userToExport), "Laporan_Triwulan_{$triwulan}_{$tahun}_{$userToExport->name}.xlsx");
    }
    
    // Export Rekapitulasi
    public function exportRekap()
    {
        return Excel::download(new RekapExport(auth()->user()), "laporan_rekap.xlsx");
    }
}