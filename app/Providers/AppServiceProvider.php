<?php

namespace App\Providers;

use App\Models\Supplier;
use App\Policies\SupplierPolicy;
use App\Observers\SupplierObserver;
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
        Supplier::observe(SupplierObserver::class);
        Gate::policy(Supplier::class, SupplierPolicy::class);
    }
}
