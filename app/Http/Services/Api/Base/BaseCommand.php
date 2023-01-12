<?php

namespace App\Http\Services\Api\Base;

/**
 * Интерфейс Команды объявляет 
 * метод для выполнения команд.
 */
abstract class BaseCommand
{
    private array $commandData;
    private array $data;

    public function __construct(array $commandData = [])
    {
        $this->commandData = $commandData;
    }

    abstract public function execute(): array;

    public function process() {
        $this->data = $this->execute();
    }
    
    public function getCommandData(): array
    {
        return $this->commandData;
    }
    
    public function getResult(): array
    {
        return $this->data;
    }
}
