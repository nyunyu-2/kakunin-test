<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // ログインビュー
        Fortify::loginView(function () {
            return view('login'); // Bladeファイルを自作している場合
        });

        // 登録ビュー
        Fortify::registerView(function () {
            return view('register'); // Bladeファイルを自作している場合
        });
    }
}
