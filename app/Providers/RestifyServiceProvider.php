<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Binaryk\LaravelRestify\RestifyApplicationServiceProvider;

class RestifyServiceProvider extends RestifyApplicationServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected function gate(): void
    {
        Gate::define('viewRestify', function ($user) {
            return true;
        });
    }

    public function register()
    {
    }
}
