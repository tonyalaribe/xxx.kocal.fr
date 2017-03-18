<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\TagRepository::class, \App\Repositories\TagRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\VideoRepository::class, \App\Repositories\VideoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SiteRepository::class, \App\Repositories\SiteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\VideoTagRepository::class, \App\Repositories\VideoTagRepositoryEloquent::class);
        //:end-bindings:
    }
}
