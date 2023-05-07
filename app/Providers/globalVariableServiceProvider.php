<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class globalVariableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $tanggalBatasTerakhir = '2023-04-30';

        app()->singleton('tanggalBatasTerakhir', function () use ($tanggalBatasTerakhir) {
            return $tanggalBatasTerakhir;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
