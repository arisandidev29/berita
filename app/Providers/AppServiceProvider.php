<?php

namespace App\Providers;

use App\Models\NewsDraf;
use App\Models\NewsResult;
use App\Policies\NewsDraftPolicy;
use App\Service\AiService;
use App\Service\ImageService;
use App\Service\Impl\GeminiService;
use App\Service\Impl\ImageKitService;
use App\Service\Impl\NewsConfigService;
use App\Service\Impl\NewsDrafService;
use App\Service\Impl\NewsGenerator;
use App\Service\Impl\NewsResultService;
use Database\Seeders\newsDrafSeeder;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use ImageKit\ImageKit;
use League\Flysystem\Filesystem;
use TaffoVelikoff\ImageKitAdapter\ImagekitAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NewsConfigService::class, fn() => new NewsConfigService());
        $this->app->singleton(NewsDrafService::class, function($app){ 
            return new NewsDrafService($app->make(ImageService::class));
        });
        $this->app->singleton(NewsResultService::class, function(Application $app) {
            return new NewsResultService(
                $app->make(NewsDrafService::class)
            );
        });

        $this->app->singleton(NewsGenerator::class, function (Application $app) {
            return new NewsGenerator(
                $app->make(NewsDrafService::class),
                $app->make(NewsConfigService::class),
                $app->make(NewsResultService::class),
                $app->make(AiService::class)
            );
        });

        $this->app->singleton(AiService::class, GeminiService::class);
        $this->app->singleton(ImageService::class,ImageKitService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // custome filesystem image kit
        Storage::extend('imagekit', function ($app, $config) {
            $adapter = new ImagekitAdapter(

                new ImageKit(
                    $config['public_key'],
                    $config['private_key'],
                    $config['endpoint_url']
                ),

                $options = [ // Optional
                    'purge_cache_update'    => [
                        'enabled'       => true,
                        'endpoint_url'  => 'your_endpoint_url'
                    ]
                ]

            );

            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });

        Gate::policy(NewsDraf::class, NewsDraftPolicy::class);
    }

}
