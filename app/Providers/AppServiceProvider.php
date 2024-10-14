<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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
        // Menambah function get untuk role
        Gate::define('admin', function ($user) {
            return $user->role_name == 'admin';
        });

        Gate::define('level1', function ($user) {
            return $user->role_name == 'level1';
        });

        Gate::define('level2', function ($user) {
            return $user->role_name == 'level2';
        });

        Gate::define('pimpinan', function ($user) {
            return $user->role_name == 'pimpinan';
        });

        Gate::define('multi-role', function ($user, $roles) {
            // Jika $roles adalah string, pisahkan menjadi array
            if (is_string($roles)) {
                $roles = explode('|', $roles);
            }
        
            // Pastikan $roles adalah array dan periksa role user
            return in_array($user->role_name, $roles);
        });
    }
}
