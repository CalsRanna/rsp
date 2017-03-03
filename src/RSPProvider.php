<?php

namespace Cals\RSPArchitecture;

use Cals\RSPArchitecture\Commands\MakePresenter;
use Cals\RSPArchitecture\Commands\MakeRepository;
use Cals\RSPArchitecture\Commands\MakeService;
use Cals\RSPArchitecture\Repositories\Implementations\Repository;
use Cals\RSPArchitecture\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, Repository::class);
    }
}
