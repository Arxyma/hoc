<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Community;
use App\Policies\PostPolicy;
use App\Policies\CommunityPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Community::class => CommunityPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Anda bisa menambahkan gate tambahan di sini jika perlu
    }
}
