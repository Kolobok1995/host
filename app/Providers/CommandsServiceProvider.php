<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ApiShop\CommandsService;
use App\Services\ApiShop\Commands\Products\{
    GetProductsCommand,
    GetCategoriesCommand
};

class CommandsServiceProvider extends ServiceProvider
{
    private array $commands = [
        GetProductsCommand::COMMAND_NAME       => GetProductsCommand::class,
        GetCategoriesCommand::COMMAND_NAME     => GetCategoriesCommand::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CommandsService::class, function () {
            return new CommandsService($this->commands);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
