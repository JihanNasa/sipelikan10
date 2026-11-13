<?php

namespace Tests\Feature;

use App\Models\OssCheckLog;
use App\Models\User;
use App\Rules\NibTerdaftarOss;
use App\Services\Oss\JelitaOssClient;
use App\Services\Oss\OssClientInterface;
use App\Services\Oss\OssNibResult;
use App\Services\Oss\OssService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

/**
 * Uji fitur cek NIB OSS RBA. Tidak ada panggilan ke server sungguhan:
 * respons JELITA dipalsukan dengan Http::fake (data fiktif).
 *
 * Jalankan: DB_CONNECTION=sqlite DB_DATABASE=:memory: php artisan test --filter=OssNibTest
 *
 * Catatan: beberapa migration lama proyek ini tidak dapat dijalankan dari database kosong
 * (mis. kolom "tahun" ditambahkan dua kali), sehingga uji ini hanya menyiapkan tabel yang dibutuhkan.
 */
class OssNibTest extends TestCase
{
    private const NIB = '9120000000011';
    private const URL = 'https://splp.test/t/jabarprov.go.id/dpmptsp-jelita/1.00/nib/proyek/*';

    protected function setUp(): void
    {
        parent::setUp();
        foreach ([
            '0001_01_01_000000_create_users_table.php',
            '2026_11_13_000001_ensure_upi_columns_on_users_table.php',
            '2026_11_13_000002_add_oss_columns_to_users_table.php',
            '2026_11_13_000003_create_oss_check_logs_table.php',
        ] as $migration) {
            (require database_path('migrations/' . $migration))->up();
        }
        // Tabel settings dibaca oleh middleware web (versi ringkas dari migration aslinya).
        \Illuminate\Support\Facades\Schema::create('settings', function ($table) {
            $table->string('key', 50)->primary();
            $table->longText('value');
        });
        // Middleware pencatat request menulis ke tabel log_requests; tidak relevan untuk uji ini.
        $this->withoutMiddleware(\App\Http\Middleware\LogRequestMiddleware::class);
        Cache::flush();
        config([
            'services.oss.driver' => 'api',
            'services.oss.strict' => false,
            'services.oss.cache_minutes' => 720,
            'services.oss.jelita' => [
                'base_url' => 'https://splp.test/t/jabarprov.go.id',
                'path' => '/dpmptsp-jelita/1.00/nib/proyek/',
                'apikey' => 'apikey-uji',
                'token' => 'token-uji',
                'timeout' => 5,
            ],
        ]);
    }

    private function suksesBody(array $override = []): array
    {
        return [
            'status' => 'success',
            'source' => 'data_oss',
            'data' => array_merge([
                'source' => 'data_oss',
                'nib' => self::NIB,
                'id_proyek' => 'R-000000000000000000001',
                'nama_perusahaan' => 'CV CONTOH OLAHAN IKAN ',
                'uraian_jenis_perusahaan' => 'Persekutuan Komanditer (CV)',
                'status_pm' => 'PMDN',
                'negara' => 'Indonesia',
                'skala_usaha' => 'Usaha Mikro',
                'kab_kota' => 'Kab. Contoh',
                'kbli' => 1499,
                'judul_kbli' => 'Judul KBLI uji',
                'uraian_resiko_proyek' => 'Menengah Rendah',
                'tambahan_tk' => null,
            ], $override),
        ];
    }

    private function client(): JelitaOssClient
    {
        return new JelitaOssClient(config('services.oss.jelita'));
    }

    public function test_respons_sukses_dipetakan_dan_kbli_diberi_nol_di_depan(): void
    {
        Http::fake([self::URL => Http::response($this->suksesBody(), 200)]);

        $r = $this->client()->cekNib(self::NIB);

        $this->assertSame(OssNibResult::TERDAFTAR, $r->status);
        $this->assertSame('CV CONTOH OLAHAN IKAN', $r->namaPerusahaan);
        $this->assertSame('01499', $r->kbli);
        $this->assertSame('Kab. Contoh', $r->kabKota);
        $this->assertSame('Usaha Mikro', $r->skalaUsaha);

        Http::assertSent(fn ($req) => $req->hasHeader('apikey', 'apikey-uji')
            && str_contains($req->url(), 'nib=' . self::NIB)
            && str_contains($req->url(), 'token=token-uji'));
    }

