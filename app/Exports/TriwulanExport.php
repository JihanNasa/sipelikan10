<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Sarana;
use App\Models\Tenaga;
use App\Models\Bahan;
use App\Models\Omzet;

class TriwulanExport implements FromView
{
    protected $tahun;
    protected $triwulan;
    protected $user;

    public function __construct($tahun, $triwulan, $user)
    {
        $this->tahun    = $tahun;
        $this->triwulan = $triwulan;
        $this->user     = $user;
    }

    public function view(): View
    {
        if (is_null($this->user)) {
            // Export seluruh data (admin/superadmin)
            $saranas = Sarana::where('tahun', $this->tahun)->where('triwulan', $this->triwulan)->get();
            $tenagas = Tenaga::where('tahun', $this->tahun)->where('triwulan', $this->triwulan)->get();
            $bahans  = Bahan::where('tahun', $this->tahun)->where('triwulan', $this->triwulan)->get();
            $omzets  = Omzet::where('tahun', $this->tahun)->where('triwulan', $this->triwulan)->get();
            $sumberData = "Sumber Data: Seluruh UPI (Diekspor oleh Admin/Superadmin)";
        } else {
            // Export data per user
            $saranas = Sarana::where('user_id', $this->user->id)->where('tahun', $this->tahun)->where('triwulan', $this->triwulan)->get();
            $tenagas = Tenaga::where('user_id', $this->user->id)->where('tahun', $this->tahun)->where('triwulan', $this->triwulan)->get();
            $bahans  = Bahan::where('user_id', $this->user->id)->where('tahun', $this->tahun)->where('triwulan', $this->triwulan)->get();
            $omzets  = Omzet::where('user_id', $this->user->id)->where('tahun', $this->tahun)->where('triwulan', $this->triwulan)->get();
            $sumberData = "Sumber Data Milik: " . ($this->user->name ?? 'Unknown');
        }
    
        return view('stisla.crud-examples.triwulan.export', [
            'tahun'      => $this->tahun,
            'triwulan'   => $this->triwulan,
            'saranas'    => $saranas,
            'tenagas'    => $tenagas,
            'bahans'     => $bahans,
            'omzets'     => $omzets,
            'sumberData' => $sumberData,
        ]);
    }    
}
