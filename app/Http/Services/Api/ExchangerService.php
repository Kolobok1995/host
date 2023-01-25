<?php

namespace App\Http\Services\Api;

use App\Http\Services\Api\Commands\Base\BaseContextCommand;
use App\Http\Services\Api\Exceptions\ExchangerStrategyException;
use Illuminate\Http\JsonResponse;

use App\Http\Services\Api\Commands\{
    Products\GetProductsCommand,
    Products\GetCategoriesCommand
};

class ExchangerService
{
    private BaseContextCommand $contextCommand;
    private string $strategyClass;
    private  $strategy;

    public function __construct(BaseContextCommand $contextCommand)
    {
        $this->contextCommand = $contextCommand;
    }
    
    /**
     * @see BaseExchangeStrategy
     */
    protected function getStrategies(): array
    {
        return [
            GetProductsCommand::COMMAND_NAME              => GetProductsCommand::class,
            GetCategoriesCommand::COMMAND_NAME            => GetCategoriesCommand::class,
        ];
    }
    

    public function execute(): void
    {
        // TODO Надо так
        // $command = new ChangeCommand($this->contextCommand);
        // $command->execute();

        $commandName = $this->contextCommand->getMode();
        $commandData = $this->contextCommand->getData();
        $strategies = $this->getStrategies();

        if (! array_key_exists($commandName, $strategies)) {
            $this->throwError('Метод загрузки данных ' . $commandName . ' не существует');
        }

        $strategyClass = $strategies[$commandName];

        $this->strategy = new $strategyClass($commandData);
        $this->strategy->process();
    }
    
    /**
     * Возвращает результат
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->strategy->getResult();
    }

    /**
     * Бросает ошибку стратегии команды.
     * 
     * @param  string $message
     * @param  mixed $case
     * @throws ExchangerStrategyException
     */
    protected function throwError(string $message)
    {
        throw new ExchangerStrategyException($message);
    }
}