    public function test_data_berupa_daftar_proyek_mengambil_proyek_pertama(): void
    {
        $body = $this->suksesBody();
        $body['data'] = [$body['data'], array_merge($body['data'], ['id_proyek' => 'R-2'])];
        Http::fake([self::URL => Http::response($body, 200)]);

        $r = $this->client()->cekNib(self::NIB);

        $this->assertTrue($r->isTerdaftar());
        $this->assertSame('R-000000000000000000001', $r->idProyek);
    }

    public function test_404_dan_data_kosong_berarti_tidak_ditemukan(): void
    {
        Http::fake([self::URL => Http::sequence()
            ->push(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404)
            ->push(['status' => 'success', 'data' => null], 200)
            ->push(['status' => 'failed', 'data' => []], 200)]);

        $this->assertSame(OssNibResult::TIDAK_DITEMUKAN, $this->client()->cekNib(self::NIB)->status);
        $this->assertSame(OssNibResult::TIDAK_DITEMUKAN, $this->client()->cekNib(self::NIB)->status);
        $this->assertSame(OssNibResult::TIDAK_DITEMUKAN, $this->client()->cekNib(self::NIB)->status);
    }

    public function test_kredensial_ditolak_limit_server_error_dan_timeout_berarti_gagal(): void
    {
        Http::fake([self::URL => Http::sequence()
            ->push([], 401)
            ->push([], 429)
            ->push([], 503)
            ->pushFailedConnection()]);

        foreach ([401, 429, 503] as $code) {
            $r = $this->client()->cekNib(self::NIB);
            $this->assertSame(OssNibResult::GAGAL, $r->status);
            $this->assertSame($code, $r->httpCode);
        }
        $this->assertSame(OssNibResult::GAGAL, $this->client()->cekNib(self::NIB)->status);
    }

    public function test_nib_respons_berbeda_dianggap_gagal(): void
    {
        Http::fake([self::URL => Http::response($this->suksesBody(['nib' => '1111111111111']), 200)]);

        $this->assertSame(OssNibResult::GAGAL, $this->client()->cekNib(self::NIB)->status);
    }

    public function test_konfigurasi_kosong_tidak_memanggil_api(): void
    {
        Http::fake();
        config(['services.oss.jelita.apikey' => '']);

        $this->assertSame(OssNibResult::GAGAL, $this->client()->cekNib(self::NIB)->status);
        Http::assertNothingSent();
    }

    public function test_mode_disabled_tidak_memanggil_api_dan_tidak_mencatat(): void
    {
        Http::fake();
        config(['services.oss.driver' => 'disabled']);

        $r = app(OssService::class)->cek(self::NIB, OssService::SUMBER_FORM);

        $this->assertSame(OssNibResult::NONAKTIF, $r->status);
        Http::assertNothingSent();
        $this->assertSame(0, OssCheckLog::count());
    }

    public function test_hasil_pasti_disimpan_di_cache_dan_dicatat_sekali(): void
    {
        Http::fake([self::URL => Http::response($this->suksesBody(), 200)]);
        $oss = app(OssService::class);

        $oss->cek(self::NIB, OssService::SUMBER_FORM);
        $oss->cek(self::NIB, OssService::SUMBER_FORM);

        Http::assertSentCount(1);
        $this->assertSame(1, OssCheckLog::where('nib', self::NIB)->where('status', 'terdaftar')->count());
    }

    public function test_hasil_gagal_tidak_disimpan_di_cache(): void
    {
        Http::fake([self::URL => Http::response([], 503)]);
        $oss = app(OssService::class);

        $oss->cek(self::NIB, OssService::SUMBER_FORM);
        $oss->cek(self::NIB, OssService::SUMBER_FORM);

        Http::assertSentCount(2);
    }

