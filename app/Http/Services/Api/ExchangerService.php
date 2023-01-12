<?php

namespace App\Http\Services\Api;

use App\Http\Services\Api\Base\BaseContextCommand;
use App\Http\Services\Api\Commands\{
    Warehouse\GetProductsCommand,
};

class ExchangerService // extends BaseExchangerService
{
    private BaseContextCommand $contextCommand;

    public function __construct(BaseContextCommand $contextCommand)
    {
        dd(111111);
    }
    
    /**
     * @see BaseExchangeStrategy
     */
    protected function getAvailableStrategies(): array
    {
        return [
            GetProductsCommand::COMMAND_NAME              => GetProductsCommand::class,

        ];
    }
    
    
}
