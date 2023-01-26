<?php

namespace App\Http\Services\Api\Strategies;

use App\Http\Services\Api\Traits\ThrowerError;
use App\Http\Services\Api\Commands\{
    Base\BaseContextCommand,
    Products\GetProductsCommand,
    Products\GetCategoriesCommand
};

class ChangeCommandStrategy 
{
    use ThrowerError;
    
    private BaseContextCommand $contextCommand;

    private array $strategies = [
        GetProductsCommand::COMMAND_NAME       => GetProductsCommand::class,
        GetCategoriesCommand::COMMAND_NAME     => GetCategoriesCommand::class,
    ];

    public function __construct(BaseContextCommand $contextCommand) 
    {
        $this->contextCommand = $contextCommand;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getCommand()
    {
        
        $this->validate();
        
        $commandName = $this->contextCommand->getMode();
        $commandClass = $this->strategies[$commandName];

        return new $commandClass($this->contextCommand);
    }

    private function validate()
    {
        $commandName = $this->contextCommand->getMode();

        if (! array_key_exists($commandName, $this->strategies)) {
            $messageError = 'Метод загрузки данных ' . $commandName . ' не существует';
            $this->throwInputError($messageError);
        }
    }
}