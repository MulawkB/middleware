<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::define('manage-product', function (User $user, Product $product) {
            return $user->id === $product->user_id;
        });

        Gate::define('view-product', function (User $user, Product $product) {
            if ($product->is_public) {
                return true;
            }
            return $user->id === $product->user_id;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
