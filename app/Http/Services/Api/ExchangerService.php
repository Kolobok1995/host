<?php

namespace App\Http\Services\Api;

use App\Http\Services\Api\Base\BaseContextCommand;
use Illuminate\Http\JsonResponse;

use App\Http\Services\Api\Commands\{
    Products\GetProductsCommand
};

class ExchangerService // extends BaseExchangerService
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
        ];
    }
    

    public function process(): void
    {
        // TODO Привести в порядок
        $commandName = $this->contextCommand->getMode();
        $commandData = $this->contextCommand->getData();
        $strategies = $this->getStrategies();

        if (! isset($strategies[$commandName])) {
            $this->throwError('Метод загрузки данных ' . $commandName . ' не существует');
        }

        $strategyClass = $strategies[$commandName];

        $this->strategy = new $strategyClass($commandData);
        $this->strategy->process();
    }
    
    public function getData(): array
    {
        return $this->strategy->getResult();
    }

    /**
     * Бросает ошибку стратегии команды.
     * 
     * @param  string $message
     * @param  mixed $case
     * @throws ExchangerCommandException
     */
    protected function throwError(string $message)
    {
        throw new ExchangerStrategyException($message, 'Ошибка входных данных');
    }
}
