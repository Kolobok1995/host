<?php

namespace App\Services\ApiShop;

use App\Contracts\Api\ExchangerShop;
use App\Services\ApiShop\CommandsService;
use App\Services\ApiShop\Commands\Base\BaseCommand;

class ExchangerService implements ExchangerShop
{
    private $command;
     
    public function __construct(BaseCommand $command)
    {
        $this->command = $command;
    }

    /**
     * Возвращает результат
     * выполнения команды в массиве
     * @return array  
     */
    public function getData(): array 
    {
        return [
            $this->command->process()
         //   'mode' => $this->mode,
          //  'data' => $this->data
        ];
    }
}