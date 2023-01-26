<?php

namespace App\Http\Services\Api;

use App\Http\Services\Api\Commands\Base\BaseContextCommand;
use App\Http\Services\Api\Exceptions\ExchangerStrategyException;
use Illuminate\Http\JsonResponse;
use App\Http\Services\Api\Strategies\ChangeCommandStrategy;
use App\Http\Services\Api\Commands\Base\BaseCommand;

class ExchangerService
{
    private BaseCommand $command;

    public function __construct(BaseContextCommand $contextCommand)
    {
        $changeCommandStrategy = new ChangeCommandStrategy($contextCommand);
        $this->command = $changeCommandStrategy->getCommand();
    }
    
    /**
     * Выполняем команду
     *
     * @return void
     */
    public function execute(): void
    {
        $this->command->execute();
    }
    
    /**
     * Возвращает результат выполнения команды
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->command->getData();
    }
}
