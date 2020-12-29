<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

            // システム管理者のみ許可
            Gate::define('system-only', function ($user) {
              return ($user->role == 1);
            });
            // 権限所持ユーザに許可
            Gate::define('admin-higher', function ($user) {
              return ($user->role > 0 && $user->role <= 5);
            });
            // 一般ユーザに許可
            Gate::define('user-higher', function ($user) {
              return ($user->role > 0 && $user->role <= 10);
            });
    }
}
