<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class JetstreamServiceProvider extends ServiceProvider
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
        Fortify::authenticateUsing(function (Request $request) {
        $user = User::where('email', $request->login)
            ->orWhere('username', $request->login)
            ->first();
 
        if ($user) {
            return $user;
        }
    });
    }
}
