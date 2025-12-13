<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\CrudExample;
use App\Models\LogRequest;
use App\Models\Menu;
use App\Models\MenuGroup;
use App\Models\Notification;
use App\Models\PermissionGroup;
use App\Models\User;
use App\Models\Sarana;
use App\Models\Tenaga;
use App\Models\Bahan;
use App\Models\Produk;
use App\Models\Omzet;
use App\Repositories\SettingRepository;
use App\Services\DatabaseService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends StislaController
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // $this->middleware('can:Log Aktivitas');
    }

    /**
     * Menampilkan halaman dashboard
     *
     * @return Response
     */
    public function index()
    {
        $widgets = [];
        $user = auth()->user();

    // Cek apakah user sudah melengkapi profil
    $mustUpdateProfile = empty($user->cop_surat) || empty($user->lokasi_kantor_url) || empty($user->avatar);


        if ($user->can('Contoh CRUD'))
            $widgets[] = (object)[
                'title' => 'Contoh CRUD',
                'count' => CrudExample::count(),
                'bg'    => 'primary',
                'icon'  => 'atom',
                'route' => route('crud-examples.index'),
            ];
        if ($user->can('Pengguna'))
            $widgets[] = (object)[
                'title' => 'Pengguna',
                'count' => User::count(),
                'bg'    => 'danger',
                'icon'  => 'users',
                'route' => route('user-management.users.index'),
            ];
        if ($user->can('Role'))
            $widgets[] = (object)[
                'title' => 'Role',
                'count' => Role::count(),
                'bg'    => 'success',
                'icon'  => 'lock',
                'route' => route('user-management.roles.index')
            ];
        if ($user->can('Permission'))
            $widgets[] = (object)[
                'title' => 'Permission',
                'count' => Permission::count(),
                'bg'    => 'info',
                'icon'  => 'key',
                'route' => route('user-management.permissions.index')
            ];
        if ($user->can('Group Permission'))
            $widgets[] = (object)[
                'title' => 'Group Permission',
                'count' => PermissionGroup::count(),
                'bg'    => 'info',
                'icon'  => 'key',
                'route' => route('user-management.permission-groups.index'),
                'bg_color' => 'brown'
            ];
        if ($user->can('Menu'))
            $widgets[] = (object)[
                'title' => 'Menu',
                'count' => Menu::count(),
                'bg'    => 'primary',
                'icon'  => 'bars',
                'route' => route('menu-managements.index'),
                'bg_color' => 'pink'
            ];
        if ($user->can('Grup Menu'))
            $widgets[] = (object)[
                'title' => 'Grup Menu',
                'count' => MenuGroup::count(),
                'bg'    => 'danger',
                'icon'  => 'bars',
                'route' => route('menu-managements.index'),
                'bg_color' => 'orange'
            ];
        if ($user->can('Notifikasi')) {
            $widgets[] = (object)[
                'title' => 'Notifikasi',
                'count' => Notification::where('user_id', $user->id)->count(),
                'bg'    => 'info',
                'icon'  => 'bell',
                'route' => route('notifications.index'),
                'bg_color' => 'navy'
            ];
        }
        if ($user->can('Log Aktivitas'))
            $widgets[] = (object)[
                'title' => 'Log Aktivitas',
                'count' => ActivityLog::count(),
                'bg'    => 'success',
                'icon'  => 'clock-rotate-left',
                'route' => route('activity-logs.index'),
                'bg_color' => 'black'
            ];
        if ($user->can('Log Request'))
            $widgets[] = (object)[
                'title' => 'Log Request',
                'count' => LogRequest::count(),
                'bg'    => 'success',
                'icon'  => 'clock-rotate-left',
                'route' => route('request-logs.index'),
                'bg_color' => '#C88A65',
            ];
        if ($user->can('Pengaturan'))
            $widgets[] = (object)[
                'title' => 'Pengaturan',
                'count' => '6',
                'bg'    => 'success',
                'icon'  => 'cogs',
                'route' => route('settings.all'),
                'bg_color' => '#E9D66B',
            ];
        if ($user->can('Backup Database')) {
            $widgets[] = (object)[
                'title' => 'Backup Database',
                'count' => count((new DatabaseService)->getAllBackupMysql()),
                'bg'    => 'primary',
                'icon'  => 'database',
                'route' => route('backup-databases.index'),
                'bg_color' => 'purple',
            ];
        }

        $logs = $this->activityLogRepository->getMineLatest();

        return view('stisla.dashboard.index', [
            'widgets' => $widgets,
            'logs'    => $logs,
            'user'    => $user,
        ], compact('user', 'mustUpdateProfile'));
    }

    public function post(Request $request)
    {
        $request->validate([
            'file_upload' => 'required|file|max:102048',
        ]);
        $link = $this->fileService->uploadFile($request->file('file_upload'), 'file_upload');
        auth()->user()->update(['file_upload' => $link]);
        return redirect()->back()->with('successMessage', 'File berhasil diupload');
    }

    // Data chart pada halaman landing page
    public function landingChartData()
    {
        // Gabungan semua user
        $saranas = Sarana::all();
        $tenagas = Tenaga::all();
        $bahans  = Bahan::all();
        $produks = Produk::all();
        $omzets  = Omzet::all();
    
        $chartData = [
            'sarana' => $saranas->groupBy('tahun')->map(function ($yearGroup) {
                return $yearGroup->groupBy('triwulan')->map(function ($triwulanGroup) {
                    return [
                        'gudang_dingin' => $triwulanGroup->where('jenis_sarana', 'Gudang Dingin')->sum('kapasitas'),
                        'gudang_beku'   => $triwulanGroup->where('jenis_sarana', 'Gudang Beku')->sum('kapasitas'),
                        'gudang_kering' => $triwulanGroup->where('jenis_sarana', 'Gudang Kering')->sum('kapasitas'),
                    ];
                });
            }),
            'tenaga' => $tenagas->groupBy('tahun')->map(function ($yearGroup) {
                return $yearGroup->groupBy('triwulan')->map(function ($triwulanGroup) {
                    return [
                        'wni' => $triwulanGroup->sum('jumlah_wni_laki') + $triwulanGroup->sum('jumlah_wni_perempuan'),
                        'wna' => $triwulanGroup->sum('jumlah_wna_laki') + $triwulanGroup->sum('jumlah_wna_perempuan'),
                    ];
                });
            }),
            'bahan_top10' => $bahans
                ->groupBy('jenis_ikan')
                ->map(fn($g) => $g->sum('volume_bahanbaku'))
                ->sortDesc()
                ->take(10),
            'omzet_nilai' => $omzets
                ->groupBy('jenis_produk')
                ->map(fn($g) => [
                    'domestik'   => $g->sum('nilai_domes'),
                    'luarnegeri' => $g->sum('nilai_luarnegeri'),
                ])
                ->sortByDesc(fn($x) => $x['domestik'] + $x['luarnegeri'])
                ->take(10),
            'omzet_volume' => $omzets
                ->groupBy('jenis_produk')
                ->map(fn($g) => [
                    'domestik'   => $g->sum('volume_domes'),
                    'luarnegeri' => $g->sum('volume_luarnegeri'),
                ])
                ->sortByDesc(fn($x) => $x['domestik'] + $x['luarnegeri'])
                ->take(10),
        ];
    
        return response()->json($chartData);
    }
    
    // Data Chart pada halam dashboard
    public function indexChart(Request $request) 
    {
        $user = auth()->user();
        $isAdmin = $user->hasRole('admin') || $user->hasRole('superadmin');
    
        // Filter user
        $selectedUserId = $request->get('user_id');
        if ($isAdmin && $selectedUserId) {
            $saranas = Sarana::where('user_id', $selectedUserId)->get();
            $tenagas = Tenaga::where('user_id', $selectedUserId)->get();
            $bahans  = Bahan::where('user_id', $selectedUserId)->get();
            $produks = Produk::where('user_id', $selectedUserId)->get();
            $omzets  = Omzet::where('user_id', $selectedUserId)->get();
        } elseif ($isAdmin) {
            $saranas = Sarana::all();
            $tenagas = Tenaga::all();
            $bahans  = Bahan::all();
            $produks = Produk::all();
            $omzets  = Omzet::all();
        } else {
            $saranas = Sarana::where('user_id', $user->id)->get();
            $tenagas = Tenaga::where('user_id', $user->id)->get();
            $bahans  = Bahan::where('user_id', $user->id)->get();
            $produks = Produk::where('user_id', $user->id)->get();
            $omzets  = Omzet::where('user_id', $user->id)->get();
        }
    
        // ---------------------
        // DATA CHART LAMA (dipertahankan)
        // ---------------------
        $chartData = [
            'sarana' => $saranas->groupBy('tahun')->map(function ($yearGroup) {
                return $yearGroup->groupBy('triwulan')->map(function ($triwulanGroup) {
                    return $triwulanGroup->sum('kapasitas');
                });
            }),
            'tenaga' => $tenagas->groupBy('tahun')->map(function ($yearGroup) {
                return $yearGroup->groupBy('triwulan')->map(function ($triwulanGroup) {
                    return [
                        'wni' => $triwulanGroup->sum('jumlah_wni_laki') + $triwulanGroup->sum('jumlah_wni_perempuan'),
                        'wna' => $triwulanGroup->sum('jumlah_wna_laki') + $triwulanGroup->sum('jumlah_wna_perempuan'),
                    ];
                });
            }),
            'bahan' => $bahans->groupBy('tahun')->map(function ($yearGroup) {
                return $yearGroup->groupBy('triwulan')->map(function ($triwulanGroup) {
                    return $triwulanGroup->sum('volume_bahanbaku');
                });
            }),
            'produk' => $produks->groupBy('tahun')->map(function ($yearGroup) {
                return $yearGroup->groupBy('triwulan')->map(function ($triwulanGroup) {
                    return $triwulanGroup->sum('volume_produk');
                });
            }),
            'omzet' => $omzets->groupBy('tahun')->map(function ($yearGroup) {
                return $yearGroup->groupBy('triwulan')->map(function ($triwulanGroup) {
                    return [
                        'nilai_domes' => $triwulanGroup->sum('nilai_domes'),
                        'volume_domes' => $triwulanGroup->sum('volume_domes'),
                        'nilai_luarnegeri' => $triwulanGroup->sum('nilai_luarnegeri'),
                        'volume_luarnegeri' => $triwulanGroup->sum('volume_luarnegeri'),
                    ];
                });
            }),
        ];
    
        // ---------------------
        // DATA CHART BARU (tambahan)
        // ---------------------
    
        // SARANA PER JENIS di dalam struktur tahun → triwulan
        $chartData['sarana'] = $saranas->groupBy('tahun')->map(function ($yearGroup) {
            return $yearGroup->groupBy('triwulan')->map(function ($triwulanGroup) {
                return [
                    'gudang_dingin' => $triwulanGroup->where('jenis_sarana', 'Gudang Dingin')->sum('kapasitas'),
                    'gudang_beku'   => $triwulanGroup->where('jenis_sarana', 'Gudang Beku')->sum('kapasitas'),
                    'gudang_kering' => $triwulanGroup->where('jenis_sarana', 'Gudang Kering')->sum('kapasitas'),
                ];
            });
        });
    
        // BAHAN BAKU TOP 10 (jenis_ikan berdasarkan total volume)
        $chartData['bahan_top10'] = $bahans
            ->groupBy('jenis_ikan')
            ->map(fn($g) => $g->sum('volume_bahanbaku'))
            ->sortDesc()
            ->take(10);
    
        // OMZET TOP 10 (jenis_produk)
        $chartData['omzet_nilai'] = $omzets
            ->groupBy('jenis_produk')
            ->map(fn($g) => [
                'domestik'   => $g->sum('nilai_domes'),
                'luarnegeri' => $g->sum('nilai_luarnegeri'),
            ])
            ->sortByDesc(fn($x) => $x['domestik'] + $x['luarnegeri'])
            ->take(10);
    
        $chartData['omzet_volume'] = $omzets
            ->groupBy('jenis_produk')
            ->map(fn($g) => [
                'domestik'   => $g->sum('volume_domes'),
                'luarnegeri' => $g->sum('volume_luarnegeri'),
            ])
            ->sortByDesc(fn($x) => $x['domestik'] + $x['luarnegeri'])
            ->take(10);
    
        // Response
        if ($isAdmin) {
            return response()->json([
                'chartData'      => $chartData,
                'users'          => \App\Models\User::select('id','name')->get(),
                'selectedUserId' => $selectedUserId,
            ]);
        }
        return response()->json($chartData);
    }
    
    
    
    /**
     * home page
     *
     * @return Response
     */
    public function home()
    {
        return view('stisla.homes.index', [
            'title' => __('Selamat datang di ') . SettingRepository::applicationName(),
        ]);
    }
}
