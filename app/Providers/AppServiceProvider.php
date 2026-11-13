<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Integrasi cek NIB OSS RBA (JELITA DPMPTSP melalui SPLPD Jabar).
        // Driver dipilih lewat OSS_DRIVER di .env: disabled | dummy | api
        $this->app->bind(\App\Services\Oss\OssClientInterface::class, function () {
            $config = config('services.oss', []);

            return match ($config['driver'] ?? 'disabled') {
                'api' => new \App\Services\Oss\JelitaOssClient($config['jelita'] ?? []),
                'dummy' => new \App\Services\Oss\DummyOssClient(),
                default => new \App\Services\Oss\DisabledOssClient(),
            };
        });

        $this->app->bind(\App\Services\Oss\OssService::class, function ($app) {
            return new \App\Services\Oss\OssService(
                $app->make(\App\Services\Oss\OssClientInterface::class),
                config('services.oss', [])
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Batas permintaan endpoint cek NIB (publik) per alamat IP.
        \Illuminate\Support\Facades\RateLimiter::for('oss-nib', function (\Illuminate\Http\Request $request) {
            return \Illuminate\Cache\RateLimiting\Limit::perMinute((int) config('services.oss.rate_per_minute', 10))
                ->by($request->ip());
        });
        
        // Force HTTPS dan Root URL untuk deployment di subfolder
        if (config('app.url')) {
            URL::forceRootUrl(config('app.url'));
        }
        
        URL::forceScheme('https');
    }
}
