<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Policies\ArticlePolicy;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Article::class => ArticlePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Шлюз для проверки прав модератора
        Gate::define('moderator', function (User $user) {
            return $user->isModerator();
        });
    }
}
