<?php

namespace Cals\RSP;

use Cals\RSP\Commands\MakePresenter;
use Cals\RSP\Commands\MakeRepository;
use Cals\RSP\Commands\MakeService;
use Cals\RSP\Commands\RSPGenerate;
use Illuminate\Support\ServiceProvider;

/**
 * Class RSPProvider
 *
 * @package Cals\RSPArchitecture
 */
class RSPServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            MakeRepository::class,
            MakeService::class,
            MakePresenter::class,
            RSPGenerate::class
        ]);
        $this->publishes([
            __DIR__ . '/config/rsp.php' => config_path('rsp.php')
        ], 'rsp');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindRepositories();
        $this->bindServices();
        $this->bindPresenters();
    }

    /**
     * Bind the repositories.
     */
    private function bindRepositories()
    {
        $repositories = config('rsp.repositories');
        if ($repositories) {
            foreach ($repositories as $key => $repository) {
                $this->app->bind($key, $repository);
            }
        }
    }

    /**
     * Bind the services.
     */
    private function bindServices()
    {
        $services = config('rsp.services');
        if ($services) {
            foreach ($services as $key => $service) {
                $this->app->bind($key, $service);
            }
        }
    }

    /**
     * Bind the presenters.
     */
    private function bindPresenters()
    {
        $presenters = config('rsp.presenters');
        if ($presenters) {
            foreach ($presenters as $key => $presenter) {
                $this->app->bind($key, $presenter);
            }
        }
    }
}
