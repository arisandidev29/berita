<?php

namespace App\Providers;

use App\Models\NewsResult;
use App\Service\AiService;
use App\Service\Impl\GeminiService;
use App\Service\Impl\NewsConfigService;
use App\Service\Impl\NewsDrafService;
use App\Service\Impl\NewsGenerator;
use App\Service\Impl\NewsResultService;
use Database\Seeders\newsDrafSeeder;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NewsConfigService::class, fn() => new NewsConfigService());
        $this->app->singleton(NewsDrafService::class, fn() => new NewsDrafService());
        $this->app->singleton(NewsResultService::class, fn() => new NewsResultService());

        $this->app->singleton(NewsGenerator::class, function (Application $app) {
            return new NewsGenerator(
                $app->make(NewsDrafService::class),
                $app->make(NewsConfigService::class),
                $app->make(NewsResultService::class),
                $app->make(AiService::class)
            );
        });

        $this->app->singleton(AiService::class,GeminiService::class);



    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
