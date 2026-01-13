<?php

namespace App\Providers;

use App\Models\Notifikasi;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $notifikasiBelumDibaca = Notifikasi::where('pengguna_id', auth()->id())
                    ->where('status_baca', 'belum dibaca')
                    ->latest()
                    ->take(5)
                    ->get();

                $jumlahNotifikasi = Notifikasi::where('pengguna_id', auth()->id())
                    ->where('status_baca', 'belum dibaca')
                    ->count();

                $view->with([
                    'navbarNotifikasi' => $notifikasiBelumDibaca,
                    'navbarNotifikasiCount' => $jumlahNotifikasi,
                ]);
            }
        });
    }
}