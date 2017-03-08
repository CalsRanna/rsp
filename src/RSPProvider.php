<?php

namespace Cals\RSPArchitecture;

use Cals\RSPArchitecture\Commands\MakePresenter;
use Cals\RSPArchitecture\Commands\MakeRepository;
use Cals\RSPArchitecture\Commands\MakeService;
use Cals\RSPArchitecture\Repositories\Implementations\Repository;
use Cals\RSPArchitecture\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class RSPProvider
 *
 * @package Cals\RSPArchitecture
 */
class RSPProvider extends ServiceProvider
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
            MakePresenter::class
        ]);
        $this->publishes([
            __DIR__ . '/config/rsp.php' => config_path('rsp.php')
        ],'rsp');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, Repository::class);
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
