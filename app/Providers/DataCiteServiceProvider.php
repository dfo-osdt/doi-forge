<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\DataCiteService;
use Illuminate\Support\ServiceProvider;

class DataCiteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/datacite.php', 'datacite');

        $this->app->bind(DataCiteService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
