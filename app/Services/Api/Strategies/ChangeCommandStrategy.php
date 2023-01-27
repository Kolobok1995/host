<?php

namespace App\Services\Api\Strategies;

use App\Services\Api\Traits\ThrowerError;
use App\Services\Api\Commands\Base\BaseContextCommand;
use App\Services\Api\Commands\Products\{
    GetProductsCommand,
    GetCategoriesCommand
};

class ChangeCommandStrategy 
{
    use ThrowerError;
    
    private BaseContextCommand $contextCommand;

    public function __construct(BaseContextCommand $contextCommand) 
    {
        $this->contextCommand = $contextCommand;
    }

    /**
     * Возвращает команду 
     *
     * @return void
     */
    public function getCommand() 
    {
        $command = match($this->contextCommand->getMode()) 
        {
            GetProductsCommand::COMMAND_NAME       => GetProductsCommand::class,
            GetCategoriesCommand::COMMAND_NAME     => GetCategoriesCommand::class,
            
            default   => $this->throwInputError($messageError)
        };

        return new $command($this->contextCommand);
    }
}