    public function test_gagal_tidak_menimpa_data_oss_yang_sudah_ada(): void
    {
        $user = User::factory()->create(['nib' => self::NIB]);
        $oss = app(OssService::class);

        Http::fake([self::URL => Http::sequence()
            ->push($this->suksesBody(), 200)
            ->push([], 503)]);

        $oss->cekUser($user, OssService::SUMBER_ADMIN);
        $oss->cekUser($user->fresh(), OssService::SUMBER_ADMIN);

        $user->refresh();
        $this->assertSame('terdaftar', $user->oss_status);
        $this->assertSame('CV CONTOH OLAHAN IKAN', $user->oss_nama_perusahaan);
        $this->assertSame('01499', $user->oss_kbli);
        $this->assertSame('Kab. Contoh', $user->oss_payload['kab_kota']);
        $this->assertSame(2, OssCheckLog::where('user_id', $user->id)->count());
    }

    public function test_endpoint_formulir_mode_disabled(): void
    {
        config(['services.oss.driver' => 'disabled']);

        $this->postJson(route('oss.cek-nib'), ['nib' => self::NIB])
            ->assertOk()
            ->assertExactJson(['enabled' => false]);
    }

    public function test_endpoint_formulir_hanya_mengembalikan_data_seperlunya(): void
    {
        Http::fake([self::URL => Http::response($this->suksesBody(), 200)]);

        $res = $this->postJson(route('oss.cek-nib'), ['nib' => self::NIB])->assertOk();

        $res->assertJson(['enabled' => true, 'status' => 'terdaftar', 'nama_perusahaan' => 'CV CONTOH OLAHAN IKAN', 'kab_kota' => 'Kab. Contoh']);
        $this->assertSame(['enabled', 'status', 'message', 'nama_perusahaan', 'kab_kota'], array_keys($res->json()));
    }

    public function test_endpoint_formulir_menolak_format_nib_salah(): void
    {
        Http::fake();

        $this->postJson(route('oss.cek-nib'), ['nib' => '123'])->assertStatus(422);
        Http::assertNothingSent();
    }

    public function test_aturan_validasi_mode_longgar_menerima_nib_tidak_ditemukan(): void
    {
        Http::fake([self::URL => Http::response(['status' => 'success', 'data' => null], 200)]);

        $v = Validator::make(['nib' => self::NIB], ['nib' => [new NibTerdaftarOss]]);

        $this->assertTrue($v->passes());
    }

    public function test_aturan_validasi_mode_ketat_menolak_nib_tidak_ditemukan(): void
    {
        config(['services.oss.strict' => true]);
        Http::fake([self::URL => Http::response(['status' => 'success', 'data' => null], 200)]);

        $v = Validator::make(['nib' => self::NIB], ['nib' => [new NibTerdaftarOss]]);

        $this->assertFalse($v->passes());
    }

    public function test_aturan_validasi_mode_ketat_tidak_menolak_saat_oss_gangguan(): void
    {
        config(['services.oss.strict' => true]);
        Http::fake([self::URL => Http::response([], 503)]);

        $v = Validator::make(['nib' => self::NIB], ['nib' => [new NibTerdaftarOss]]);

        $this->assertTrue($v->passes());
    }

    public function test_driver_dipilih_dari_konfigurasi(): void
    {
        config(['services.oss.driver' => 'dummy']);
        $this->assertInstanceOf(\App\Services\Oss\DummyOssClient::class, app(OssClientInterface::class));

        config(['services.oss.driver' => 'disabled']);
        $this->assertInstanceOf(\App\Services\Oss\DisabledOssClient::class, app(OssClientInterface::class));

        config(['services.oss.driver' => 'api']);
        $this->assertInstanceOf(JelitaOssClient::class, app(OssClientInterface::class));
    }

    public function test_perintah_cek_ulang_memperbarui_status_user(): void
    {
        $user = User::factory()->create(['nib' => self::NIB]);
        Http::fake([self::URL => Http::response($this->suksesBody(), 200)]);

        $this->artisan('oss:cek-ulang', ['--jeda' => 0])->assertSuccessful();

        $this->assertSame('terdaftar', $user->fresh()->oss_status);
    }
}
