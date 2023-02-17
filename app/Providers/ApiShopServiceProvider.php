<?php

namespace App\Providers;

use App\Contracts\Api\ExchangerShop;
use App\Services\ApiShop\ExchangerService;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use App\Services\ApiShop\CommandsService;

class ApiShopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $commandsService = $this->app->make(CommandsService::class);
        $command = $commandsService->getCommand();
        
        
        $this->app->bind(ExchangerShop::class, function () use ($command) {
            return new ExchangerService($command);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('api.exchanges', ExchangerShop::class);
    }
}
